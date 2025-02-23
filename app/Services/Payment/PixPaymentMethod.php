<?php

namespace App\Services\Payment;

class PixPaymentMethod implements PaymentMethodStrategy
{
    public function calculateTransactionAmount(float $amount): float
    {
        return $amount; // No fee for Pix
    }

    public function calculateTransactionFee(float $amount): float
    {
        return 0; // No fee for Pix
    }
}
