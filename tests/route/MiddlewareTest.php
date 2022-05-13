<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use im\route\OrderedStack;
use im\route\MiddlewareStack;
use im\route\MiddlewareRouter;
use im\route\Router;
use im\http\msg\Request;
use im\http\msg\Response;
use im\http\msg\HttpRequestBuilder;
use im\http\msg\HttpResponseBuilder;
use im\http\msg\HttpUriBuilder;

final class MiddlewareTest extends TestCase {

    /**
     *
     */
    public function test_middleware(): void {
        $stack = new OrderedStack();
        $stack->addMiddleware(function(Request $request, MiddlewareStack $stack): Response {
            $response = new HttpResponseBuilder();
            $response->getBody()->write("Response body");

            return $response;
        });

        $request = new HttpRequestBuilder("GET", new HttpUriBuilder("http://domain.com/"));
        $response = $stack->process($request);

        $this->assertEquals(
            "Response body",
            $response->getBody()->toString()
        );
    }

    /**
     *
     */
    public function test_router(): void {
        $router = new MiddlewareRouter();
        $router->addRoute("/mypage/{id:number}/?test", function(Router $router, Request $request, Response $response): Response {
            $response = new HttpResponseBuilder();
            $response->getBody()->write("Response body");

            return $response;
        });
        $router->addRoute("/otherpage/{id:int}", "/mypage/$1");

        $stack = new OrderedStack();
        $stack->addMiddleware($router);

        $request = new HttpRequestBuilder("GET", new HttpUriBuilder("http://domain.com/mypage/1/test"));
        $response = $stack->process($request);

        $this->assertEquals(
            "Response body",
            $response->getBody()->toString()
        );

        $request = new HttpRequestBuilder("GET", new HttpUriBuilder("http://domain.com/otherpage/1"));
        $response = $stack->process($request);

        $this->assertEquals(
            "Response body",
            $response->getBody()->toString()
        );

        $request = new HttpRequestBuilder("GET", new HttpUriBuilder("http://domain.com/nopage/1"));
        $response = $stack->process($request);

        $this->assertEquals(
            Response::STATUS_NOT_FOUND,
            $response->getStatusCode()
        );

        $router->addNamedRoute("testpage", "/otherpage/?{optional}/{id:int}/*", "/mypage/$1");

        $this->assertEquals(
            "/otherpage/10",
            $router->getRoutePath("testpage", ["id" => 10])
        );

        $this->assertEquals(
            "/otherpage/page/10",
            $router->getRoutePath("testpage", ["id" => 10, "optional" => "page"])
        );
    }
}
