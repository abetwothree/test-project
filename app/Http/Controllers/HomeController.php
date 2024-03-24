<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\View\View;

class HomeController extends Controller
{
    // Home Page Method
    public function index(): View
    {
        return view('/home', [
            'products' => OrderDetail::all(),
        ]);
    }
}
