# [Route](route.md) / [MiddlewareRouter](route-MiddlewareRouter.md) :: getRoutePath
 > im\route\MiddlewareRouter
____

## Description
Built a complete path from a named route.

This method takes a route based on it's name and replaced any
arguments with ones parsed in this call.

## Synopsis
```php
public getRoutePath(string $name, array $args = Array): null|string
```

## Parameters
| Name | Description |
| :--- | :---------- |
| name | Name of the route |
| args | Arguments to replace within the route |

## Return
This will return `NULL` if the named route does not exist

## Example 1
```php
$router = new SimpleRouter();
$router->addNamedRoute("user", "/path/user/{id:int}", "SomeClass");

echo $router->getRoutePath("user", ["id" => 10]);
```

```
Output: /path/user/10
```
