# [Route](route.md) / RouteEntry
 > im\route\RouteEntry
____

## Description
This interface is used to define a route entry

The interface is used together with `RouteEntryProvider`, to
provide routes to a router.

## Synopsis
```php
interface RouteEntry {

    // Properties
    string $name
    string $route
    int $flags
    string|Controller|callable $controller
}
```

## Properties
| Name | Description |
| :--- | :---------- |
| [__RouteEntry&nbsp;::&nbsp;$name__](route-RouteEntry-var_name.md) | Optional name of the route |
| [__RouteEntry&nbsp;::&nbsp;$route__](route-RouteEntry-var_route.md) | The actual route path |
| [__RouteEntry&nbsp;::&nbsp;$flags__](route-RouteEntry-var_flags.md) | Flags indicating which request methods this route is for |
| [__RouteEntry&nbsp;::&nbsp;$controller__](route-RouteEntry-var_controller.md) | The controller to load for this route |
