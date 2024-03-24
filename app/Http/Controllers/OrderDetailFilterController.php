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

        // Filter by name
        if ($request->has('name')) {
            // Get the name query parameter
            $name = $request->query('name');
            // Use whereHas to filter by the product name which lives in the items relationship
            $query->whereHas('items.product', function ($query) use ($name) {
                // Use the like operator to search for the name
                $query->where('name', 'like', '%'.$name.'%');
            });
        }

        // Eager load the items and their product
        $query->with([
            'user',
            'user.addresses',
            'items.product.category',
            'items.product.inventory',
            'items.product.discount',
            'paymentDetail',
        ]);

        // orderDetails query result
        $orderDetails = $query->get();

        // Return the orderDetails as JSON response
        return response()->json($orderDetails);
    }
}
