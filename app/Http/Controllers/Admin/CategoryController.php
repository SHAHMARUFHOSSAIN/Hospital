<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::orderBy('sort_order')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'head_of_dept' => 'nullable|string|max:255',
            'opd_hours' => 'nullable|string|max:255',
            'emergency_contact' => 'nullable|string|max:255',
            'bed_info' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);
        
        $data = [
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'head_of_dept' => $request->input('head_of_dept'),
            'opd_hours' => $request->input('opd_hours'),
            'emergency_contact' => $request->input('emergency_contact'),
            'bed_info' => $request->input('bed_info'),
            'description' => $request->input('description', ''),
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $request->input('sort_order', 0),
        ];
        
        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            $data['logo'] = $request->file('logo')->store('categories', 'public');
        }
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $data['image'] = $request->file('image')->store('categories', 'public');
        }
        
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                if ($image->isValid()) {
                    $images[] = $image->store('categories/gallery', 'public');
                }
            }
            if (!empty($images)) {
                $data['images'] = $images;
            }
        }
        
        $videoUrl = $request->input('video_url');
        if ($videoUrl) {
            $data['video_url'] = $videoUrl;
        }
        
        Category::create($data);
        
        return redirect()->route('admin.categories.index')->with('success', 'Clinical Department created successfully!');
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,' . $category->id,
            'head_of_dept' => 'nullable|string|max:255',
            'opd_hours' => 'nullable|string|max:255',
            'emergency_contact' => 'nullable|string|max:255',
            'bed_info' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);
        
        $data = [
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'head_of_dept' => $request->input('head_of_dept'),
            'opd_hours' => $request->input('opd_hours'),
            'emergency_contact' => $request->input('emergency_contact'),
            'bed_info' => $request->input('bed_info'),
            'description' => $request->input('description', ''),
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $request->input('sort_order', 0),
        ];
        
        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            $data['logo'] = $request->file('logo')->store('categories', 'public');
        }
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $data['image'] = $request->file('image')->store('categories', 'public');
        }
        
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                if ($image->isValid()) {
                    $images[] = $image->store('categories/gallery', 'public');
                }
            }
            if (!empty($images)) {
                $existingImages = is_array($category->images) ? $category->images : json_decode($category->images ?? '[]', true);
                $data['images'] = array_merge($existingImages, $images);
            }
        }
        
        $videoUrl = $request->input('video_url');
        if ($videoUrl) {
            $data['video_url'] = $videoUrl;
        }
        
        $category->update($data);
        
        return redirect()->route('admin.categories.index')->with('success', 'Clinical Department updated successfully!');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Clinical Department deleted successfully!');
    }
}