<?php

namespace Tests\Feature;

use App\Position;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PositionStoreActionTest extends ActionTestCase
{
    public function getRouteName(): string
    {
        return 'positions/store';
    }

    // Checking middleares
    function test_route_contains_middleware()
    {
        $this->assertRouteHasExactMiddleware(
            'admin'
        );
    }

    function test_name_is_required()
    {
        $this->callRouteAction()
            ->assertJsonValidationErrors('name');
    }

    function test_name_should_be_unique()
    {
        $position = Position::first();

        $this->callRouteAction([
            'name' => $position->name,
        ])->assertJsonValidationErrors('name');
    }
}
