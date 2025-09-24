<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Checkout
        </h2>
    </x-slot>

    <!-- Outer wrapper matches Cart/Dashboard spacing -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
        <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
            <!-- Keep the form nicely centered & constrained -->
            <div class="max-w-3xl mx-auto">
                <form method="POST" action="{{ route('checkout.store') }}">
                    @csrf

                    <!-- Full Name -->
                    <div class="mb-4">
                        <label class="block font-medium text-gray-800 dark:text-gray-200">Full Name</label>
                        <input type="text"
                               name="customer_name"
                               value="{{ old('customer_name') }}"
                               class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:text-white"
                               placeholder="Full Name"
                               required>
                        @error('customer_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div class="mb-4">
                        <label class="block font-medium text-gray-800 dark:text-gray-200">Phone</label>
                        <input type="tel"
                               name="phone"
                               value="{{ old('phone') }}"
                               pattern="[0-9]{1,12}"
                               maxlength="12"
                               inputmode="numeric"
                               class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:text-white"
                               placeholder="Enter phone number"
                               required>
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div class="mb-4">
                        <label class="block font-medium text-gray-800 dark:text-gray-200">Delivery Address</label>
                        <textarea name="address"
                                  class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:text-white"
                                  placeholder="Enter Delivery Address"
                                  required>{{ old('address') }}</textarea>
                        @error('address')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Order Summary -->
                    <h3 class="font-semibold mt-6 mb-2 text-gray-800 dark:text-gray-200">Order Summary</h3>
                    <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-4 mb-4">
                        @php
                            $total = 0;
                        @endphp

                        <ul class="space-y-2">
                            @forelse($cart as $item)
                                @php
                                    $line = $item['price'] * $item['quantity'];
                                    $total += $line;
                                @endphp
                                <li class="flex justify-between text-gray-800 dark:text-gray-200">
                                    <span>{{ $item['name'] }} x {{ $item['quantity'] }}</span>
                                    <span class="font-semibold">${{ number_format($line, 2) }}</span>
                                </li>
                            @empty
                                <li class="text-gray-700 dark:text-gray-300">Your cart is empty.</li>
                            @endforelse
                        </ul>
                    </div>

                    <!-- Total & Submit -->
                    <div class="flex items-center justify-between gap-4">
                        <div class="text-lg font-bold text-gray-800 dark:text-gray-200">
                            Total: ${{ number_format($total, 2) }}
                        </div>

                        <button type="submit"
                                class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition">
                            Place Order
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
