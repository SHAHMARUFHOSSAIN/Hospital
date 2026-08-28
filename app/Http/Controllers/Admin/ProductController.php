<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductImage;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::with('category');
        
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }
        
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        $products = $query->orderBy('sort_order')->paginate(20);
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        
        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create(): View
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
        ]);
        
        $slug = $request->filled('slug') ? Str::slug($request->input('slug')) : Str::slug($request->input('name'));
        
        // Ensure unique slug
        $count = Product::where('slug', $slug)->count();
        if ($count > 0) {
            $slug = $slug . '-' . (time() % 1000);
        }

        $data = [
            'category_id' => $request->input('category_id'),
            'name' => $request->input('name'),
            'slug' => $slug,
            'description' => $request->input('description', ''),
            'specifications' => $request->input('specifications', ''),
            'is_featured' => $request->boolean('is_featured', false),
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $request->input('sort_order', 0),
        ];
        
        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
            $data['thumbnail'] = $request->file('thumbnail')->store('products', 'public');
        }
        
        $product = Product::create($data);
        
        return redirect()->route('admin.products.index')->with('success', 'Medical Service / Package created successfully.');
    }

    public function edit(Product $product): View
    {
        $product->load(['variants', 'images']);
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
        ]);
        
        $slug = $request->filled('slug') ? Str::slug($request->input('slug')) : Str::slug($request->input('name'));
        
        $data = [
            'category_id' => $request->input('category_id'),
            'name' => $request->input('name'),
            'slug' => $slug,
            'description' => $request->input('description', ''),
            'specifications' => $request->input('specifications', ''),
            'is_featured' => $request->boolean('is_featured', false),
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $request->input('sort_order', 0),
        ];
        
        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
            $data['thumbnail'] = $request->file('thumbnail')->store('products', 'public');
        }
        
        $product->update($data);
        
        return redirect()->route('admin.products.index')->with('success', 'Medical Service / Package updated successfully');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully');
    }

    public function storeVariant(Request $request, Product $product): RedirectResponse
    {
        $data = $request->validate([
            'size' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:50',
            'sku' => 'nullable|string|max:100',
            'price' => 'nullable|numeric|min:0',
            'stock' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);
        
        $product->variants()->create($data);
        
        return back()->with('success', 'Variant added');
    }

    public function destroyVariant(ProductVariant $variant): RedirectResponse
    {
        $variant->delete();
        return back()->with('success', 'Variant deleted');
    }

    public function storeImage(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);
        
        $image = $request->file('image')->store('products', 'public');
        
        $product->images()->create([
            'image' => $image,
            'sort_order' => $product->images()->count(),
        ]);
        
        return back()->with('success', 'Image added');
    }

    public function destroyImage(ProductImage $image): RedirectResponse
    {
        $image->delete();
        return back()->with('success', 'Image deleted');
    }
}