<?php

namespace App\Exceptions;

use Exception;

class InvalidTransactionTypeException extends Exception
{
    protected $message = 'Invalid transaction type provided.';
}
