# [Route](route.md) / MiddlewareRouter
 > im\route\MiddlewareRouter
____

## Description
An implementation of `im\route\Router` that works as a middleware.

This router can be added as middleware to a `MiddlewareStack`.

## Synopsis
```php
class MiddlewareRouter implements im\route\Middleware, im\route\Router, im\http\Verbs uses im\http\res\VerbsImpl {

    // Inherited Constants
    public int GET = 0x01
    public int HEAD = 0x02
    public int POST = 0x04
    public int PUT = 0x08
    public int DELETE = 0x10
    public int CONNECT = 0x20
    public int OPTIONS = 0x40
    public int TRACE = 0x80
    public int PATCH = 0x0100
    public int ANY = 0x01FF

    // Methods
    public __construct()
    public addRoute(string $path, im\route\Controller|callable|string $controller, int $flags = im\http\Verbs::ANY): void
    public addNamedRoute(string $name, string $path, im\route\Controller|callable|string $controller, int $flags = im\http\Verbs::ANY): void
    public getRoutePath(string $name, array $args = Array): null|string
    public process(im\http\msg\Request $request): im\http\msg\Response
    public verb2flags(string ...$methods): int
}
```

## Constants
| Name | Description |
| :--- | :---------- |
| [__MiddlewareRouter&nbsp;::&nbsp;GET__](route-MiddlewareRouter-prop_GET.md) |  |
| [__MiddlewareRouter&nbsp;::&nbsp;HEAD__](route-MiddlewareRouter-prop_HEAD.md) |  |
| [__MiddlewareRouter&nbsp;::&nbsp;POST__](route-MiddlewareRouter-prop_POST.md) |  |
| [__MiddlewareRouter&nbsp;::&nbsp;PUT__](route-MiddlewareRouter-prop_PUT.md) |  |
| [__MiddlewareRouter&nbsp;::&nbsp;DELETE__](route-MiddlewareRouter-prop_DELETE.md) |  |
| [__MiddlewareRouter&nbsp;::&nbsp;CONNECT__](route-MiddlewareRouter-prop_CONNECT.md) |  |
| [__MiddlewareRouter&nbsp;::&nbsp;OPTIONS__](route-MiddlewareRouter-prop_OPTIONS.md) |  |
| [__MiddlewareRouter&nbsp;::&nbsp;TRACE__](route-MiddlewareRouter-prop_TRACE.md) |  |
| [__MiddlewareRouter&nbsp;::&nbsp;PATCH__](route-MiddlewareRouter-prop_PATCH.md) |  |
| [__MiddlewareRouter&nbsp;::&nbsp;ANY__](route-MiddlewareRouter-prop_ANY.md) |  |

## Methods
| Name | Description |
| :--- | :---------- |
| [__MiddlewareRouter&nbsp;::&nbsp;\_\_construct__](route-MiddlewareRouter-__construct.md) |  |
| [__MiddlewareRouter&nbsp;::&nbsp;addRoute__](route-MiddlewareRouter-addRoute.md) | Add a route to this router |
| [__MiddlewareRouter&nbsp;::&nbsp;addNamedRoute__](route-MiddlewareRouter-addNamedRoute.md) |  |
| [__MiddlewareRouter&nbsp;::&nbsp;getRoutePath__](route-MiddlewareRouter-getRoutePath.md) | Built a complete path from a named route |
| [__MiddlewareRouter&nbsp;::&nbsp;process__](route-MiddlewareRouter-process.md) | Manually process a request |
| [__MiddlewareRouter&nbsp;::&nbsp;verb2flags__](route-MiddlewareRouter-verb2flags.md) | Return flags based on one or more string methods |
