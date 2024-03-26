<?php

namespace App\Reports\OrderDetails\Resolvers;

use App\Models\OrderDetail;
use App\Reports\OrderDetails\DomainTransferObjects\TableTotalsRow;
use Illuminate\Support\Collection;

class TableTotalsResolver
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /** @param Collection<int, OrderDetail> $orderDetails */
    public function resolve(Collection $orderDetails): TableTotalsRow
    {
        return new TableTotalsRow(
            total: $orderDetails->sum('total'),
            quantity: $orderDetails->sum('items.quantity'),
        );
    }
}
