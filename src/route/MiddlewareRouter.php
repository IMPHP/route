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

namespace im\route;

use im\http\msg\HttpResponse;
use im\http\msg\HttpResponseBuilder;
use im\http\msg\Request;
use im\http\msg\Response;
use im\http\Verbs;
use im\http\res\VerbsImpl;
use im\util\MutableListArray;
use im\util\Vector;
use im\util\Map;
use im\util\StringBuilder;
use Exception;
use stdClass;

/**
 * An implementation of `im\route\Router` that works as a middleware.
 *
 * This router can be added as middleware to a `MiddlewareStack`.
 */
class MiddlewareRouter implements Middleware, Router {

    use VerbsImpl;

    /** @internal */
    protected MutableListArray $routes;

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
    public function addRoute(string $path, string|Controller|callable $controller, int $flags = Verbs::ANY): void {
        $routeInfo = new stdClass();
        $routeInfo->name = null;
        $routeInfo->flags = $flags;
        $routeInfo->route = $path;
        $routeInfo->controller = $controller;

        $this->routes->add($routeInfo);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\route\Router")]
    public function addNamedRoute(string $name, string $path, string|Controller|callable $controller, int $flags = Verbs::ANY): void {
        $routeInfo = new stdClass();
        $routeInfo->name = $name;
        $routeInfo->flags = $flags;
        $routeInfo->route = $path;
        $routeInfo->controller = $controller;

        $this->routes->add($routeInfo);
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
     * @return
     *      This will return `NULL` if the named route does not exist
     */
    #[Override("im\route\Router")]
    public function getRoutePath(string $name, array $args = []): ?string {
        foreach ($this->routes as $routeInfo) {
            if (!empty($routeInfo->name) && $routeInfo->name == $name) {
                $route = $routeInfo->route;

                foreach ($args as $key => $value) {
                    $route = preg_replace("/\{".preg_quote($key)."(\:[^\}]+)?\}/", (string) $value, $route);
                }

                $route = preg_replace("/\\?{[^\}]+\}/", "", $route);
                $route = rtrim(str_replace(["?", "/*", "//"], ["", "", "/"], $route), "/");

                return empty($route) ? "/" : $route;
            }
        }

        return null;
    }

    /**
     * Translates a route into a proper RegExp that can be used to match
     * a request path.
     *
     * @internal
     */
    protected function compileRoute(string $route): string {
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
     * Manually process a request
     *
     * @note
     *      This router is built as a middleware. Rather than executing a request manually,
     *      it can be added and executed from within a `im\route\MiddlewareStack`.
     *
     * @param $request
     *      A request to process
     *
     */
    #[Override("im\route\Router")]
    public function process(Request $request): Response {
        return $this->onProcess(
            $request,
            new class() implements MiddlewareStack {
                function addMiddleware(string|Middleware|callable $middleware, int $flags = Verbs::ANY): void {}
                function process(Request $request): Response {
                    return new HttpResponse();
                }
            }
        );
    }

    /**
     *
     *
     * @internal
     */
    #[Override("im\route\Middleware")]
    public function onProcess(Request $request, MiddlewareStack $stack): Response {
        $controller = null;
        $path = $request->getUri()->getPath();
        $flag = $this->verb2flags( $request->getMethod() );

        foreach ($this->routes as $routeInfo) {
            if ($routeInfo->flags & $flag) {
                $route = $this->compileRoute($routeInfo->route);

                if (preg_match($route, $path, $matches)) {
                    if (is_string($routeInfo->controller) && $routeInfo->controller[0] == "/") {
                        $controller = $routeInfo->controller;

                        /*
                         * Redirect, example: '/new/path'
                         */
                         if (strpos($controller, "$") !== false) {
                             // Copy part of the original url '/old/:num:' -> '/new/path/$1'
                             $controller = preg_replace($route, $controller, $path);
                         }

                         $uri = $request->getUri()->getBuilder();
                         $uri->setPath($controller);
                         $request->setUri($uri);

                         return $this->onProcess($request, $stack);
                    }

                    if (is_string($routeInfo->controller)
                            && class_exists($routeInfo->controller, true)
                            && is_subclass_of($routeInfo->controller, Controller::class)) {

                        $controller = new ($routeInfo->controller)();

                    } else if (is_callable($routeInfo->controller)
                            || (!is_string($routeInfo->controller) && $routeInfo->controller instanceof Controller)) {

                        $controller = $routeInfo->controller;

                    } else {
                        throw new Exception("The class '". (is_string($routeInfo->controller) ? $routeInfo->controller : get_class($routeInfo->controller)) ."' must be a member of '". Controller::class ."'");
                    }

                    $request = $request->getBuilder();
                    $request->setParam("route", new Map( array_filter($matches, "is_string", ARRAY_FILTER_USE_KEY) ));

                    break;
                }
            }
        }

        if ($controller == null) {
            return new HttpResponseBuilder(Response::STATUS_NOT_FOUND);

        } else if ($controller instanceof Controller) {
            return $controller->onProcessRequest($this, $request, $stack->process($request));

        } else {
            return $controller($this, $request, $stack->process($request));
        }
    }
}
