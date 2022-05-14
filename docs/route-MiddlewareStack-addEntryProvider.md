# [Route](route.md) / [MiddlewareStack](route-MiddlewareStack.md) :: addEntryProvider
 > im\route\MiddlewareStack
____

## Description
Add a `MiddlewareEntryProvider` to this stack.

This is used to provide middleware information outside of adding them via `addMiddleware()`.

## Synopsis
```php
addEntryProvider(im\route\MiddlewareEntryProvider $provider): void
```

## Parameters
| Name | Description |
| :--- | :---------- |
| provider | The provider to add |
