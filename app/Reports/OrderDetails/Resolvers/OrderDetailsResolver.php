<?php

namespace App\Reports\OrderDetails\Resolvers;

use App\Models\OrderDetail;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Collection;

class OrderDetailsResolver
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /** @return Collection<int, OrderDetail> */
    public function resolve(
        CarbonImmutable $startDate,
        CarbonImmutable $endDate,
        ?string $productName = null,
        ?string $productCategory = null,
        ?bool $wasDiscounted = null,
        ?string $username = null,
        ?string $state = null,
    ): Collection {
        return OrderDetail::query()
            ->when($productName, fn ($query) => $query->whereRelation('items.product', 'name', 'like', '%'.$productName.'%'))
            ->when($productCategory, fn ($query) => $query->whereRelation('items.product.category', 'name', $productCategory))
            ->when(is_bool($wasDiscounted), function ($query, $wasDiscounted) {
                $relationCheck = $wasDiscounted ? 'whereHas' : 'whereDoesntHave';
                $query->{$relationCheck}('items.product.discount');
            })
            ->when($username, fn ($query) => $query->whereRelation('user', 'username', $username))
            ->when($state, fn ($query) => $query->whereRelation('address', 'state', $state))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->with([
                'user.addresses',
                'items.product' => [
                    'category',
                    'inventory',
                    'discount',
                ],
                'paymentDetail',
                'address',
            ])
            ->get();
    }
}
