# [Route](route.md) / OrderedStack
 > im\route\OrderedStack
____

## Description
Provides an implementation of `im\route\MiddlewareStack`

## Synopsis
```php
class OrderedStack implements im\route\MiddlewareStack, im\route\MethodFlags {

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
    public getFlags(string ...$methods): int
    public addMiddleware(im\route\Middleware|callable|string $middleware, int $flags = im\route\MiddlewareStack::M_ANY): void
    public process(im\http\msg\Request $request): im\http\msg\Response
}
```

## Constants
| Name | Description |
| :--- | :---------- |
| [__OrderedStack&nbsp;::&nbsp;M\_GET__](route-OrderedStack-prop_M_GET.md) |  |
| [__OrderedStack&nbsp;::&nbsp;M\_HEAD__](route-OrderedStack-prop_M_HEAD.md) |  |
| [__OrderedStack&nbsp;::&nbsp;M\_POST__](route-OrderedStack-prop_M_POST.md) |  |
| [__OrderedStack&nbsp;::&nbsp;M\_PUT__](route-OrderedStack-prop_M_PUT.md) |  |
| [__OrderedStack&nbsp;::&nbsp;M\_DELETE__](route-OrderedStack-prop_M_DELETE.md) |  |
| [__OrderedStack&nbsp;::&nbsp;M\_CONNECT__](route-OrderedStack-prop_M_CONNECT.md) |  |
| [__OrderedStack&nbsp;::&nbsp;M\_OPTIONS__](route-OrderedStack-prop_M_OPTIONS.md) |  |
| [__OrderedStack&nbsp;::&nbsp;M\_TRACE__](route-OrderedStack-prop_M_TRACE.md) |  |
| [__OrderedStack&nbsp;::&nbsp;M\_PATCH__](route-OrderedStack-prop_M_PATCH.md) |  |
| [__OrderedStack&nbsp;::&nbsp;M\_ANY__](route-OrderedStack-prop_M_ANY.md) |  |

## Methods
| Name | Description |
| :--- | :---------- |
| [__OrderedStack&nbsp;::&nbsp;\_\_construct__](route-OrderedStack-__construct.md) |  |
| [__OrderedStack&nbsp;::&nbsp;getFlags__](route-OrderedStack-getFlags.md) |  |
| [__OrderedStack&nbsp;::&nbsp;addMiddleware__](route-OrderedStack-addMiddleware.md) |  |
| [__OrderedStack&nbsp;::&nbsp;process__](route-OrderedStack-process.md) |  |
