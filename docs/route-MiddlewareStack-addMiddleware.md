# [Route](route.md) / [MiddlewareStack](route-MiddlewareStack.md) :: addMiddleware
 > im\route\MiddlewareStack
____

## Description
Add a middleware to this stack

## Synopsis
```php
addMiddleware(im\route\Middleware|callable|string $middleware, int $order = 0, int $flags = im\http\Verbs::ANY): void
```

## Parameters
| Name | Description |
| :--- | :---------- |
| middleware | A middleware instance, class name or a callable |
| order | The order in which to run this middleware |
| flags | Flags that defines what request methods are to be used with this middleware |
