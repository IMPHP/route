# [Route](route.md) / OrderedStack
 > im\route\OrderedStack
____

## Description
Provides an implementation of `im\route\MiddlewareStack`

## Synopsis
```php
class OrderedStack implements im\route\MiddlewareStack, im\http\Verbs, im\route\StackEngine uses im\http\res\VerbsImpl {

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
    public addEntryProvider(im\route\MiddlewareEntryProvider $provider): void
    public addMiddleware(im\route\Middleware|callable|string $middleware, int $order = 0, int $flags = im\http\Verbs::ANY): void
    public process(im\http\msg\Request $request): im\http\msg\Response
    public verb2flags(string ...$methods): int
}
```

## Constants
| Name | Description |
| :--- | :---------- |
| [__OrderedStack&nbsp;::&nbsp;GET__](route-OrderedStack-prop_GET.md) |  |
| [__OrderedStack&nbsp;::&nbsp;HEAD__](route-OrderedStack-prop_HEAD.md) |  |
| [__OrderedStack&nbsp;::&nbsp;POST__](route-OrderedStack-prop_POST.md) |  |
| [__OrderedStack&nbsp;::&nbsp;PUT__](route-OrderedStack-prop_PUT.md) |  |
| [__OrderedStack&nbsp;::&nbsp;DELETE__](route-OrderedStack-prop_DELETE.md) |  |
| [__OrderedStack&nbsp;::&nbsp;CONNECT__](route-OrderedStack-prop_CONNECT.md) |  |
| [__OrderedStack&nbsp;::&nbsp;OPTIONS__](route-OrderedStack-prop_OPTIONS.md) |  |
| [__OrderedStack&nbsp;::&nbsp;TRACE__](route-OrderedStack-prop_TRACE.md) |  |
| [__OrderedStack&nbsp;::&nbsp;PATCH__](route-OrderedStack-prop_PATCH.md) |  |
| [__OrderedStack&nbsp;::&nbsp;ANY__](route-OrderedStack-prop_ANY.md) |  |

## Methods
| Name | Description |
| :--- | :---------- |
| [__OrderedStack&nbsp;::&nbsp;\_\_construct__](route-OrderedStack-__construct.md) |  |
| [__OrderedStack&nbsp;::&nbsp;addEntryProvider__](route-OrderedStack-addEntryProvider.md) |  |
| [__OrderedStack&nbsp;::&nbsp;addMiddleware__](route-OrderedStack-addMiddleware.md) |  |
| [__OrderedStack&nbsp;::&nbsp;process__](route-OrderedStack-process.md) |  |
| [__OrderedStack&nbsp;::&nbsp;verb2flags__](route-OrderedStack-verb2flags.md) | Return flags based on one or more string methods |
