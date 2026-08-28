<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::where('is_active', true)->with('category');
        
        if ($request->category) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $request->category));
        }
        
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        $products = $query->orderBy('sort_order')->paginate(12);
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        
        return view('frontend.products.index', compact('products', 'categories'));
    }

    public function show(string $slug): View
    {
        $product = Product::where('slug', $slug)->with(['category', 'variants', 'images'])->firstOrFail();
        $images = $product->images;
        $relatedProducts = $product->category->products()->where('id', '!=', $product->id)->where('is_active', true)->take(4)->get();
        
        return view('frontend.products.show', compact('product', 'images', 'relatedProducts'));
    }
}