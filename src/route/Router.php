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

use im\http\msg\Request;
use im\http\msg\Response;
use im\http\Verbs;

/**
 * Defines a router interface for launching controllers.
 */
interface Router extends Verbs {

    /**
     * Add a route to this router.
     *
     * @param $path
     *      Path to access this controller
     *
     * @param $controller
     *      A controller. This may also be a string for a `Controller` class or a callable.
     *
     * @param $flags
     *      Flags that defines what request methods are to be used with this controller
     */
    function addRoute(string $path, string|Controller|callable $controller, int $flags = Verbs::ANY): void;

    /**
     * Add a named route to this router.
     *
     * This is similar to `addRoute()` only this allows you to built
     * a complete path using `getRoutePath()`.
     *
     * @param $name
     *      Name of this route
     *
     * @param $path
     *      Path to access this controller
     *
     * @param $controller
     *      A controller. This may also be a string for a `Controller` class or a callable.
     *
     * @param $flags
     *      Flags that defines what request methods are to be used with this controller
     */
    function addNamedRoute(string $name, string $path, string|Controller|callable $controller, int $flags = Verbs::ANY): void;

    /**
     * Built a complete path from a named route.
     *
     * This method takes a route based on it's name and replaced any
     * arguments with ones parsed in this call.
     *
     * @param $name
     *      Name of the route
     *
     * @param $args
     *      Arguments to replace within the route
     *
     * @return
     *      This will return `NULL` if the named route does not exist
     */
    function getRoutePath(string $name, array $args = []): ?string;

    /**
     * Start processing a request
     *
     * @param $request
     *      The request to process
     */
    function process(Request $request): Response;
}
