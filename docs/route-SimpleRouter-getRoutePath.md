# [Route](route.md) / [SimpleRouter](route-SimpleRouter.md) :: getRoutePath
 > im\route\SimpleRouter
____

## Description
Built a complete path from a named route.

This method takes a route based on it's name and replaced any
arguments with ones parsed in this call.

## Synopsis
```php
public getRoutePath(string $name, array $args = Array, null|string $wildcard = NULL): null|string
```

## Parameters
| Name | Description |
| :--- | :---------- |
| name | Name of the route |
| args | Arguments to replace within the route |
| wildcard | An optional sub-path that will replace a wilcard `/*` |

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
