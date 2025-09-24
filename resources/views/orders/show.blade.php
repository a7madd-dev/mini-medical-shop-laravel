<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Order Details') }} #{{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="table-responsive bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">

                <h3 class="text-lg font-semibold mb-4">Customer Information</h3>
                <p><strong>Name:</strong> {{ $order->customer_name }}</p>
                <p><strong>Phone:</strong> {{ $order->customer_phone }}</p>
                <p><strong>Address:</strong> {{ $order->customer_address }}</p>
                <p><strong>Total:</strong> <span class="font-bold text-green-600">${{ $order->total }}</span></p>
                <p><strong>Date:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>

                <hr class="my-4">

                <h3 class="text-lg font-semibold mb-4">Ordered Products</h3>
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-gray-700">
                            <th class="p-3 text-left">Product</th>
                            <th class="p-3 text-left">Quantity</th>
                            <th class="p-3 text-left">Price</th>
                            <th class="p-3 text-left">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr class="border-b dark:border-gray-600">
                                <td class="p-3">{{ $item->product->name }}</td>
                                <td class="p-3">{{ $item->quantity }}</td>
                                <td class="p-3">${{ $item->product->price }}</td>
                                <td class="p-3 font-bold">${{ $item->product->price * $item->quantity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-6">
                    <a href="{{ route('orders.index') }}" 
                       class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                        Back to Orders
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
