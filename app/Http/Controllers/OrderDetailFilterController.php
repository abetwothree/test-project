<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Reports\OrderDetails\OrderDetailsReport;
use Illuminate\Http\JsonResponse;

class OrderDetailFilterController extends Controller
{
    public function index(Request $request, OrderDetailsReport $orderDetailsReport): JsonResponse
    {
        return response()->json($orderDetailsReport->generate($request));
    }
}
