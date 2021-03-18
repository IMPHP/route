<?php declare(strict_types=1);
/*
 * This file is part of the IMPHP Project: https://github.com/IMPHP
 *
 * Copyright (c) 2017 Daniel Bergløv, License: MIT
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software
 * and associated documentation files (the "Software"), to deal in the Software without restriction,
 * including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO
 * THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR
 * THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace im\route;

use im\http\msg\HttpResponseBuilder;
use im\http\msg\Request;
use im\http\msg\Response;
use im\util\IndexArray;
use im\util\Vector;
use Exception;

/**
 * Provides an implementation of `im\route\MiddlewareStack`
 */
class OrderedStack implements MiddlewareStack {

    /** @internal */
    protected IndexArray $middleware;

    /** @internal */
    protected int $level = 0;

    /** @internal */
    protected int $offset = 0;

    /**
     *
     */
    public function __construct() {
        $this->middleware = new Vector();
    }

    /**
     * @inheritDoc
     */
    #[Override("im\route\MiddlewareStack")]
    public function getFlags(string ...$methods): int {
        $flags = 0;

        foreach ($methods as $method) {
            $const = sprintf("%s::M_%s", MiddlewareStack::class, strtoupper($method));

            if (!defined($const)) {
                throw new Exception("Trying to use invalid method '$method'");
            }

            $flags |= constant($const);
        }

        return $flags;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\route\MiddlewareStack")]
    public function addMiddleware(string|Middleware|callable $middleware, int $flags = MiddlewareStack::M_ANY): void {
        $this->middleware->add([
            "flags" => $flags,
            "class" => $middleware
        ]);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\route\MiddlewareStack")]
    public function process(Request $request): Response {
        $this->level++;

        $middleware = null;
        $flag = $this->getFlags( $method = $request->getMethod() );

        while ($this->offset < $this->middleware->length()) {
            $pair = $this->middleware->get($this->offset++);

            if ($pair["flags"] & $flag) {
                $middleware = $pair["class"]; break;
            }
        }

        if ($middleware == null) {
            $response = new HttpResponseBuilder();

        } else {
            if (is_string($middleware)) {
                if (!class_exists($middleware, true)
                        || !is_subclass_of($middleware, Middleware::class)) {

                    throw new Exception("Middleware class '$request' could not be found or is not part of '". Middleware::class ."'");
                }

                $middleware = new $middleware();
            }

            if ($middleware instanceof Middleware) {
                $response = $middleware->onProcess($request, $this);

            } else {
                $response = $middleware($request, $this);
            }
        }

        /*
         * Handler internal redirects without calling the client
         */
        if (--$this->level == 0) {
            $this->offset = 0;

            if ($response->getStatusCode() == Response::STATUS_TEMPORARY_REDIRECT
                    || $response->getStatusCode() == Response::STATUS_PERMANENT_REDIRECT) {

                $request = $request->getBuilder();
                $uri = $request->getUri()->getBuilder();

                if (($baseUrl = $uri->getBaseUrl()) != null
                        && ($redirect = $response->getHeaderLine("Location")) != null
                        && str_starts_with($redirect, $baseUrl)) {

                    $path = "/". ltrim(substr($redirect, strlen($baseUrl) + 1), "/");

                    if (($pos = strpos($path, "?")) !== false) {
                        $uri->setQuery(substr($path, $pos+1));
                        $uri->setPath(substr($path, 0, $pos));

                    } else {
                        $uri->setPath($path);
                    }

                    $request->setUri($uri);

                    // Process redirect
                    $response = $this->process($request);
                }
            }
        }

        return $response;
    }
}
