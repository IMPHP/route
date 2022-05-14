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

use im\http\Verbs;

/**
 * Defines an extended Middleware stack
 */
interface MiddlewareStack extends StackEngine, Verbs {

    /**
     * Add a `MiddlewareEntryProvider` to this stack.
     *
     * This is used to provide middleware information outside of adding them via `addMiddleware()`.
     *
     * @param $provider
     *      The provider to add
     */
    function addEntryProvider(MiddlewareEntryProvider $provider): void;

    /**
     * Add a middleware to this stack
     *
     * @param $middleware
     *      A middleware instance, class name or a callable
     *
     * @param $order
     *      The order in which to run this middleware
     *
     * @param $flags
     *      Flags that defines what request methods are to be used with this middleware
     */
    function addMiddleware(string|Middleware|callable $middleware, int $order = 0, int $flags = Verbs::ANY): void;
}
