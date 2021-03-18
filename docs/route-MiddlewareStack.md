# [Route](route.md) / MiddlewareStack
 > im\route\MiddlewareStack
____

## Description
Defines a Middleware stack

## Synopsis
```php
interface MiddlewareStack implements im\route\MethodFlags {

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
    addMiddleware(im\route\Middleware|callable|string $middleware, int $flags = im\route\MethodFlags::M_ANY): void
    process(im\http\msg\Request $request): im\http\msg\Response

    // Inherited Methods
    getFlags(string ...$methods): int
}
```

## Constants
| Name | Description |
| :--- | :---------- |
| [__MiddlewareStack&nbsp;::&nbsp;M\_GET__](route-MiddlewareStack-prop_M_GET.md) |  |
| [__MiddlewareStack&nbsp;::&nbsp;M\_HEAD__](route-MiddlewareStack-prop_M_HEAD.md) |  |
| [__MiddlewareStack&nbsp;::&nbsp;M\_POST__](route-MiddlewareStack-prop_M_POST.md) |  |
| [__MiddlewareStack&nbsp;::&nbsp;M\_PUT__](route-MiddlewareStack-prop_M_PUT.md) |  |
| [__MiddlewareStack&nbsp;::&nbsp;M\_DELETE__](route-MiddlewareStack-prop_M_DELETE.md) |  |
| [__MiddlewareStack&nbsp;::&nbsp;M\_CONNECT__](route-MiddlewareStack-prop_M_CONNECT.md) |  |
| [__MiddlewareStack&nbsp;::&nbsp;M\_OPTIONS__](route-MiddlewareStack-prop_M_OPTIONS.md) |  |
| [__MiddlewareStack&nbsp;::&nbsp;M\_TRACE__](route-MiddlewareStack-prop_M_TRACE.md) |  |
| [__MiddlewareStack&nbsp;::&nbsp;M\_PATCH__](route-MiddlewareStack-prop_M_PATCH.md) |  |
| [__MiddlewareStack&nbsp;::&nbsp;M\_ANY__](route-MiddlewareStack-prop_M_ANY.md) |  |

## Methods
| Name | Description |
| :--- | :---------- |
| [__MiddlewareStack&nbsp;::&nbsp;addMiddleware__](route-MiddlewareStack-addMiddleware.md) | Add a middleware to this stack |
| [__MiddlewareStack&nbsp;::&nbsp;process__](route-MiddlewareStack-process.md) | Start processing the first or next middleware in the stack |
| [__MiddlewareStack&nbsp;::&nbsp;getFlags__](route-MiddlewareStack-getFlags.md) | Return flags based on one or more string methods |
