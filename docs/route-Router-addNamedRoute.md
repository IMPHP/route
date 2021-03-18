# [Route](route.md) / [Router](route-Router.md) :: addNamedRoute
 > im\route\Router
____

## Description
Add a named route to this router.

This is similar to `addRoute()` only this allows you to built
a complete path using `getRoutePath()`.

## Synopsis
```php
addNamedRoute(string $name, string $path, im\route\Controller|callable|string $controller, int $flags = im\route\MethodFlags::M_ANY): void
```

## Parameters
| Name | Description |
| :--- | :---------- |
| name | Name of this route |
| path | Path to access this controller |
| controller | A controller. This may also be a string for a `Controller` class or a callable. |
| flags | Flags that defines what request methods are to be used with this controller |
