# [Route](route.md) / MethodFlags
 > im\route\MethodFlags
____

## Description
This is used to define request methods as flags.
This allows them to be easily grouped together and identified without much overheat.

## Synopsis
```php
interface MethodFlags {

    // Constants
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
    getFlags(string ...$methods): int
}
```

## Constants
| Name | Description |
| :--- | :---------- |
| [__MethodFlags&nbsp;::&nbsp;M\_GET__](route-MethodFlags-prop_M_GET.md) |  |
| [__MethodFlags&nbsp;::&nbsp;M\_HEAD__](route-MethodFlags-prop_M_HEAD.md) |  |
| [__MethodFlags&nbsp;::&nbsp;M\_POST__](route-MethodFlags-prop_M_POST.md) |  |
| [__MethodFlags&nbsp;::&nbsp;M\_PUT__](route-MethodFlags-prop_M_PUT.md) |  |
| [__MethodFlags&nbsp;::&nbsp;M\_DELETE__](route-MethodFlags-prop_M_DELETE.md) |  |
| [__MethodFlags&nbsp;::&nbsp;M\_CONNECT__](route-MethodFlags-prop_M_CONNECT.md) |  |
| [__MethodFlags&nbsp;::&nbsp;M\_OPTIONS__](route-MethodFlags-prop_M_OPTIONS.md) |  |
| [__MethodFlags&nbsp;::&nbsp;M\_TRACE__](route-MethodFlags-prop_M_TRACE.md) |  |
| [__MethodFlags&nbsp;::&nbsp;M\_PATCH__](route-MethodFlags-prop_M_PATCH.md) |  |
| [__MethodFlags&nbsp;::&nbsp;M\_ANY__](route-MethodFlags-prop_M_ANY.md) |  |

## Methods
| Name | Description |
| :--- | :---------- |
| [__MethodFlags&nbsp;::&nbsp;getFlags__](route-MethodFlags-getFlags.md) | Return flags based on one or more string methods |
