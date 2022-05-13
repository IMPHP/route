# [Route](route.md) / Controller
 > im\route\Controller
____

## Description
Defines a controller than is used when adding a route in a `Router`

## Synopsis
```php
interface Controller {

    // Methods
    onProcessRequest(im\route\Router $router, im\http\msg\Request $request, null|im\http\msg\Response $response = NULL): im\http\msg\Response
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__Controller&nbsp;::&nbsp;onProcessRequest__](route-Controller-onProcessRequest.md) | Called by the `Router` when the controller should process a matching request |
