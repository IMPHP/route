# [Route](route.md) / [RouteEntryLoader](route-RouteEntryLoader.md) :: getIterator
 > im\route\RouteEntryLoader
____

## Description
Returns an iterator with RouteEntry objects

 > PHP does not support generics and as such there is no absolut type forcing done. However, anyone using objects that implements this interface, will expect the iterator to return valid RouteEntry objects and may even do it's own type checking against it.  

## Synopsis
```php
getIterator(): Traversable
```
