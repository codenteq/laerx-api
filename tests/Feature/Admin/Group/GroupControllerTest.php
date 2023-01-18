<?php

namespace Tests\Feature\Admin\Group;

use App\Models\Group;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class GroupControllerTest extends TestCase
{
    use RefreshDatabase;

    protected string $apiUrl = '/api/admin/groups/';

    public function test_group_list()
    {
        Group::factory(20)->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.group.list']);

        $response = $this->get($this->apiUrl);

        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonCount(20, 'data');
    }

    public function test_group_create()
    {
        $group = Group::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.group.create']);

        $response = $this->postJson($this->apiUrl, $group->toArray());
        $response->assertStatus(201);
    }

    public function test_group_show()
    {
        $group = Group::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.group.show']);

        $response = $this->get($this->apiUrl.$group->id);
        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonFragment(['id' => $group->id]);
    }

    public function test_group_update()
    {
        $group = Group::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.group.update']);

        $response = $this->putJson($this->apiUrl.$group->id, [
            'name' => 'Test',
        ]);
        $response->assertStatus(200);
    }

    public function test_group_delete()
    {
        $group = Group::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.group.delete']);

        $response = $this->deleteJson($this->apiUrl.$group->id);
        $response->assertStatus(200);
    }
}
