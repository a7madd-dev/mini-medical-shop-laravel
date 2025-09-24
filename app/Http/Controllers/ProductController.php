<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Public product listing (Customer Side)
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        // Sort
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
            }
        } else {
            $query->latest(); // default
        }

        $products = $query->paginate(10);

        // For filter dropdown
        $categories = Product::select('category')->distinct()->pluck('category');

        return view('products.index', compact('products', 'categories'));
    }
    /**
     * Show the form for creating a new product (Admin Side).
     */
        public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created product in storage (Admin Side).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'image'       => 'nullable|image|max:2048',
            'category'    => 'nullable|string|max:255',
            'new_category'=> 'nullable|string|max:255',
        ]);

                // If "Add new" was chosen, use new_category
        if ($request->category === '__new' && $request->filled('new_category')) {
            $validated['category'] = $request->new_category;
        }
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Show details of a single product (optional).
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing a product (Admin Side).
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Admin product listing (Dashboard) (Admin Side).
     */
    public function adminIndex(Request $request)
    {
        $query = Product::query();

        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        } else {
            $query->latest();
        }

        $products = $query->paginate(10)->appends($request->query());
        $categories = Product::select('category')->distinct()->pluck('category');

        return view('dashboard', compact('products', 'categories'));
    }



    /**
     * Update the specified product in storage (Admin Side).
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'image'       => 'nullable|image|max:2048',
            'category'    => 'nullable|string|max:255',
            'new_category'=> 'nullable|string|max:255',
        ]);

        // If "Add new" was chosen, use new_category
        if ($request->category === '__new' && $request->filled('new_category')) {
            $validated['category'] = $request->new_category;
        }
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Soft-delete the product (Admin Side).
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
