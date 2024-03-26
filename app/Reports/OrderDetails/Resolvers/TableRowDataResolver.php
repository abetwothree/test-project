<?php

namespace App\Reports\OrderDetails\Resolvers;

use App\Models\OrderDetail;
use App\Reports\OrderDetails\DomainTransferObjects\TableRow;

class TableRowDataResolver
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function resolve(OrderDetail $orderDetail): TableRow
    {
        $firstItem = $orderDetail->items->first();

        return new TableRow(
            created_at: $orderDetail->created_at->toDateTimeString(),
            product: $firstItem?->product?->name ?? '',
            category: $firstItem?->product?->category?->name ?? '',
            discounted: $firstItem?->product?->discount?->active && $firstItem?->product?->discount?->discount_percent > 0,
            username: $orderDetail->user?->username ?? '',
            quantity: $orderDetail->items->sum('quantity'),
            total: $orderDetail->total,
            state: $orderDetail->address?->state ?? '',
        );
    }
}
