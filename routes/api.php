<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalculationController;

Route::post('/calculate', [CalculationController::class, 'calculate']);