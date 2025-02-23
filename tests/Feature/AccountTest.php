<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccountTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_account()
    {
        $response = $this->postJson('/api/conta', [
            'numero_conta' => 234,
            'saldo' => 180.37,
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'numero_conta' => 234,
                     'saldo' => 180.37,
                 ]);
    }

    public function test_create_account_already_exists()
    {
        $this->postJson('/api/conta', [
            'numero_conta' => 234,
            'saldo' => 180.37,
        ]);

        $response = $this->postJson('/api/conta', [
            'numero_conta' => 234,
            'saldo' => 200.00,
        ]);

        $response->assertStatus(422);
    }

    public function test_get_account()
    {
        $this->postJson('/api/conta', [
            'numero_conta' => 234,
            'saldo' => 180.37,
        ]);

        $response = $this->getJson('/api/conta?numero_conta=234');

        $response->assertStatus(200)
                 ->assertJson([
                     'numero_conta' => 234,
                     'saldo' => 180.37,
                 ]);
    }

    public function test_get_account_not_found()
    {
        $response = $this->getJson('/api/conta?numero_conta=999');

        $response->assertStatus(404);
    }
}
