<?php

namespace App\Reports\OrderDetails;

use Illuminate\Http\Request;
use App\Reports\OrderDetails\Resolvers\OrderDetailsResolver;
use Illuminate\Support\Collection;

class OrderDetailsReport
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected OrderDetailsResolver $ordersResolver,
    )
    {
        //
    }

    public function generate(Request $request): Collection
    {
        $orders = $this->ordersResolver->resolve(
            startDate: ($request->start_date ? now($request->start_date) : now()->startOfMonth())->toImmutable(),
            endDate: ($request->end_date ? now($request->end_date) : now()->endOfMonth())->toImmutable(),
            productName: $request->name,
            productCategory: $request->category,
            wasDiscounted: $request->discounted,
            username: $request->username,
            state: $request->state,
        );

        // pass the orders to another resolver to calculate total amounts or other business logic
        // those resolvers can "hardstone" the data by creating DTOs (Data Transfer Objects) or other structures
        // finally, return the report data

        return $orders;
    }
}
