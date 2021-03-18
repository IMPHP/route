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
use im\util\ListArray;
use im\util\Vector;
use im\util\Map;
use im\util\StringBuilder;
use Exception;

/**
 * An implementation of `im\route\Router` that works as a middleware.
 *
 * This router is added as middleware to a `MiddlewareStack`.
 * It should always be the top middleware in the stack as it will not
 * progress any higher. It will launch a controller and then start to
 * return the response.
 */
class SimpleRouter implements Middleware, Router {

    /** @internal */
    protected ListArray $routes;

    /**
     *
     */
    public function __construct() {
        $this->routes = new Vector();
    }

    /**
     * Add a route to this router.
     *
     * __$path__
     *
     * A path may contain parameters wrapped in `{}` like `/path/{id}`.
     * The `id` will match anything with letters, numbers and a few characters like `-`, `_` and `.`.
     * You may also specify a more narrow type like `/path/{id:number}` which will only match numbers and `.`.
     *
     * |  Name     |  Match              |
     * | --------- | -----------------   |
     * | int       | [0-9]               |
     * | number    | [0-9\.]             |
     * | alpha     | [A-Za-z\-_]         |
     * | word      | [A-Za-z_ ]          |
     * | (default) | [A-Za-z0-9\:\.\-_ ] |
     *
     * Some times you may have a few static options within a path. This can be done using `/path/{type:[login|logout]}`
     * which will only match `/path/login` and `/path/logout` and nothing else.
     *
     * If you need to specify a partial path, you can do this using the `*` wildcard like `/path/{id}/*`.
     * This will match anything that begins with `/path/{id}`.
     *
     * You may also make a path segment optional by prepending `?` to it like `/path/?{id}`
     * which will also match just `/path`.
     *
     * Route arguments does not have to be a complete segment. You can add partial parts of a segment also
     * like `/path/user_{id:int}` which will match `/path/user_1`. This may also be optional using `/path/?user_{id:int}`.
     *
     * __Accessing Parameters__
     *
     * All parameter values during a request can be accessed via the `Request` object by using the param option `route`.
     * This option contains a `Map` with all the available route parameters.
     *
     * __$controller__
     *
     * Instead of a controller, you may also add a path instead. If a path is used, it will start an internal
     * redirect to a different route. The entire middleware stack will be re-launched with a new and altered
     * request object that matches the new path. The client will be unaware of this redirect.
     *
     * @example
     *
     *      ```php
     *      $router = new SimpleRouter();
     *      $router->addRoute("/path/{id:int}", function(Request $request, Router $router): Response {
     *          $response = new HttpResponseBuilder();
     *
     *          if ($request->getParam("route")->get("id") == 1) {
     *              $response->setStatus(Response::STATUS_ACCEPTED);
     *          }
     *
     *          return $response;
     *      });
     *
     *      // Redirect '/path/user/10' to '/path/10'
     *      $router->addRoute("/path/user/{id:int}", "/path/$1");
     *
     *      $stack = new OrderedStack();
     *      $stack->addMiddleware($router);
     *
     *      $response = $stack->process( new HttpRequestBuilder("GET", new HttpUriBuilder("http://domain.com/path/1")) );
     *      ```
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
    #[Override("im\route\Router")]
    public function addRoute(string $path, string|Controller|callable $controller, int $flags = Router::M_ANY): void {
        $this->routes->add([
            "name" => null,
            "flags" => $flags,
            "route" => $path,
            "class" => $controller
        ]);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\route\Router")]
    public function addNamedRoute(string $name, string $path, string|Controller|callable $controller, int $flags = Router::M_ANY): void {
        $this->routes->add([
            "name" => $name,
            "flags" => $flags,
            "route" => $path,
            "class" => $controller
        ]);
    }

    /**
     * Built a complete path from a named route.
     *
     * This method takes a route based on it's name and replaced any
     * arguments with ones parsed in this call.
     *
     * @example
     *
     *      ```php
     *      $router = new SimpleRouter();
     *      $router->addNamedRoute("user", "/path/user/{id:int}", "SomeClass");
     *
     *      echo $router->getRoutePath("user", ["id" => 10]);
     *      ```
     *
     *      ```
     *      Output: /path/user/10
     *      ```
     *
     * @param $name
     *      Name of the route
     *
     * @param $args
     *      Arguments to replace within the route
     *
     * @param $wildcard
     *      An optional sub-path that will replace a wilcard `/*`
     *
     * @return
     *      This will return `NULL` if the named route does not exist
     */
    #[Override("im\route\Router")]
    public function getRoutePath(string $name, array $args = [], string $wildcard = null): ?string {
        foreach ($this->routes as $pair) {
            if (!empty($pair["name"]) && $pair["name"] == $name) {
                $route = $pair["route"];

                if (!empty($wildcard)) {
                    $wildcard = "/".trim($wildcard, "/");
                }

                foreach ($args as $key => $value) {
                    $route = preg_replace("/\{".preg_quote($key)."(\:[^\}]+)?\}/", (string) $value, $route);
                }

                $route = preg_replace("/\\?{[^\}]+\}/", "", $route);
                $route = rtrim(str_replace(["?", "/*", "//"], ["", $wildcard ?? "", "/"], $route), "/");

                return empty($route) ? "/" : $route;
            }
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\route\Router")]
    public function getFlags(string ...$methods): int {
        $flags = 0;

        foreach ($methods as $method) {
            $const = sprintf("%s::M_%s", Router::class, strtoupper($method));

            if (!defined($const)) {
                throw new Exception("Trying to use invalid method '$method'");
            }

            $flags |= constant($const);
        }

        return $flags;
    }

    /**
     * Translates a route into a proper RegExp that can be used to match
     * a request path.
     *
     * @internal
     */
    protected function makeRegExp(string $route): string {
        if (empty($route) || $route == "/") {
            return "/^\\/?$/";
        }

        $str = new StringBuilder();

        foreach (explode("/", trim($route, "/")) as $segment) {
            if ($optional = $segment[0] == "?") {
                /*
                 * Path: /segment/?:any:
                 */
                $segment = substr($segment, 1);
            }

            if ($segment != "*") {
                $segment = preg_replace_callback("/\\\{(?<name>[a-z]+)(?:\\\:(?<type>(?:int|number|alpha|word|\\\[[A-Za-z0-9\.\-_\\\|]+\\\])))?\\\}/", function ($matches) {
                    if (!empty($matches["type"])) {
                        if (str_starts_with($matches["type"], "\\[")) {
                            return "(?<{$matches["name"]}>".str_replace("\\|", "|", substr($matches["type"], 2, -2)).")";

                        } else {
                            return match ($matches["type"]) {
                                "int" => "(?<{$matches["name"]}>[0-9]+)",
                                "number" => "(?<{$matches["name"]}>[0-9\.]+)",
                                "alpha" => "(?<{$matches["name"]}>[A-Za-z\-_]+)",
                                "word" => "(?<{$matches["name"]}>[A-Za-z_ ]+)"
                            };
                        }

                    } else {
                        return "(?<{$matches["name"]}>[A-Za-z0-9\.\:\-_ ]+)";
                    }

                }, preg_quote($segment));

                $str->append(
                    $optional ? sprintf("(?:\\/%s)?", $segment) : sprintf("\\/%s", $segment)
                );

            } else {
                $str->append("(?:\/(?:[^\/]+)?)*");
            }
        }

        return "/^". $str->toString() ."$/";
    }

    /**
     * Launches the router instance to locate a run a controller
     *
     * @internal
     */
    #[Override("im\route\Middleware")]
    public function onProcess(Request $request, MiddlewareStack $stack): Response {
        $controller = null;
        $path = $request->getUri()->getPath();
        $method = $request->getMethod();
        $flag = $stack->getFlags($method);

        foreach ($this->routes as $pair) {
            if ($pair["flags"] & $flag) {
                $route = $this->makeRegExp($pair["route"]);

                if (preg_match($route, $path, $matches)) {
                    /*
                     * Deal with internal redirects
                     */
                    if (is_string($pair["class"]) && $pair["class"][0] == "/") {
                        /*
                         * Redirect, example: '/new/path'
                         */
                         if (strpos($pair["class"], "$") !== false) {
                             // Copy part of the original url '/old/:num:' -> '/new/path/$1'
                             $pair["class"] = preg_replace($route, $pair["class"], $path);
                         }

                         $uri = $request->getUri()->getBuilder();
                         $uri->setPath($pair["class"]);

                         // Tell the calling middleware that we are not doing any more work on this
                         $response = new HttpResponseBuilder(Response::STATUS_PERMANENT_REDIRECT);
                         $response->setHeader("Location", $uri->toString());

                         return $response;
                    }

                    if (is_string($pair["class"])) {
                        if (!class_exists($pair["class"], true)
                                || !is_subclass_of($pair["class"], Controller::class)) {

                            throw new Exception("Controller class '". $pair["class"] ."' could not be found or is not part of '". Controller::class ."'");
                        }

                        $controller = new ($pair["class"])();

                    } else {
                        $controller = $pair["class"];
                    }

                    $segments = new Map( array_filter($matches, "is_string", ARRAY_FILTER_USE_KEY) );
                    $segments->lock();
                    $request = $request->getBuilder();
                    $request->setParam("route", $segments);

                    break;
                }
            }
        }

        if ($controller == null) {
            return new HttpResponseBuilder(Response::STATUS_NOT_FOUND);;

        } else if ($controller instanceof Controller) {
            return $controller->onProcessRequest($request, $this);

        } else {
            return $controller($request, $this);
        }
    }
}
