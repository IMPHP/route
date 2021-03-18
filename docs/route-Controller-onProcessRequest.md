# [Route](route.md) / [Controller](route-Controller.md) :: onProcessRequest
 > im\route\Controller
____

## Description
Called by the `Router` when the controller should process a matching request

## Synopsis
```php
onProcessRequest(im\http\msg\Request $request, im\route\Router $router): im\http\msg\Response
```

## Parameters
| Name | Description |
| :--- | :---------- |
| request | The request to process |
| router | The router that called this controller |

## Return
The controller should return a response to serve to the calling client
