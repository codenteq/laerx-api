<?php

namespace Tests\Feature\Admin\Payment;

use App\Models\PaymentPackage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PaymentPackageControllerTest extends TestCase
{
    use RefreshDatabase;

    protected string $apiUrl = '/api/admin/payment/packages/';

    public function test_payment_package_list()
    {
        PaymentPackage::factory(20)->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.payment-package.list']);

        $response = $this->get($this->apiUrl);

        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonCount(20, 'data');
    }

    public function test_payment_package_create()
    {
        $payment_package = PaymentPackage::factory()->make();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.payment-package.create']);

        $response = $this->postJson($this->apiUrl, $payment_package->toArray());
        $response->assertStatus(201);
    }

    public function test_payment_package_show()
    {
        $payment_package = PaymentPackage::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.payment-package.show']);

        $response = $this->get($this->apiUrl.$payment_package->id);
        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonFragment(['id' => $payment_package->id]);
    }

    public function test_payment_package_update()
    {
        $payment_package = PaymentPackage::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.payment-package.update']);

        $response = $this->putJson($this->apiUrl.$payment_package->id, [
            'name' => 'test',
        ]);
        $response->assertStatus(200);
    }

    public function test_payment_package_delete()
    {
        $payment_package = PaymentPackage::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.payment-package.delete']);

        $response = $this->delete($this->apiUrl.$payment_package->id);
        $response->assertStatus(200);
    }
}
