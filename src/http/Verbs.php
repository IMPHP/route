<?php declare(strict_types=1);
/*
 * This file is part of the IMPHP Project: https://github.com/IMPHP
 *
 * Copyright (c) 2022 Daniel Bergløv, License: MIT
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

namespace im\http;

/**
 * This is used to define request methods as flags.
 * This allows them to be easily grouped together and identified without much overheat.
 */
interface Verbs {

    /**
     * @var int = 0x01
     */
    const GET = 0x01;

    /**
     * @var int = 0x02
     */
    const HEAD = 0x02;

    /**
     * @var int = 0x04
     */
    const POST = 0x04;

    /**
     * @var int = 0x08
     */
    const PUT = 0x08;

    /**
     * @var int = 0x10
     */
    const DELETE = 0x10;

    /**
     * @var int = 0x20
     */
    const CONNECT = 0x20;

    /**
     * @var int = 0x40
     */
    const OPTIONS = 0x40;

    /**
     * @var int = 0x80
     */
    const TRACE = 0x80;

    /**
     * @var int = 0x0100
     */
    const PATCH = 0x0100;

    /**
     * @var int = 0x01FF
     */
    const ANY = 0x01FF;

    /**
     * Return flags based on one or more string methods.
     *
     * @param $methods
     *      Methods to group into a flag integer.
     */
    function verb2flags(string ...$methods): int;
}
