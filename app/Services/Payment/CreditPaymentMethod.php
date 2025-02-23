<?php

namespace App\Services\Payment;

class CreditPaymentMethod implements PaymentMethodStrategy
{
    public function calculateTransactionAmount(float $amount): float
    {
        return $amount * 1.05; // 5% fee for credit
    }

    public function calculateTransactionFee(float $amount): float
    {
        return $amount * 0.05; // 5% fee for credit
    }
}
