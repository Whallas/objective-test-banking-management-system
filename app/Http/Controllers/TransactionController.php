<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTransactionRequest;
use App\Models\Transaction;
use App\Models\Account;
use App\Services\Payment\PaymentMethodFactory;
use Illuminate\Http\JsonResponse;

class TransactionController extends Controller
{
    public function createTransaction(CreateTransactionRequest $request): JsonResponse
    {
        $paymentMethod = PaymentMethodFactory::getPaymentMethodStrategy($request->forma_pagamento);

        $account = Account::where('account_number', $request->numero_conta)->first();

        if ($account->balance < $paymentMethod->calculateTransactionAmount($request->valor)) {
            return response()->json(['error' => 'Insufficient funds'], 404);
        }

        $transaction = new Transaction();
        $transaction->account_id = $account->id;
        $transaction->amount = $request->valor;
        $transaction->payment_method = $request->forma_pagamento;
        $transaction->transaction_fee = $paymentMethod->calculateTransactionFee($request->valor);
        $transaction->save();

        $account->balance -= $paymentMethod->calculateTransactionAmount($request->valor);
        $account->save();

        return response()->json([
            'numero_conta' => $account->account_number,
            'saldo' => $account->balance
        ], 201);
    }
}
