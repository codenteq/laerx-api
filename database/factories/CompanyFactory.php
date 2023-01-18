<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Company;
use App\Models\Country;
use App\Models\PaymentPlan;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'subdomain' => $this->faker->domainName,
            'email' => $this->faker->email,
            'tax_id' => rand(11, 11),
            'web_url' => $this->faker->url,
            'phone' => $this->faker->phoneNumber,
            'is_active' => Company::STATUS_ACTIVE,
            'logo' => $this->faker->imageUrl,
            'address' => $this->faker->address,
            'zip_code' => $this->faker->postcode,
            'country_id' => Country::factory(),
            'city_id' => City::factory(),
            'state_id' => State::factory(),
            'payment_plan_id' => PaymentPlan::factory(),
        ];
    }
}
