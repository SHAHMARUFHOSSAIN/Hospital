<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Director;
use App\Models\DiagnosticTest;
use Illuminate\View\View;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::where('is_active', true)->withCount('products')->orderBy('sort_order')->get();
        return view('frontend.categories.index', compact('categories'));
    }

    public function show(string $slug): View
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = $category->products()->where('is_active', true)->get();
        
        // Match doctors by specialization or department name
        $doctors = Director::where('is_active', true)
            ->where(function ($q) use ($category) {
                $q->where('specialization', 'like', '%' . $category->name . '%')
                  ->orWhere('designation', 'like', '%' . $category->name . '%');
            })->get();

        // If no direct match, load active doctors as department consultants
        if ($doctors->isEmpty()) {
            $doctors = Director::where('is_active', true)->take(4)->get();
        }

        // Match diagnostic tests under this department
        $tests = DiagnosticTest::where('is_active', true)
            ->where('category_name', 'like', '%' . $category->name . '%')
            ->get();

        return view('frontend.categories.show', compact('category', 'products', 'doctors', 'tests'));
    }
}