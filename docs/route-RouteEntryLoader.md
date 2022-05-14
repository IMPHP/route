# [Route](route.md) / RouteEntryLoader
 > im\route\RouteEntryLoader
____

## Description
An extended provider that is able to custom load a controller

There may be cases where customizations are required when loading
a controller. This interface will allow the router to call upon
this method and request a controller while allowing customizations
to be made.

## Synopsis
```php
interface RouteEntryLoader implements im\route\RouteEntryProvider, Traversable, IteratorAggregate {

    // Methods
    loadController(mixed $entryId): im\route\Controller|callable

    // Inherited Methods
    getIterator(): Traversable
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__RouteEntryLoader&nbsp;::&nbsp;loadController__](route-RouteEntryLoader-loadController.md) | Load an return a controller |
| [__RouteEntryLoader&nbsp;::&nbsp;getIterator__](route-RouteEntryLoader-getIterator.md) | Returns an iterator with RouteEntry objects |
