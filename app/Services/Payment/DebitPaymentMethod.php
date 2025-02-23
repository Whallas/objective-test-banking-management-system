<?php

namespace App\Services\Payment;

class DebitPaymentMethod implements PaymentMethodStrategy
{
    public function calculateTransactionAmount(float $amount): float
    {
        return $amount * 1.03; // 3% fee for debit
    }

    public function calculateTransactionFee(float $amount): float
    {
        return $amount * 0.03; // 3% fee for debit
    }
}
