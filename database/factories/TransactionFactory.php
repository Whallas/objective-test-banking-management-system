<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition()
    {
        return [
            'payment_method' => $this->faker->randomElement(['P', 'C', 'D']),
            'account_number' => $this->faker->numberBetween(100000, 999999),
            'amount' => $this->faker->randomFloat(2, 1, 500),
        ];
    }
}
