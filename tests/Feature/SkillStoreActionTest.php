<?php

namespace Tests\Feature;

use App\Position;
use App\Skill;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SkillStoreActionTest extends ActionTestCase
{
    public function getRouteName(): string
    {
        return 'skills/store';
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
        $skill = Skill::first();

        $this->callRouteAction([
            'name' => $skill->name,
        ])->assertJsonValidationErrors('name');
    }
}
