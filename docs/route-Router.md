# [Route](route.md) / Router
 > im\route\Router
____

## Description
Defines a router interface for launching controllers.

## Synopsis
```php
interface Router implements im\route\MethodFlags {

    // Inherited Constants
    int M_GET = 0x01
    int M_HEAD = 0x02
    int M_POST = 0x04
    int M_PUT = 0x08
    int M_DELETE = 0x10
    int M_CONNECT = 0x20
    int M_OPTIONS = 0x40
    int M_TRACE = 0x80
    int M_PATCH = 0x0100
    int M_ANY = 0x01FF

    // Methods
    addRoute(string $path, im\route\Controller|callable|string $controller, int $flags = im\route\MethodFlags::M_ANY): void
    addNamedRoute(string $name, string $path, im\route\Controller|callable|string $controller, int $flags = im\route\MethodFlags::M_ANY): void
    getRoutePath(string $name, array $args = Array): null|string

    // Inherited Methods
    getFlags(string ...$methods): int
}
```

## Constants
| Name | Description |
| :--- | :---------- |
| [__Router&nbsp;::&nbsp;M\_GET__](route-Router-prop_M_GET.md) |  |
| [__Router&nbsp;::&nbsp;M\_HEAD__](route-Router-prop_M_HEAD.md) |  |
| [__Router&nbsp;::&nbsp;M\_POST__](route-Router-prop_M_POST.md) |  |
| [__Router&nbsp;::&nbsp;M\_PUT__](route-Router-prop_M_PUT.md) |  |
| [__Router&nbsp;::&nbsp;M\_DELETE__](route-Router-prop_M_DELETE.md) |  |
| [__Router&nbsp;::&nbsp;M\_CONNECT__](route-Router-prop_M_CONNECT.md) |  |
| [__Router&nbsp;::&nbsp;M\_OPTIONS__](route-Router-prop_M_OPTIONS.md) |  |
| [__Router&nbsp;::&nbsp;M\_TRACE__](route-Router-prop_M_TRACE.md) |  |
| [__Router&nbsp;::&nbsp;M\_PATCH__](route-Router-prop_M_PATCH.md) |  |
| [__Router&nbsp;::&nbsp;M\_ANY__](route-Router-prop_M_ANY.md) |  |

## Methods
| Name | Description |
| :--- | :---------- |
| [__Router&nbsp;::&nbsp;addRoute__](route-Router-addRoute.md) | Add a route to this router |
| [__Router&nbsp;::&nbsp;addNamedRoute__](route-Router-addNamedRoute.md) | Add a named route to this router |
| [__Router&nbsp;::&nbsp;getRoutePath__](route-Router-getRoutePath.md) | Built a complete path from a named route |
| [__Router&nbsp;::&nbsp;getFlags__](route-Router-getFlags.md) | Return flags based on one or more string methods |
