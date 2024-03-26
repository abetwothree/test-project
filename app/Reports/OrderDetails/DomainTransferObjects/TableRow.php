<?php

namespace App\Reports\OrderDetails\DomainTransferObjects;

final readonly class TableRow
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public string $created_at,
        public string $product,
        public string $category,
        public bool $discounted,
        public string $username,
        public int $quantity,
        public float $total,
        public string $state,
    )
    {
        //
    }
}
