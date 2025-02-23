<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTransactionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'forma_pagamento' => 'required|string|in:P,C,D',
            'numero_conta' => 'required|integer|exists:accounts,account_number',
            'valor' => 'required|numeric|min:0',
        ];
    }
}
