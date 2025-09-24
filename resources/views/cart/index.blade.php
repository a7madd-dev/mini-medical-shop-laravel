<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Your Cart
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6 py-4">
        <div class="table-responsive bg-white dark:bg-gray-800 rounded-xl shadow p-6">
            @if(empty($cart))
                <p class="text-gray-700 dark:text-gray-300">Your cart is empty.</p>
            @else
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-gray-700">
                            <th class="p-3 text-left">Product</th>
                            <th class="p-3 text-left">Price</th>
                            <th class="p-3 text-left">Qty</th>
                            <th class="p-3 text-left">Total</th>
                            <th class="p-3 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $id => $item)
                            <tr class="border-b dark:border-gray-600 text-white">
                                <td class="p-3">{{ $item['name'] }}</td>
                                <td class="p-3">${{ $item['price'] }}</td>
                                <td class="p-3">
                                    <form method="POST" action="{{ route('cart.update', $id) }}" class="flex items-center gap-2">
                                        @csrf
                                        <input type="number" 
                                               name="quantity" 
                                               value="{{ $item['quantity'] }}" 
                                               min="1" 
                                               class="w-16 px-2 py-1 rounded border dark:bg-gray-700 dark:text-white">
                                        <button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Update</button>
                                    </form>
                                </td>
                                <td class="p-3">${{ $item['price'] * $item['quantity'] }}</td>
                                <td class="p-3">
                                    <form method="POST" action="{{ route('cart.remove', $id) }}">
                                        @csrf
                                        <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <p class="font-bold mt-4 text-gray-800 dark:text-gray-200">
                    Total: ${{ $total }}
                </p>

                <a href="{{ url('/checkout') }}" 
                   class="bg-green-600 text-white px-6 py-2 mt-4 inline-block rounded hover:bg-green-700">
                    Checkout
                </a>
            @endif
        </div>
    </div>
</x-app-layout>
