# [Route](route.md) / SimpleRouter
 > im\route\SimpleRouter
____

## Description
An implementation of `im\route\Router` that works as a middleware.

This router is added as middleware to a `MiddlewareStack`.
It should always be the top middleware in the stack as it will not
progress any higher. It will launch a controller and then start to
return the response.

## Synopsis
```php
class SimpleRouter implements im\route\Middleware, im\route\Router, im\route\MethodFlags {

    // Inherited Constants
    public int M_GET = 0x01
    public int M_HEAD = 0x02
    public int M_POST = 0x04
    public int M_PUT = 0x08
    public int M_DELETE = 0x10
    public int M_CONNECT = 0x20
    public int M_OPTIONS = 0x40
    public int M_TRACE = 0x80
    public int M_PATCH = 0x0100
    public int M_ANY = 0x01FF

    // Methods
    public __construct()
    public setLoader(im\route\ControllerLoader|callable $loader): void
    public addRoute(string $path, im\route\Controller|callable|string $controller, int $flags = im\route\Router::M_ANY): void
    public addNamedRoute(string $name, string $path, im\route\Controller|callable|string $controller, int $flags = im\route\Router::M_ANY): void
    public getRoutePath(string $name, array $args = Array, null|string $wildcard = NULL): null|string
    public getFlags(string ...$methods): int
}
```

## Constants
| Name | Description |
| :--- | :---------- |
| [__SimpleRouter&nbsp;::&nbsp;M\_GET__](route-SimpleRouter-prop_M_GET.md) |  |
| [__SimpleRouter&nbsp;::&nbsp;M\_HEAD__](route-SimpleRouter-prop_M_HEAD.md) |  |
| [__SimpleRouter&nbsp;::&nbsp;M\_POST__](route-SimpleRouter-prop_M_POST.md) |  |
| [__SimpleRouter&nbsp;::&nbsp;M\_PUT__](route-SimpleRouter-prop_M_PUT.md) |  |
| [__SimpleRouter&nbsp;::&nbsp;M\_DELETE__](route-SimpleRouter-prop_M_DELETE.md) |  |
| [__SimpleRouter&nbsp;::&nbsp;M\_CONNECT__](route-SimpleRouter-prop_M_CONNECT.md) |  |
| [__SimpleRouter&nbsp;::&nbsp;M\_OPTIONS__](route-SimpleRouter-prop_M_OPTIONS.md) |  |
| [__SimpleRouter&nbsp;::&nbsp;M\_TRACE__](route-SimpleRouter-prop_M_TRACE.md) |  |
| [__SimpleRouter&nbsp;::&nbsp;M\_PATCH__](route-SimpleRouter-prop_M_PATCH.md) |  |
| [__SimpleRouter&nbsp;::&nbsp;M\_ANY__](route-SimpleRouter-prop_M_ANY.md) |  |

## Methods
| Name | Description |
| :--- | :---------- |
| [__SimpleRouter&nbsp;::&nbsp;\_\_construct__](route-SimpleRouter-__construct.md) |  |
| [__SimpleRouter&nbsp;::&nbsp;setLoader__](route-SimpleRouter-setLoader.md) | Set a controller loader for this router |
| [__SimpleRouter&nbsp;::&nbsp;addRoute__](route-SimpleRouter-addRoute.md) | Add a route to this router |
| [__SimpleRouter&nbsp;::&nbsp;addNamedRoute__](route-SimpleRouter-addNamedRoute.md) |  |
| [__SimpleRouter&nbsp;::&nbsp;getRoutePath__](route-SimpleRouter-getRoutePath.md) | Built a complete path from a named route |
| [__SimpleRouter&nbsp;::&nbsp;getFlags__](route-SimpleRouter-getFlags.md) |  |
