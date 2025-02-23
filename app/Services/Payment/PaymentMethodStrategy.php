<?php

namespace App\Services\Payment;

interface PaymentMethodStrategy
{
    public function calculateTransactionAmount(float $amount): float;
    public function calculateTransactionFee(float $amount): float;
}
