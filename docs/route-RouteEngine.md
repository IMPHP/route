# [Route](route.md) / RouteEngine
 > im\route\RouteEngine
____

## Description
Defines a router interface for launching controllers.

## Synopsis
```php
interface RouteEngine {

    // Methods
    getRoutePath(string $name, array $args = Array): null|string
    process(im\http\msg\Request $request): im\http\msg\Response
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__RouteEngine&nbsp;::&nbsp;getRoutePath__](route-RouteEngine-getRoutePath.md) | Built a complete path from a named route |
| [__RouteEngine&nbsp;::&nbsp;process__](route-RouteEngine-process.md) | Start processing a request |
