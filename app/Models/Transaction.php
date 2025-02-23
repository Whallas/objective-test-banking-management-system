<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'payment_method',
        'amount',
        'transaction_fee',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function calculateTransactionFee($amount, $paymentMethod)
    {
        switch ($paymentMethod) {
            case 'D':
                return $amount * 0.03; // 3% fee for debit
            case 'C':
                return $amount * 0.05; // 5% fee for credit
            case 'P':
                return 0; // No fee for Pix
            default:
                throw new \InvalidArgumentException("Invalid payment method");
        }
    }

    public function processTransaction($amount, $paymentMethod)
    {
        $transactionFee = $this->calculateTransactionFee($amount, $paymentMethod);
        $totalAmount = $amount + $transactionFee;

        // Logic to process the transaction and update the account balance
        // This should include validation to ensure the account has sufficient funds
    }
}
