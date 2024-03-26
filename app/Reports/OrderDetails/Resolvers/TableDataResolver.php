<?php

namespace App\Reports\OrderDetails\Resolvers;

use App\Models\OrderDetail;
use App\Reports\OrderDetails\DomainTransferObjects\TableData;
use Illuminate\Database\Eloquent\Collection;

class TableDataResolver
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected TableRowDataResolver $rowResolver,
        protected TableTotalsResolver $totalsResolver,
    ) {
        //
    }

    /** @param Collection<int, OrderDetail> $orderDetails */
    public function resolve(Collection $orderDetails)
    {
        $rows = $orderDetails->map(function (OrderDetail $orderDetail) {
            return $this->rowResolver->resolve($orderDetail);
        });

        $totals = $this->totalsResolver->resolve($orderDetails);

        return new TableData($rows, $totals);
    }
}
