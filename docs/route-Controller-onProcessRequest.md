# [Route](route.md) / [Controller](route-Controller.md) :: onProcessRequest
 > im\route\Controller
____

## Description
Called by the `RouteEngine` when the controller should process a matching request

## Synopsis
```php
onProcessRequest(im\route\RouteEngine $router, im\http\msg\Request $request, null|im\http\msg\Response $response = NULL): im\http\msg\Response
```

## Parameters
| Name | Description |
| :--- | :---------- |
| router | The router that called this controller |
| request | The request to process |
| response | Optional response to populate |

## Return
The controller returns a response to serve to the client
