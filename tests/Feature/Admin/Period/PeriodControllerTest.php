<?php

namespace Tests\Feature\Admin\Period;

use App\Models\Period;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PeriodControllerTest extends TestCase
{
    use RefreshDatabase;

    protected string $apiUrl = '/api/admin/periods/';

    public function test_period_list()
    {
        Period::factory(20)->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.period.list']);

        $response = $this->get($this->apiUrl);

        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonCount(20, 'data');
    }

    public function test_period_create()
    {
        $period = Period::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.period.create']);

        $response = $this->postJson($this->apiUrl, $period->toArray());
        $response->assertStatus(201);
    }

    public function test_period_show()
    {
        $period = Period::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.period.show']);

        $response = $this->get($this->apiUrl.$period->id);
        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonFragment(['id' => $period->id]);
    }

    public function test_period_update()
    {
        $period = Period::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.period.update']);

        $response = $this->putJson($this->apiUrl.$period->id, [
            'name' => 'Test',
        ]);
        $response->assertStatus(200);
    }

    public function test_period_delete()
    {
        $period = Period::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.period.delete']);

        $response = $this->deleteJson($this->apiUrl.$period->id);
        $response->assertStatus(200);
    }
}
