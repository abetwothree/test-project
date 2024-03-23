<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    // Home Page Method
    public function index(): View
    {
        return view('/home');
    }
}
