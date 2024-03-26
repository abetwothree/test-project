<?php

namespace App\Reports\OrderDetails\DomainTransferObjects;

use Illuminate\Support\Collection;

final readonly class TableData
{
    /**
     * @param Collection<int, TableRow> $rows
     */
    public function __construct(
        public Collection $rows,
        public TableTotalsRow $totals,
    )
    {
        //
    }
}
