# [Route](route.md) / MiddlewareEntry
 > im\route\MiddlewareEntry
____

## Description
This interface is used to define a middleware entry

The interface is used together with `MiddlewareEntryProvider`, to
provide middleware to a stack.

## Synopsis
```php
interface MiddlewareEntry {

    // Properties
    int $order
    int $flags
    string|Middleware|callable $controller
}
```

## Properties
| Name | Description |
| :--- | :---------- |
| [__MiddlewareEntry&nbsp;::&nbsp;$order__](route-MiddlewareEntry-var_order.md) | The order in which to run this middleware relative to others |
| [__MiddlewareEntry&nbsp;::&nbsp;$flags__](route-MiddlewareEntry-var_flags.md) | Flags indicating which request methods this middleware is for |
| [__MiddlewareEntry&nbsp;::&nbsp;$controller__](route-MiddlewareEntry-var_controller.md) | The controller to load for this route |
