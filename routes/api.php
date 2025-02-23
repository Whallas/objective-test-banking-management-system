<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransactionController;

Route::post('/conta', [AccountController::class, 'store']);
Route::post('/transacao', [TransactionController::class, 'createTransaction']);
Route::get('/conta', [AccountController::class, 'show']);
