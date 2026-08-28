<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Showroom;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ShowroomController extends Controller
{
    public function index(Request $request): View
    {
        $query = Showroom::with('category');
        
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        $showrooms = $query->orderBy('sort_order')->paginate(20);
        return view('admin.showrooms.index', compact('showrooms'));
    }

    public function create(): View
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.showrooms.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:showrooms,slug',
        ]);
        
        $data = [
            'category_id' => $request->input('category_id'),
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'description' => $request->input('description', ''),
            'video_url' => $request->input('video_url', ''),
            'address' => $request->input('address', ''),
            'phone' => $request->input('phone', ''),
            'email' => $request->input('email', ''),
            'map_embed' => $request->input('map_embed', ''),
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $request->input('sort_order', 0),
        ];
        
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $data['image'] = $request->file('image')->store('showrooms', 'public');
        }
        
        Showroom::create($data);
        
        return redirect()->route('admin.showrooms.index')->with('success', 'Showroom created successfully');
    }

    public function edit(Showroom $showroom): View
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.showrooms.edit', compact('showroom', 'categories'));
    }

    public function update(Request $request, Showroom $showroom): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:showrooms,slug,' . $showroom->id,
        ]);
        
        $data = [
            'category_id' => $request->input('category_id'),
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'description' => $request->input('description', ''),
            'video_url' => $request->input('video_url', ''),
            'address' => $request->input('address', ''),
            'phone' => $request->input('phone', ''),
            'email' => $request->input('email', ''),
            'map_embed' => $request->input('map_embed', ''),
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $request->input('sort_order', 0),
        ];
        
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $data['image'] = $request->file('image')->store('showrooms', 'public');
        }
        
        $showroom->update($data);
        
        return redirect()->route('admin.showrooms.index')->with('success', 'Showroom updated successfully');
    }

    public function destroy(Showroom $showroom): RedirectResponse
    {
        $showroom->delete();
        return redirect()->route('admin.showrooms.index')->with('success', 'Showroom deleted successfully');
    }
}