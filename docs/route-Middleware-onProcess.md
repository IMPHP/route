# [Route](route.md) / [Middleware](route-Middleware.md) :: onProcess
 > im\route\Middleware
____

## Description
Called by the `StackEngine` when this middleware should start processing

## Synopsis
```php
onProcess(im\http\msg\Request $request, im\route\StackEngine $stack): im\http\msg\Response
```

## Parameters
| Name | Description |
| :--- | :---------- |
| request | The request to process |
| stack | The middleware stack that called this middleware |
