# [Route](route.md) / [Router](route-Router.md) :: addRoute
 > im\route\Router
____

## Description
Add a route to this router.

## Synopsis
```php
addRoute(string $path, im\route\Controller|callable|string $controller, int $flags = im\route\MethodFlags::M_ANY): void
```

## Parameters
| Name | Description |
| :--- | :---------- |
| path | Path to access this controller |
| controller | A controller. This may also be a string for a `Controller` class or a callable. |
| flags | Flags that defines what request methods are to be used with this controller |
