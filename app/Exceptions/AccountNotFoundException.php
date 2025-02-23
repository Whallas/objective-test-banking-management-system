<?php

namespace App\Exceptions;

use Exception;

class AccountNotFoundException extends Exception
{
    protected $message = 'Account not found.';
}
