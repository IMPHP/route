# [Route](route.md) / [Router](route-Router.md) :: getRoutePath
 > im\route\Router
____

## Description
Built a complete path from a named route.

This method takes a route based on it's name and replaced any
arguments with ones parsed in this call.

## Synopsis
```php
getRoutePath(string $name, array $args = Array): null|string
```

## Parameters
| Name | Description |
| :--- | :---------- |
| name | Name of the route |
| args | Arguments to replace within the route |

## Return
This will return `NULL` if the named route does not exist
