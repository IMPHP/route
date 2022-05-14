# [Route](route.md) / MiddlewareStack
 > im\route\MiddlewareStack
____

## Description
Defines an extended Middleware stack

## Synopsis
```php
interface MiddlewareStack implements im\route\StackEngine, im\http\Verbs {

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
    addEntryProvider(im\route\MiddlewareEntryProvider $provider): void
    addMiddleware(im\route\Middleware|callable|string $middleware, int $order = 0, int $flags = im\http\Verbs::ANY): void

    // Inherited Methods
    process(im\http\msg\Request $request): im\http\msg\Response
    verb2flags(string ...$methods): int
}
```

## Constants
| Name | Description |
| :--- | :---------- |
| [__MiddlewareStack&nbsp;::&nbsp;GET__](route-MiddlewareStack-prop_GET.md) |  |
| [__MiddlewareStack&nbsp;::&nbsp;HEAD__](route-MiddlewareStack-prop_HEAD.md) |  |
| [__MiddlewareStack&nbsp;::&nbsp;POST__](route-MiddlewareStack-prop_POST.md) |  |
| [__MiddlewareStack&nbsp;::&nbsp;PUT__](route-MiddlewareStack-prop_PUT.md) |  |
| [__MiddlewareStack&nbsp;::&nbsp;DELETE__](route-MiddlewareStack-prop_DELETE.md) |  |
| [__MiddlewareStack&nbsp;::&nbsp;CONNECT__](route-MiddlewareStack-prop_CONNECT.md) |  |
| [__MiddlewareStack&nbsp;::&nbsp;OPTIONS__](route-MiddlewareStack-prop_OPTIONS.md) |  |
| [__MiddlewareStack&nbsp;::&nbsp;TRACE__](route-MiddlewareStack-prop_TRACE.md) |  |
| [__MiddlewareStack&nbsp;::&nbsp;PATCH__](route-MiddlewareStack-prop_PATCH.md) |  |
| [__MiddlewareStack&nbsp;::&nbsp;ANY__](route-MiddlewareStack-prop_ANY.md) |  |

## Methods
| Name | Description |
| :--- | :---------- |
| [__MiddlewareStack&nbsp;::&nbsp;addEntryProvider__](route-MiddlewareStack-addEntryProvider.md) | Add a `MiddlewareEntryProvider` to this stack |
| [__MiddlewareStack&nbsp;::&nbsp;addMiddleware__](route-MiddlewareStack-addMiddleware.md) | Add a middleware to this stack |
| [__MiddlewareStack&nbsp;::&nbsp;process__](route-MiddlewareStack-process.md) | Start processing the first or next middleware in the stack |
| [__MiddlewareStack&nbsp;::&nbsp;verb2flags__](route-MiddlewareStack-verb2flags.md) | Return flags based on one or more string methods |
