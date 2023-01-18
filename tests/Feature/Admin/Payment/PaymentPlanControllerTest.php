<?php

namespace Tests\Feature\Admin\Payment;

use App\Models\PaymentPlan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PaymentPlanControllerTest extends TestCase
{
    use RefreshDatabase;

    protected string $apiUrl = '/api/admin/payment/plans/';

    public function test_payment_plan_list()
    {
        PaymentPlan::factory(20)->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.payment-plan.list']);

        $response = $this->get($this->apiUrl);

        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonCount(20, 'data');
    }

    public function test_payment_plan_create()
    {
        $payment_plan = PaymentPlan::factory()->make();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.payment-plan.create']);

        $response = $this->postJson($this->apiUrl, $payment_plan->toArray());
        $response->assertStatus(201);
    }

    public function test_payment_plan_show()
    {
        $payment_plan = PaymentPlan::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.payment-plan.show']);

        $response = $this->get($this->apiUrl.$payment_plan->id);
        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonFragment(['id' => $payment_plan->id]);
    }

    public function test_payment_plan_update()
    {
        $payment_plan = PaymentPlan::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.payment-plan.update']);

        $response = $this->putJson($this->apiUrl.$payment_plan->id, [
            'name' => 'test',
        ]);
        $response->assertStatus(200);
    }

    public function test_payment_plan_delete()
    {
        $payment_plan = PaymentPlan::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.payment-plan.delete']);

        $response = $this->delete($this->apiUrl.$payment_plan->id);
        $response->assertStatus(200);
    }
}
