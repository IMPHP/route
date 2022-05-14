# [Route](route.md) / StackEngine
 > im\route\StackEngine
____

## Description
Defines a Middleware stack

## Synopsis
```php
interface StackEngine {

    // Methods
    process(im\http\msg\Request $request): im\http\msg\Response
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__StackEngine&nbsp;::&nbsp;process__](route-StackEngine-process.md) | Start processing the first or next middleware in the stack |
