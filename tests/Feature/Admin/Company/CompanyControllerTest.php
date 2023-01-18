<?php

namespace Tests\Feature\Admin\Company;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CompanyControllerTest extends TestCase
{
    use RefreshDatabase;

    protected string $apiUrl = '/api/admin/companies/';

    public function test_company_list()
    {
        Company::factory(20)->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.company.list']);

        $response = $this->get($this->apiUrl);

        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonCount(20, 'data');
    }

    public function test_company_create()
    {
        $company = Company::factory()->make();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.company.create']);

        $response = $this->postJson($this->apiUrl, $company->toArray());
        $response->assertStatus(201);
    }

    public function test_company_show()
    {
        $company = Company::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.company.show']);

        $response = $this->get($this->apiUrl.$company->id);
        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonFragment(['id' => $company->id]);
    }

    public function test_company_update()
    {
        $company = Company::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.company.update']);

        $response = $this->putJson($this->apiUrl.$company->id, [
            'name' => 'test',
        ]);
        $response->assertStatus(200);
    }

    public function test_company_delete()
    {
        $company = Company::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.company.delete']);

        $response = $this->delete($this->apiUrl.$company->id);
        $response->assertStatus(200);
    }
}
