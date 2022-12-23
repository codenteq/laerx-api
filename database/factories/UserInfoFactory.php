<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Group;
use App\Models\Language;
use App\Models\Month;
use App\Models\Period;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserInfo>
 */
class UserInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'is_active' => UserInfo::STATUS_ACTIVE,
            'period_id' => Period::factory(),
            'month_id' => Month::factory(),
            'group_id' => Group::factory(),
            'language_id' => Language::factory(),
            'company_id' => Company::factory(),
            'user_id' => User::factory(),
        ];
    }
}
