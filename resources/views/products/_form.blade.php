@csrf

<div class="mb-4">
    <label class="block font-medium">Name</label>
    <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}"
           class="w-full border rounded px-3 py-2 w-64 dark:bg-gray-700 dark:text-white">
    @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block font-medium">Description</label>
    <textarea name="description" class="w-full border rounded px-3 py-2 w-64 dark:bg-gray-700 dark:text-white">{{ old('description', $product->description ?? '') }}</textarea>
    @error('description') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block font-medium">Price</label>
    <input type="number" step="0.01" name="price" value="{{ old('price', $product->price ?? '') }}"
           class="w-full border rounded px-3 py-2 w-64 dark:bg-gray-700 dark:text-white">
    @error('price') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block font-medium">Stock</label>
    <input type="number" name="stock" value="{{ old('stock', $product->stock ?? '') }}"
           class="w-full border rounded px-3 py-2 w-64 dark:bg-gray-700 dark:text-white">
    @error('stock') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block font-medium">Category</label>
    <select name="category" id="categorySelect"
            class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:text-white">
        <option value="">-- Select Category --</option>
        @foreach(\App\Models\Product::select('category')->distinct()->pluck('category') as $cat)
            <option value="{{ $cat }}" 
                {{ old('category', $product->category ?? '') == $cat ? 'selected' : '' }}>
                {{ $cat }}
            </option>
        @endforeach
        <option value="__new">+ Add New Category</option>
    </select>

    <!-- Hidden input for new category -->
    <input type="text" 
           name="new_category" 
           id="newCategoryInput"
           placeholder="Enter new category"
           class="w-full border rounded px-3 py-2 w-64 dark:bg-gray-700 dark:text-white mt-2 hidden"
           value="{{ old('new_category') }}">

    @error('category') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    @error('new_category') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block font-medium">Image</label>
    <input type="file" name="image" class="w-full border rounded px-3 py-2">
    @if(isset($product) && $product->image)
        <img src="{{ asset('storage/'.$product->image) }}" class="w-20 h-20 object-cover mt-2">
    @endif
    @error('image') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
</div>

<div class="mt-6">
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        {{ $buttonText }}
    </button>
</div>
