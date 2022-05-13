# [Route](route.md) / [MiddlewareRouter](route-MiddlewareRouter.md) :: process
 > im\route\MiddlewareRouter
____

## Description
Manually process a request

 > This router is built as a middleware. Rather than executing a request manually, it can be added and executed from within a `im\route\MiddlewareStack`.  

## Synopsis
```php
public process(im\http\msg\Request $request): im\http\msg\Response
```

## Parameters
| Name | Description |
| :--- | :---------- |
| request | A request to process |
