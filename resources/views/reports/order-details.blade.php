<x-app-layout>

    <x-slot name="heading">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Order Details
        </h2>
    </x-slot>

    <form
        method="GET"
        action="{{ route('order-details.index') }}"
        >

        {{-- add filters here --}}

        <div class="flex items-center justify-end mt-4">
            <x-button.submit>
                {{ __('Filter') }}
            </x-button.submit>

            <x-button.reset>
                {{ __('Reset') }}
            </x-button.reset>
        </div>
    </form>

    <x-table>
        <x-slot name="head">
            <tr>
                <th>Order ID</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </x-slot>
        <x-slot name="body">
            @foreach($orderDetails as $orderDetail)
                <tr>
                    <td>{{ $orderDetail->order_id }}</td>
                    <td>{{ $orderDetail->product_name }}</td>
                    <td>{{ $orderDetail->quantity }}</td>
                    <td>{{ $orderDetail->price }}</td>
                    <td>{{ $orderDetail->total }}</td>
                </tr>
            @endforeach
        </x-slot>
    </x-table>

</x-app-layout>
