<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PageController extends Controller
{
    public function index(): View
    {
        $pages = Page::orderBy('title')->get();
        return view('admin.pages.index', compact('pages'));
    }

    public function create(): View
    {
        return view('admin.pages.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug',
        ]);
        
        $data = [
            'title' => $request->input('title'),
            'slug' => $request->input('slug'),
            'content' => $request->input('content', ''),
            'is_active' => $request->boolean('is_active', true),
        ];
        
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $data['image'] = $request->file('image')->store('pages', 'public');
        }
        
        Page::create($data);
        
        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully');
    }

    public function edit(Page $page): View
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug,' . $page->id,
        ]);
        
        $data = [
            'title' => $request->input('title'),
            'slug' => $request->input('slug'),
            'content' => $request->input('content', ''),
            'is_active' => $request->boolean('is_active', true),
        ];
        
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $data['image'] = $request->file('image')->store('pages', 'public');
        }
        
        $page->update($data);
        
        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully');
    }

    public function destroy(Page $page): RedirectResponse
    {
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully');
    }

    public function mediaIndex(): View
    {
        $type = request('type', 'all');
        
        $media = Media::when($type && $type !== 'all', function($query) use ($type) {
            return $query->where('type', $type);
        })->orderBy('sort_order')->get();
        
        return view('admin.media.index', compact('media'));
    }

    public function mediaStore(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'type' => 'required|in:logo,image,video,slider,brand,gallery,certification',
        ]);
        
        $data = [
            'title' => $request->input('title', ''),
            'type' => $request->input('type'),
            'url' => $request->input('url', ''),
            'alt' => $request->input('alt', ''),
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $request->input('sort_order', 0),
        ];
        
        if ($request->hasFile('file_path') && $request->file('file_path')->isValid()) {
            $data['file_path'] = $request->file('file_path')->store('media', 'public');
        }

        $type = $request->input('type');
        if (in_array($type, ['brand', 'certification']) && $data['title'] !== '' && isset($data['file_path'])) {
            $existing = Media::where('type', $type)
                ->where('title', $data['title'])
                ->where(function ($q) {
                    $q->whereNull('file_path')->orWhere('file_path', '');
                })
                ->first();
            if ($existing) {
                $existing->update($data);
                return back()->with('success', 'Image added successfully');
            }
        }

        if (!isset($data['file_path']) && in_array($type, ['brand', 'certification', 'gallery'])) {
            return back()->with('error', 'Please select an image file to upload.');
        }

        Media::create($data);
        
        return back()->with('success', 'Media uploaded successfully');
    }

    public function mediaSetLogo(Media $media): RedirectResponse
    {
        Media::where('type', 'logo')->update(['is_active' => false]);
        $media->update(['type' => 'logo', 'is_active' => true]);
        
        return back()->with('success', 'Logo updated successfully');
    }

    public function mediaDestroy(Media $media): RedirectResponse
    {
        $media->delete();
        return back()->with('success', 'Media deleted');
    }

    public function videoUpdate(Request $request): RedirectResponse
    {
        $request->validate(['factory_video_url' => 'nullable|url|max:500']);

        \App\Models\Setting::set('factory_video_url', $request->input('factory_video_url', ''));

        return back()->with('success', 'Factory video URL updated');
    }
}