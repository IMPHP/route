# [Route](route.md) / [HTTP](http.md) / Verbs
 > im\http\Verbs
____

## Description
This is used to define request methods as flags.
This allows them to be easily grouped together and identified without much overheat.

## Synopsis
```php
interface Verbs {

    // Constants
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
    verb2flags(string ...$methods): int
}
```

## Constants
| Name | Description |
| :--- | :---------- |
| [__Verbs&nbsp;::&nbsp;GET__](http-Verbs-prop_GET.md) |  |
| [__Verbs&nbsp;::&nbsp;HEAD__](http-Verbs-prop_HEAD.md) |  |
| [__Verbs&nbsp;::&nbsp;POST__](http-Verbs-prop_POST.md) |  |
| [__Verbs&nbsp;::&nbsp;PUT__](http-Verbs-prop_PUT.md) |  |
| [__Verbs&nbsp;::&nbsp;DELETE__](http-Verbs-prop_DELETE.md) |  |
| [__Verbs&nbsp;::&nbsp;CONNECT__](http-Verbs-prop_CONNECT.md) |  |
| [__Verbs&nbsp;::&nbsp;OPTIONS__](http-Verbs-prop_OPTIONS.md) |  |
| [__Verbs&nbsp;::&nbsp;TRACE__](http-Verbs-prop_TRACE.md) |  |
| [__Verbs&nbsp;::&nbsp;PATCH__](http-Verbs-prop_PATCH.md) |  |
| [__Verbs&nbsp;::&nbsp;ANY__](http-Verbs-prop_ANY.md) |  |

## Methods
| Name | Description |
| :--- | :---------- |
| [__Verbs&nbsp;::&nbsp;verb2flags__](http-Verbs-verb2flags.md) | Return flags based on one or more string methods |
