# Route
____

## Description
A middleware and router library

## Interfaces
| Name | Description |
| :--- | :---------- |
| [Controller](route-Controller.md) | Defines a controller than is used when adding a route in a `Router` |
| [MethodFlags](route-MethodFlags.md) | This is used to define request methods as flags |
| [Router](route-Router.md) | Defines a router interface for launching controllers |
| [MiddlewareStack](route-MiddlewareStack.md) | Defines a Middleware stack |
| [Middleware](route-Middleware.md) | Defines a middleware for the `MiddlewareStack` |

## Classes
| Name | Description |
| :--- | :---------- |
| [SimpleRouter](route-SimpleRouter.md) | An implementation of `im\route\Router` that works as a middleware |
| [OrderedStack](route-OrderedStack.md) | Provides an implementation of `im\route\MiddlewareStack` |
