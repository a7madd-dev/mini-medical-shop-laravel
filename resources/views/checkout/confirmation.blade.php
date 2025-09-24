<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Order Confirmation
        </h2>
    </x-slot>

    <!-- Outer wrapper same as Cart/Checkout -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
        <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
            <div class="max-w-3xl mx-auto">
                <p class="text-gray-800 dark:text-gray-200 text-lg mb-2">
                    Thank you, <span class="font-semibold">{{ $order->customer_name }}</span>! </p>
                <p class="text-gray-700 dark:text-gray-300 mb-4">
					Your order has been placed successfully.</p>
                <p class="text-gray-700 dark:text-gray-300 mb-4">
                    We will contact you at 
                    <span class="font-semibold">{{ $order->customer_phone }}</span> 
                    and deliver to 
                    <span class="font-semibold">{{ $order->customer_address }}</span>.
                </p>

                <!-- Order Summary -->
                <h3 class="font-semibold text-gray-800 dark:text-gray-200 mt-6 mb-2">Order Summary</h3>
                <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4">
                    @php $total = 0; @endphp
                    <ul class="space-y-2">
                        @foreach($order->items as $item)
                            @php 
                                $line = $item->price * $item->quantity;
                                $total += $line;
                            @endphp
                            <li class="flex justify-between text-gray-800 dark:text-gray-200">
                                <span>{{ $item->product->name }} x {{ $item->quantity }}</span>
                                <span class="font-semibold">${{ number_format($line, 2) }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Total -->
                <p class="mt-4 text-lg font-bold text-gray-800 dark:text-gray-200">
                    Total: ${{ number_format($total, 2) }}
                </p>

                <!-- Back to Home -->
                <div class="mt-6">
                    <a href="{{ url('/') }}" 
                       class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                        Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
