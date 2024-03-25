<?php

use App\Http\Controllers\OrderDetailFilterController;
use App\Http\Controllers\OrderReportController;
use Illuminate\Support\Facades\Route;

Route::resource('', OrderReportController::class);

Route::resource('/order-details', OrderDetailFilterController::class);
