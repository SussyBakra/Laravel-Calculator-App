<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalculationController;

Route::get('/', function () {
    return "Hello I built this";
});

Route::post('/calculate', [CalculationController::class, 'calculate']);