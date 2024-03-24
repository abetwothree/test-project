<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailFilterController extends Controller
{
    public function index(Request $request)
    {
        // Query the OrderDetail model
        $query = OrderDetail::query();

        // Apply filters
        $this->applyFilters($query, $request);

        // Eager load the items and their product
        $query->with([
            'user',
            'user.addresses',
            'items.product.category',
            'items.product.inventory',
            'items.product.discount',
            'paymentDetail',
            'address',
        ]);

        // orderDetails query result
        $orderDetails = $query->get();

        // Return the orderDetails as JSON response
        return response()->json($orderDetails);
    }

    private function applyFilters($query, Request $request)
    {
        // Filter by name
        $query->when($request->has('name'), function ($query) use ($request) {
            $name = $request->query('name');
            $query->whereHas('items.product', function ($query) use ($name) {
                $query->where('name', 'like', '%'.$name.'%');
            });
        });
    }
}
