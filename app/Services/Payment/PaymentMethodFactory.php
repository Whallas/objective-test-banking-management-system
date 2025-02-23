<?php

namespace App\Services\Payment;

class PaymentMethodFactory
{
    public static function getPaymentMethodStrategy(string $paymentMethod): PaymentMethodStrategy
    {
        switch ($paymentMethod) {
            case 'D':
                return new DebitPaymentMethod();
            case 'C':
                return new CreditPaymentMethod();
            case 'P':
            default:
                return new PixPaymentMethod();
        }
    }
}
