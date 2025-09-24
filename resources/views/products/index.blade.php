<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <!-- Title -->
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Products
            </h2>

            <!-- Search + Filter + Sort -->
            <form method="GET" action="{{ url('/') }}" class="flex flex-wrap items-center gap-3">
                <!-- Search -->
                <input type="text" name="search" value="{{ request('search') }}" 
                    placeholder="Search..."
                    class="border rounded px-3 py-2 dark:bg-gray-700 dark:text-white w-40 md:w-56">

                <!-- Category Filter -->
                <select name="category" class="border rounded px-3 py-2 dark:bg-gray-700 dark:text-white">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                            {{ ucfirst($category) }}
                        </option>
                    @endforeach
                </select>

                <!-- Sort -->
                <select name="sort" class="border rounded px-3 py-2 dark:bg-gray-700 dark:text-white">
                    <option value="">Sort By</option>
                    <option value="price_asc"  {{ request('sort')=='price_asc' ? 'selected':'' }}>Price: Low → High</option>
                    <option value="price_desc" {{ request('sort')=='price_desc' ? 'selected':'' }}>Price: High → Low</option>
                    <option value="name_asc"   {{ request('sort')=='name_asc' ? 'selected':'' }}>Name: A → Z</option>
                    <option value="name_desc"  {{ request('sort')=='name_desc' ? 'selected':'' }}>Name: Z → A</option>
                </select>

                <!-- Submit -->
                <button type="submit" 
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700">
                    Apply
                </button>
            </form>
        </div>
    </x-slot>

    <!-- Outer wrapper same as Cart/Checkout/Confirmation -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6 py-4">
        <div class="bg-white dark:bg-gray-800 shadow rounded-xl p-6">
            
            <!-- Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($products as $product)
                    <div class="border rounded-lg bg-white dark:bg-gray-900 shadow p-4 flex flex-col">
                        <img src="{{ $product->image ? asset('storage/'.$product->image) : asset('storage/images/no-image.png') }}" 
                             class="w-full h-70 object-cover rounded mb-3" 
                             alt="{{ $product->name }}">

                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $product->name }}</h3>
                        <p class="text-gray-600 dark:text-gray-300 text-sm line-clamp-3">
                            {{ $product->description }}
                        </p>
                        <p class="text-green-600 font-bold mt-2">${{ $product->price }}</p>

                        <div class="mt-auto">
                            @if($product->stock > 0)
                                <form method="POST" action="{{ route('cart.add', $product->id) }}">
                                    @csrf
                                    <button type="submit" 
                                        class="w-full bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                                        Add to Cart
                                    </button>
                                </form>
                            @else
                                <button disabled
                                    class="w-full bg-gray-500 text-white px-4 py-2 rounded cursor-not-allowed">
                                    OUT OF STOCK
                                </button>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="col-span-5 text-gray-600 dark:text-gray-300">No products found.</p>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $products->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
