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

/**
 * This interface is used to define a middleware entry
 *
 * The interface is used together with `MiddlewareEntryProvider`, to
 * provide middleware to a stack.
 *
 * @var mixed id
 *      Unique id for this entry
 *
 * @var int $order
 *      The order in which to run this middleware relative to others
 *
 *      @note
 *          Lower means grater priority.
 *          Example an order of 2 will run before an order of 10.
 *
 * @var int $flags
 *      Flags indicating which request methods this middleware is for
 *
 *      @note
 *          These flags can be found in 'im\http\Verbs'
 *
 * @var string|Middleware|callable $controller
 *      The controller to load for this route
 *
 */
interface MiddlewareEntry {}
