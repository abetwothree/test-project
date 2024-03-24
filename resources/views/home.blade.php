<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
            }
            table, th, td {
                border: 1px solid black;
            }
            th, td {
                padding: 10px;
                text-align: left;
            }
            table tr.highlight {
                background-color: yellow !important;
            }
        </style>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    </head>
<body>
   
    <table class="table-bordered">
        @include('order_detail_filter')
        <tbody id="orderDetails">
            @forelse($orderDetails as $order)
                <tr class="{{ $order->items->first()->product->discount->active &&
                                $order->items->first()->product->discount->discount_percent > 0 ?
                                'highlight' : '' }}">
                    <td>{{ $order->created_at }}</td>
                    <td>{{ $order->items->first()->product->name }}</td>
                    <td>{{ $order->items->first()->product->category->name }}</td>
                    <td>{{ 
                        $order->items->first()->product->discount->active &&
                        $order->items->first()->product->discount->discount_percent > 0 ?
                        'true' : 'false' 
                        }}
                    </td>
                    <td>{{ $order->user->username }}</td>
                    <td>{{ $order->items->first()->quantity }}</td>
                    <td>{{ $order->total }}</td>
                    <td>{{ $order->address->state }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">No orders found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
