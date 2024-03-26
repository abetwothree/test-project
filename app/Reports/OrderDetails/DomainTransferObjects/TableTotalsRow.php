<?php

namespace App\Reports\OrderDetails\DomainTransferObjects;

final readonly class TableTotalsRow
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public float $total,
        public int $quantity,
    )
    {
        //
    }
}
