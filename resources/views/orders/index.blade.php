<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Orders</h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="table-responsive bg-white dark:bg-gray-800 shadow rounded-xl p-6">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200 dark:bg-gray-700">
                        <th class="p-3">Order ID</th>
                        <th class="p-3">Customer</th>
                        <th class="p-3">Phone</th>
                        <th class="p-3">Address</th>
                        <th class="p-3">Total</th>
                        <th class="p-3">Date</th>
                        <th class="p-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr class="border-b dark:border-gray-600">
                            <td class="p-3">{{ $order->id }}</td>
                            <td class="p-3">{{ $order->customer_name }}</td>
                            <td class="p-3">{{ $order->customer_phone }}</td>
                            <td class="p-3">{{ $order->customer_address }}</td>
                            <td class="p-3">${{ $order->total }}</td>
                            <td class="p-3">{{ $order->created_at->format('Y-m-d') }}</td>
                            <td class="p-3">
                                <a href="{{ route('orders.show', $order) }}" 
                                   class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
