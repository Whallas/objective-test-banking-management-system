<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAccountRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'numero_conta' => 'required|integer|unique:accounts,account_number',
            'saldo' => 'required|numeric|min:0',
        ];
    }
}
