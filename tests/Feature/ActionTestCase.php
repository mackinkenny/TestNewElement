<?php

namespace Tests\Feature;

use http\Client\Curl\User;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Routing\Route;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class ActionTestCase extends TestCase
{
    /**
     * Название роута для которого пишутся тесты
     *
     * @return string
     */
    abstract public function getRouteName(): string;

    public function assertRouteHasExactMiddleware(...$names)
    {
        $route = $this->getRouteByName();

        $this->assertRouteHasExactMiddleware(...$names);
        $this->assertTrue(
            count($names) === count($route->middleware()),
            'Route contains not the same amount of middleware.'
        );

        return $this;
    }


    /**
     * @return Route
     */
    private function getRouteByName(): Route
    {
        $routes = \Illuminate\Support\Facades\Route::getRoutes();

        /** @var Route $route */
        $route = $routes->getByName($this->getRouteName());

        if (!$route) {
            $this->fail("Route with name [{$this->getRouteName()}] not found!");
        }

        return $route;
    }

    /**
     * Выполнение неавторизованного запроса
     *
     * @param array $data Request body
     * @param array $parameters Route parameters
     *
     * @return TestResponse
     */
    protected function callRouteAction(array $data = [], array $parameters = []): TestResponse
    {
        $route = $this->getRouteByName();
        $method = $route->methods()[0];
        $url = route($this->getRouteName(), $parameters);

        return $this->json($method, $url, $data);
    }
}
