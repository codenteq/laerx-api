<?php

namespace Tests\Feature\Admin\CarType;

use App\Models\CarType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CarTypeControllerTest extends TestCase
{
    use RefreshDatabase;

    protected string $apiUrl = '/api/admin/car-types/';

    public function test_car_type_list()
    {
        CarType::factory(20)->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.car-type.list']);

        $response = $this->get($this->apiUrl);

        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonCount(20, 'data');
    }

    public function test_car_type_create()
    {
        $car_type = CarType::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.car-type.create']);

        $response = $this->postJson($this->apiUrl, $car_type->toArray());
        $response->assertStatus(201);
    }

    public function test_car_type_show()
    {
        $car_type = CarType::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.car-type.show']);

        $response = $this->get($this->apiUrl.$car_type->id);
        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonFragment(['id' => $car_type->id]);
    }

    public function test_car_type_update()
    {
        $car_type = CarType::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.car-type.update']);

        $response = $this->putJson($this->apiUrl.$car_type->id, [
            'name' => 'Test',
        ]);
        $response->assertStatus(200);
    }

    public function test_car_type_delete()
    {
        $car_type = CarType::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.car-type.delete']);

        $response = $this->deleteJson($this->apiUrl.$car_type->id);
        $response->assertStatus(200);
    }
}
