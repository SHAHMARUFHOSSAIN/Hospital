<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HealthBlog;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class HealthBlogController extends Controller
{
    public function index(): View
    {
        $blogs = HealthBlog::orderBy('created_at', 'desc')->get();
        return view('admin.health_blogs.index', compact('blogs'));
    }

    public function create(): View
    {
        return view('admin.health_blogs.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'category' => 'required|string|max:255',
            'content' => 'required|string',
            'published_at' => 'nullable|date',
            'image' => 'nullable|image|max:5120',
        ]);

        $data = [
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']) . '-' . rand(100, 999),
            'author' => $validated['author'] ?? 'CarePlus Medical Editorial Board',
            'category' => $validated['category'],
            'content' => $validated['content'],
            'published_at' => $validated['published_at'] ?? now()->toDateString(),
            'is_active' => $request->boolean('is_active', true),
        ];

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $data['image'] = $request->file('image')->store('blogs', 'public');
        }

        HealthBlog::create($data);

        return redirect()->route('admin.health-blogs.index')->with('success', 'Health Article created successfully!');
    }

    public function edit(HealthBlog $healthBlog): View
    {
        return view('admin.health_blogs.edit', ['blog' => $healthBlog]);
    }

    public function update(Request $request, HealthBlog $healthBlog): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'category' => 'required|string|max:255',
            'content' => 'required|string',
            'published_at' => 'nullable|date',
            'image' => 'nullable|image|max:5120',
        ]);

        $data = [
            'title' => $validated['title'],
            'author' => $validated['author'] ?? 'CarePlus Medical Editorial Board',
            'category' => $validated['category'],
            'content' => $validated['content'],
            'published_at' => $validated['published_at'] ?? now()->toDateString(),
            'is_active' => $request->boolean('is_active', true),
        ];

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $data['image'] = $request->file('image')->store('blogs', 'public');
        }

        $healthBlog->update($data);

        return redirect()->route('admin.health-blogs.index')->with('success', 'Health Article updated successfully!');
    }

    public function destroy(HealthBlog $healthBlog): RedirectResponse
    {
        $healthBlog->delete();
        return redirect()->route('admin.health-blogs.index')->with('success', 'Health Article deleted successfully!');
    }
}
