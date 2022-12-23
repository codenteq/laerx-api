<?php

namespace Tests\Feature\Admin\Payment;

use App\Models\PaymentCoupon;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PaymentCouponControllerTest extends TestCase
{
    use RefreshDatabase;

    protected string $apiUrl = '/api/admin/payment/coupons/';

    public function test_payment_coupon_list()
    {
        PaymentCoupon::factory(20)->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.payment-coupon.list']);

        $response = $this->get($this->apiUrl);

        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonCount(20, 'data');
    }

    public function test_payment_coupon_create()
    {
        $payment_coupon = PaymentCoupon::factory()->make();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.payment-coupon.create']);

        $response = $this->postJson($this->apiUrl, $payment_coupon->toArray());
        $response->assertStatus(201);
    }

    public function test_payment_coupon_show()
    {
        $payment_coupon = PaymentCoupon::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.payment-coupon.show']);

        $response = $this->get($this->apiUrl.$payment_coupon->id);
        $response->assertJsonStructure(['success', 'message', 'data'])
            ->assertJsonFragment(['id' => $payment_coupon->id]);
    }

    public function test_payment_coupon_update()
    {
        $payment_coupon = PaymentCoupon::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.payment-coupon.update']);

        $response = $this->putJson($this->apiUrl.$payment_coupon->id, [
            'name' => 'test',
        ]);
        $response->assertStatus(200);
    }

    public function test_payment_coupon_delete()
    {
        $payment_coupon = PaymentCoupon::factory()->create();
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['admin.payment-coupon.delete']);

        $response = $this->delete($this->apiUrl.$payment_coupon->id);
        $response->assertStatus(200);
    }
}
