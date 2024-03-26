<?php

namespace App\Reports\OrderDetails;

use App\Reports\OrderDetails\DomainTransferObjects\TableData;
use App\Reports\OrderDetails\Resolvers\OrderDetailsResolver;
use App\Reports\OrderDetails\Resolvers\TableDataResolver;
use Illuminate\Http\Request;

class OrderDetailsReport
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected OrderDetailsResolver $ordersResolver,
        protected TableDataResolver $tableDataResolver,
    ) {
        //
    }

    public function generate(Request $request): TableData
    {
        $orderDetails = $this->ordersResolver->resolve(
            startDate: ($request->start_date ? now($request->start_date) : now()->startOfMonth())->toImmutable(),
            endDate: ($request->end_date ? now($request->end_date) : now()->endOfMonth())->toImmutable(),
            productName: $request->name,
            productCategory: $request->category,
            wasDiscounted: $request->discounted,
            username: $request->username,
            state: $request->state,
        );

        return $this->tableDataResolver->resolve($orderDetails);
    }
}
