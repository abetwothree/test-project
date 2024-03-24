<?php

use App\Http\Controllers\OrderReportController;
use Illuminate\Support\Facades\Route;

Route::resource('', OrderReportController::class);

Route::get('/order-detail-filter', [App\Http\Controllers\OrderDetailFilterController::class, 'index']);
