<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardStravaButtonTest extends TestCase
{
    use RefreshDatabase;

    // public function strava_button(): void
    // {
    //     $user = User::factory()->create();

    //     $response = $this->actingAs($user)->get(route('dashboard'));

    //     $response->assertStatus(200);
    //     $response->assertSeeHtml(route('strava.data'));
    //     $response->assertSee('Refresh');
    // }
}
