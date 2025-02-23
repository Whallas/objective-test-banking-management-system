<?php

namespace Database\Factories;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountFactory extends Factory
{
    protected $model = Account::class;

    public function definition()
    {
        return [
            'account_number' => $this->faker->unique()->numberBetween(100000, 999999),
            'balance' => $this->faker->randomFloat(2, 0, 1000),
        ];
    }
}
