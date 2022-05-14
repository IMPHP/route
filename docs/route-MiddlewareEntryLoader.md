# [Route](route.md) / MiddlewareEntryLoader
 > im\route\MiddlewareEntryLoader
____

## Description
An extended provider that is able to custom load a controller

There may be cases where customizations are required when loading
a controller. This interface will allow the router to call upon
this method and request a controller while allowing customizations
to be made.

## Synopsis
```php
interface MiddlewareEntryLoader implements im\route\MiddlewareEntryProvider, Traversable, IteratorAggregate {

    // Methods
    loadController(mixed $entryId): im\route\Middleware|callable

    // Inherited Methods
    getIterator(): Traversable
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__MiddlewareEntryLoader&nbsp;::&nbsp;loadController__](route-MiddlewareEntryLoader-loadController.md) | Load an return a controller |
| [__MiddlewareEntryLoader&nbsp;::&nbsp;getIterator__](route-MiddlewareEntryLoader-getIterator.md) | Returns an iterator with MiddlewareEntry objects |
