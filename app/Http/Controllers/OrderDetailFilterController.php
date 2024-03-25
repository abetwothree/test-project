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
            'address',
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

    private function applyFilters($query, Request $request)
    {
        // relationship and field mapping
        $filters = [
            'product' => ['items.product', 'name'],
            'category' => ['items.product.category', 'name'],
            'username' => ['user', 'username'],
            'quantity' => ['items', 'quantity'],
            'total' => ['total', '<='],
            'state' => ['address', 'state'],
        ];

        foreach ($filters as $key => [$relation, $field]) {
            $query->when($request->input($key, false), function ($query, $value) use ($relation, $field) {
                // used switch for readability, can add more cases without cluttering the code
                switch ($field) {
                    case '<=':
                        $value = floatval($value);
                        $query->where($relation, $field, $value);
                        break;

                    case 'quantity':
                        $query->whereHas($relation, function ($query) use ($field, $value) {
                            $query->where($field, $value);
                        });
                        break;

                    default:
                        $query->whereHas($relation, function ($query) use ($field, $value) {
                            $query->where($field, 'like', '%'.$value.'%');
                        });
                        break;
                }
            });
        }
    }
}
