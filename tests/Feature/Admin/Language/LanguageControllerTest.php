<?php

namespace Tests\Feature\Admin\Language;

use App\Models\Language;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class LanguageControllerTest extends TestCase
{
    use RefreshDatabase;

    protected string $apiUrl = '/api/admin/languages/';

    public function test_language_list()
    {
        Language::factory(20)->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.language.list']);

        $response = $this->get($this->apiUrl);

        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonCount(20, 'data');
    }

    public function test_language_create()
    {
        $language = Language::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.language.create']);

        $response = $this->postJson($this->apiUrl, $language->toArray());
        $response->assertStatus(201);
    }

    public function test_language_show()
    {
        $language = Language::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.language.show']);

        $response = $this->get($this->apiUrl.$language->id);
        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonFragment(['id' => $language->id]);
    }

    public function test_language_update()
    {
        $language = Language::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.language.update']);

        $response = $this->putJson($this->apiUrl.$language->id, [
            'name' => 'Test',
        ]);
        $response->assertStatus(200);
    }

    public function test_language_delete()
    {
        $language = Language::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.language.delete']);

        $response = $this->deleteJson($this->apiUrl.$language->id);
        $response->assertStatus(200);
    }
}
