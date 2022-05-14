# Route
____

## Description
A middleware and router library

## Packages
| Name | Description |
| :--- | :---------- |
| [HTTP](http.md) | HTTP tools specific to the `route` package |

## Interfaces
| Name | Description |
| :--- | :---------- |
| [Controller](route-Controller.md) | Defines a controller than is used when adding a route in a `Router` |
| [Router](route-Router.md) | Defines an extended router interface |
| [RouteEngine](route-RouteEngine.md) | Defines a router interface for launching controllers |
| [RouteEntry](route-RouteEntry.md) | This interface is used to define a route entry  The interface is used together with `RouteEntryProvider`, to provide routes to a router |
| [RouteEntryLoader](route-RouteEntryLoader.md) | An extended provider that is able to custom load a controller  There may be cases where customizations are required when loading a controller |
| [RouteEntryProvider](route-RouteEntryProvider.md) | &nbsp; |
| [StackEngine](route-StackEngine.md) | Defines a Middleware stack |
| [MiddlewareStack](route-MiddlewareStack.md) | Defines an extended Middleware stack |
| [Middleware](route-Middleware.md) | Defines a middleware for the `MiddlewareStack` |
| [MiddlewareEntry](route-MiddlewareEntry.md) | This interface is used to define a middleware entry  The interface is used together with `MiddlewareEntryProvider`, to provide middleware to a stack |
| [MiddlewareEntryLoader](route-MiddlewareEntryLoader.md) | An extended provider that is able to custom load a controller  There may be cases where customizations are required when loading a controller |
| [MiddlewareEntryProvider](route-MiddlewareEntryProvider.md) | &nbsp; |

## Classes
| Name | Description |
| :--- | :---------- |
| [MiddlewareRouter](route-MiddlewareRouter.md) | An implementation of `im\route\Router` that works as a middleware |
| [OrderedStack](route-OrderedStack.md) | Provides an implementation of `im\route\MiddlewareStack` |
