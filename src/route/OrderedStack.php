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
use im\util\HashSet;
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
    protected MutableListArray $entryProviders;

    /** @internal */
    protected int $level = 0;

    /** @internal */
    protected array $entries = [];

    /**
     *
     */
    public function __construct() {
        $this->middleware = new Vector();
        $this->entryProviders = new HashSet();

        /*
         * Add internal entry provider
         */
        $this->entryProviders->add($this->middleware);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\route\MiddlewareStack")]
    public function addEntryProvider(MiddlewareEntryProvider $provider): void {
        $this->entryProviders->add($provider);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\route\MiddlewareStack")]
    public function addMiddleware(string|Middleware|callable $middleware, int $order = 0, int $flags = Verbs::ANY): void {
        $mdInfo = new stdClass();
        $mdInfo->id = null;
        $mdInfo->order = $order;
        $mdInfo->flags = $flags;
        $mdInfo->controller = $middleware;

        $this->middleware->add($mdInfo);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\route\MiddlewareStack")]
    public function process(Request $request): Response {
        $flag = $this->verb2flags( $request->getMethod() );

        if ($this->level == 0) {
            foreach ($this->entryProviders as $provider) {
                foreach ($provider as $entry) {
                    if ($entry->flags & $flag) {
                        $new_entry = new stdClass();
                        $new_entry->id = $entry->id;
                        $new_entry->order = $entry->order;
                        $new_entry->flags = $entry->flags;
                        $new_entry->loader = null;
                        $new_entry->controller = null;

                        if ($provider instanceof MiddlewareEntryLoader) {
                            if ($entry->id == null) {
                                throw new Exception("A 'MiddlewareEntryLoader' must return entry id's");
                            }

                            $new_entry->loader = $provider;

                        } else {
                            $new_entry->controller = $entry->controller;
                        }

                        $this->entries[] = $new_entry;
                    }
                }
            }

            usort($this->entries, function($entry_a, $entry_b) {
                if ($entry_a->order == $entry_b->order) {
                    return 0;
                }

                return $entry_a->order < $entry_b->order ? -1 : 1;
            });
        }

        $entry = $this->entries[$this->level++] ?? null;

        if ($entry == null) {
            $response = new HttpResponse();

        } else {
            if ($entry->loader !== null) {
                $controller = $entry->loader->loadController($entry->id);

            } else {
                $controller = $entry->controller;

                if (is_string($controller)
                        && class_exists($controller, true)
                        && is_subclass_of($controller, Middleware::class)) {

                    $controller = new ($controller)();

                } else if (!is_callable($controller) && (is_string($controller) || !($controller instanceof Middleware))) {
                    throw new Exception("The class '". (is_string($controller) ? $controller : get_class($controller)) ."' must be a member of '". Middleware::class ."'");
                }
            }

            if ($controller instanceof Middleware) {
                $response = $controller->onProcess($request, $this);

            } else {
                $response = ($controller)($request, $this);
            }
        }

        if (--$this->level == 0) {
            $this->entries = [];
        }

        return $response;
    }
}
