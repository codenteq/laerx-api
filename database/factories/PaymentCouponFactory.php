<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentCoupon>
 */
class PaymentCouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code' => $this->faker->currencyCode,
            'discount' => $this->faker->randomNumber,
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
        ];
    }
}
