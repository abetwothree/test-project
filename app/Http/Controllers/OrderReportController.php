<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;

class OrderReportController extends Controller
{
    public function index()
    {
        // $orderDetails = OrderDetail::with([
        //     'user',
        //     'user.addresses',
        //     'items.product.category',
        //     'items.product.inventory',
        //     'items.product.discount',
        //     'paymentDetail',
        // ])->get();

        return view('home');
    }
}
