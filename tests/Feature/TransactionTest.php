<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_transaction()
    {
        $account = \App\Models\Account::create([
            'account_number' => 234,
            'balance' => 180.37,
        ]);

        $response = $this->postJson('/api/transacao', [
            'forma_pagamento' => 'D',
            'numero_conta' => $account->account_number,
            'valor' => 10,
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'numero_conta' => $account->account_number,
                     'saldo' => 170.07,
                 ]);
    }

    public function test_transaction_fails_without_sufficient_balance()
    {
        $account = \App\Models\Account::create([
            'account_number' => 234,
            'balance' => 5.00,
        ]);

        $response = $this->postJson('/api/transacao', [
            'forma_pagamento' => 'D',
            'numero_conta' => $account->account_number,
            'valor' => 10,
        ]);

        $response->assertStatus(404);
    }

    public function test_can_get_account_balance()
    {
        $account = \App\Models\Account::create([
            'account_number' => 234,
            'balance' => 180.37,
        ]);

        $response = $this->getJson('/api/conta?numero_conta=' . $account->account_number);

        $response->assertStatus(200)
                 ->assertJson([
                     'numero_conta' => $account->account_number,
                     'saldo' => 180.37,
                 ]);
    }

    public function test_get_account_fails_if_not_exists()
    {
        $response = $this->getJson('/api/conta?numero_conta=999');

        $response->assertStatus(404);
    }
}
