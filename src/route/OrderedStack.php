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

use im\http\msg\HttpResponse;
use im\http\msg\Request;
use im\http\msg\Response;
use im\http\Verbs;
use im\http\res\VerbsImpl;
use im\util\MutableListArray;
use im\util\Vector;
use Exception;
use stdClass;

/**
 * Provides an implementation of `im\route\MiddlewareStack`
 */
class OrderedStack implements MiddlewareStack {

    use VerbsImpl;

    /** @internal */
    protected MutableListArray $middleware;

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
    public function addMiddleware(string|Middleware|callable $middleware, int $flags = Verbs::ANY): void {
        $mdInfo = new stdClass();
        $mdInfo->flags = $flags;
        $mdInfo->callee = $middleware;

        $this->middleware->add($mdInfo);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\route\MiddlewareStack")]
    public function process(Request $request): Response {
        $this->level++;

        $middleware = null;
        $flag = $this->verb2flags( $request->getMethod() );

        while ($this->offset < $this->middleware->length()) {
            $mdInfo = $this->middleware->get($this->offset++);

            if ($mdInfo->flags & $flag) {
                $middleware = $mdInfo->callee; break;
            }
        }

        if ($middleware == null) {
            $response = new HttpResponse();

        } else {
            if (is_string($middleware)
                    && class_exists($middleware, true)
                    && is_subclass_of($middleware, Middleware::class)) {

                $middleware = new ($middleware)();

            } else if (!is_callable($middleware) && (is_string($middleware) || !($middleware instanceof Middleware))) {
                throw new Exception("The class '". (is_string($middleware) ? $middleware : get_class($middleware)) ."' must be a member of '". Middleware::class ."'");
            }

            if ($middleware instanceof Middleware) {
                $response = $middleware->onProcess($request, $this);

            } else {
                $response = $middleware($request, $this);
            }
        }

        if (--$this->level == 0) {
            $this->offset = 0;
        }

        return $response;
    }
}
