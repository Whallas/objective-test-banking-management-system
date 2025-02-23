<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAccountRequest;
use App\Http\Resources\AccountResponse;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AccountController extends Controller
{
    public function store(CreateAccountRequest $request)
    {
        $account = Account::create([
            'account_number' => $request->numero_conta,
            'balance' => $request->saldo,
        ]);

        return AccountResponse::make($account);
    }

    public function show(Request $request)
    {
        $this->validate($request, [
            'numero_conta' => 'required|integer',
        ]);

        $account = Account::where('account_number', $request->numero_conta)->first();

        if (!$account) {
            return response()->json(['message' => 'Account not found'], Response::HTTP_NOT_FOUND);
        }

        return AccountResponse::make($account);
    }
}
