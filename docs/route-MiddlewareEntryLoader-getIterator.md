# [Route](route.md) / [MiddlewareEntryLoader](route-MiddlewareEntryLoader.md) :: getIterator
 > im\route\MiddlewareEntryLoader
____

## Description
Returns an iterator with MiddlewareEntry objects

 > PHP does not support generics and as such there is no absolut type forcing done. However, anyone using objects that implements this interface, will expect the iterator to return valid MiddlewareEntry objects and may even do it's own type checking against it.  

## Synopsis
```php
getIterator(): Traversable
```
