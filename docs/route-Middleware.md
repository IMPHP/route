# [Route](route.md) / Middleware
 > im\route\Middleware
____

## Description
Defines a middleware for the `MiddlewareStack`.

## Synopsis
```php
interface Middleware {

    // Methods
    onProcess(im\http\msg\Request $request, im\route\StackEngine $stack): im\http\msg\Response
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__Middleware&nbsp;::&nbsp;onProcess__](route-Middleware-onProcess.md) | Called by the `StackEngine` when this middleware should start processing |
