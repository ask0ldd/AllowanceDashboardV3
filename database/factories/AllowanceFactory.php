<?php

namespace Database\Factories;

use App\Models\Allowance;
use App\Models\Address;
use App\Models\TokenContract;
use Illuminate\Database\Eloquent\Factories\Factory;

class AllowanceFactory extends Factory
{
    protected $model = Allowance::class;

    public function definition()
    {
        return [
            'token_contract_id' => TokenContract::factory(),
            'owner_address_id' => Address::factory(),
            'spender_address_id' => Address::factory(),
            'amount' => $this->faker->numberBetween(100, 1000),
            'is_unlimited' => $this->faker->boolean,
            'pending' => $this->faker->boolean,
        ];
    }
}
