# [Route](route.md) / Router
 > im\route\Router
____

## Description
Defines an extended router interface.

## Synopsis
```php
interface Router implements im\route\RouteEngine, im\http\Verbs {

    // Inherited Constants
    int GET = 0x01
    int HEAD = 0x02
    int POST = 0x04
    int PUT = 0x08
    int DELETE = 0x10
    int CONNECT = 0x20
    int OPTIONS = 0x40
    int TRACE = 0x80
    int PATCH = 0x0100
    int ANY = 0x01FF

    // Methods
    addEntryProvider(im\route\RouteEntryProvider $provider): void
    addRoute(string $path, im\route\Controller|callable|string $controller, int $flags = im\http\Verbs::ANY): void
    addNamedRoute(string $name, string $path, im\route\Controller|callable|string $controller, int $flags = im\http\Verbs::ANY): void

    // Inherited Methods
    getRoutePath(string $name, array $args = Array): null|string
    process(im\http\msg\Request $request): im\http\msg\Response
    verb2flags(string ...$methods): int
}
```

## Constants
| Name | Description |
| :--- | :---------- |
| [__Router&nbsp;::&nbsp;GET__](route-Router-prop_GET.md) |  |
| [__Router&nbsp;::&nbsp;HEAD__](route-Router-prop_HEAD.md) |  |
| [__Router&nbsp;::&nbsp;POST__](route-Router-prop_POST.md) |  |
| [__Router&nbsp;::&nbsp;PUT__](route-Router-prop_PUT.md) |  |
| [__Router&nbsp;::&nbsp;DELETE__](route-Router-prop_DELETE.md) |  |
| [__Router&nbsp;::&nbsp;CONNECT__](route-Router-prop_CONNECT.md) |  |
| [__Router&nbsp;::&nbsp;OPTIONS__](route-Router-prop_OPTIONS.md) |  |
| [__Router&nbsp;::&nbsp;TRACE__](route-Router-prop_TRACE.md) |  |
| [__Router&nbsp;::&nbsp;PATCH__](route-Router-prop_PATCH.md) |  |
| [__Router&nbsp;::&nbsp;ANY__](route-Router-prop_ANY.md) |  |

## Methods
| Name | Description |
| :--- | :---------- |
| [__Router&nbsp;::&nbsp;addEntryProvider__](route-Router-addEntryProvider.md) | Add a `RouteEntryProvider` to this router |
| [__Router&nbsp;::&nbsp;addRoute__](route-Router-addRoute.md) | Add a route to this router |
| [__Router&nbsp;::&nbsp;addNamedRoute__](route-Router-addNamedRoute.md) | Add a named route to this router |
| [__Router&nbsp;::&nbsp;getRoutePath__](route-Router-getRoutePath.md) | Built a complete path from a named route |
| [__Router&nbsp;::&nbsp;process__](route-Router-process.md) | Start processing a request |
| [__Router&nbsp;::&nbsp;verb2flags__](route-Router-verb2flags.md) | Return flags based on one or more string methods |
