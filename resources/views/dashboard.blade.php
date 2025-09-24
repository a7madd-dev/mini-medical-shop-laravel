<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Admin Dashboard') }}
            </h2>
            <div class="flex gap-6 text-l">
                <span class="text-blue-600 font-semibold">Products: {{ \App\Models\Product::count() }}</span>
                <span class="text-green-600 font-semibold">Orders: {{ \App\Models\Order::count() }}</span>
                <span class="text-purple-600 font-semibold">Logs: {{ \App\Models\ProductLog::count() }}</span>
            </div>
        </div>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Product Management Table -->
		<div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
			<!-- Top bar -->
			<div class="flex items-center justify-between mb-6">
				<!-- Left: Title -->
				<h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
					Manage Products
				</h3>

				<!-- Right: Filters + Add Product -->
				<form method="GET" action="{{ route('dashboard') }}" 
					  class="flex flex-wrap items-center gap-3">

					<!-- Search -->
					<input type="text" 
						   name="search" 
						   value="{{ request('search') }}" 
						   placeholder="Search products..." 
						   class="border rounded px-3 py-2 w-48 dark:bg-gray-700 dark:text-white">

					<!-- Category -->
					<select name="category" 
							class="border rounded px-3 py-2 dark:bg-gray-700 dark:text-white">
						<option value="">All Categories</option>
						@foreach($categories as $cat)
							<option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
								{{ $cat }}
							</option>
						@endforeach
					</select>

					<!-- Apply button -->
					<button type="submit" 
							class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700">
						Apply
					</button>

					<!-- Add Product button -->
					<a href="{{ route('products.create') }}" 
					   class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
						+ Add Product
					</a>
					
					
					<a href="{{ route('orders.index') }}" 
					   class="bg-green-600 text-white px-4 py-2 rounded shadow hover:bg-green-700">
						Manage Orders
					</a>
					<a href="{{ route('logs.index') }}" 
					   class="bg-purple-600 text-white px-4 py-2 rounded shadow hover:bg-purple-700">
						View Logs
					</a>
					
				</form>
			</div>

            <!-- Products Table -->
			<div class="table-responsive bg-white dark:bg-gray-800 rounded-xl shadow">
				<table class="w-full border-collapse">
					<thead>
						<tr class="bg-gray-200 dark:bg-gray-700">
							<th class="p-3 text-left">Name</th>
							<th class="p-3 text-left">Price</th>
							<th class="p-3 text-left">Stock</th>
							<th class="p-3 text-left">Category</th>
							<th class="p-3 text-left">Actions</th>
						</tr>
					</thead>
					<tbody>
						@forelse($products as $product)
							<tr class="border-b dark:border-gray-600">
								<td class="p-3">{{ $product->name }}</td>
								<td class="p-3">${{ $product->price }}</td>
								<td class="p-3">{{ $product->stock }}</td>
								<td class="p-3">{{ $product->category ?? '-' }}</td>
								<td class="p-3 flex gap-2">
									<a href="{{ route('products.edit', $product) }}" 
									   class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>
									<form method="POST" action="{{ route('products.destroy', $product) }}" onsubmit="return confirm('Delete this product?')">
										@csrf
										@method('DELETE')
										<button type="submit" 
												class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
											Delete
										</button>
									</form>
								</td>
							</tr>
						@empty
							<tr>
								<td colspan="5" class="p-3 text-center text-gray-600 dark:text-gray-300">
									No products found.
								</td>
							</tr>
						@endforelse
					</tbody>
				</table>
			</div>
            <div class="mt-4">
                {{ $products->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
