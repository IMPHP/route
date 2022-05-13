# [Route](route.md) / [MiddlewareRouter](route-MiddlewareRouter.md) :: addRoute
 > im\route\MiddlewareRouter
____

## Description
Add a route to this router.

__$path__

A path may contain parameters wrapped in `{}` like `/path/{id}`.
The `id` will match anything with letters, numbers and a few characters like `-`, `_` and `.`.
You may also specify a more narrow type like `/path/{id:number}` which will only match numbers and `.`.

|  Name     |  Match              |
| --------- | -----------------   |
| int       | [0-9]               |
| number    | [0-9\.]             |
| alpha     | [A-Za-z\-_]         |
| word      | [A-Za-z_ ]          |
| (default) | [A-Za-z0-9\:\.\-_ ] |

Some times you may have a few static options within a path. This can be done using `/path/{type:[login|logout]}`
which will only match `/path/login` and `/path/logout` and nothing else.

If you need to specify a partial path, you can do this using the `*` wildcard like `/path/{id}/*`.
This will match anything that begins with `/path/{id}`.

You may also make a path segment optional by prepending `?` to it like `/path/?{id}`
which will also match just `/path`.

Route arguments does not have to be a complete segment. You can add partial parts of a segment also
like `/path/user_{id:int}` which will match `/path/user_1`. This may also be optional using `/path/?user_{id:int}`.

__Accessing Parameters__

All parameter values during a request can be accessed via the `Request` object by using the param option `route`.
This option contains a `Map` with all the available route parameters.

__$controller__

Instead of a controller, you may also add a path instead. If a path is used, it will start an internal
redirect to a different route. The entire middleware stack will be re-launched with a new and altered
request object that matches the new path. The client will be unaware of this redirect.

## Synopsis
```php
public addRoute(string $path, im\route\Controller|callable|string $controller, int $flags = im\http\Verbs::ANY): void
```

## Parameters
| Name | Description |
| :--- | :---------- |
| path | Path to access this controller |
| controller | A controller. This may also be a string for a `Controller` class or a callable. |
| flags | Flags that defines what request methods are to be used with this controller |

## Example 1
```php
$router = new SimpleRouter();
$router->addRoute("/path/{id:int}", function(Request $request, Router $router): Response {
    $response = new HttpResponseBuilder();

    if ($request->getParam("route")->get("id") == 1) {
        $response->setStatus(Response::STATUS_ACCEPTED);
    }

    return $response;
});

// Redirect '/path/user/10' to '/path/10'
$router->addRoute("/path/user/{id:int}", "/path/$1");

$stack = new OrderedStack();
$stack->addMiddleware($router);

$response = $stack->process( new HttpRequestBuilder("GET", new HttpUriBuilder("http://domain.com/path/1")) );
```
