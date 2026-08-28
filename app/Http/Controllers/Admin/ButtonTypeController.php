<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ButtonType;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ButtonTypeController extends Controller
{
    public function index(): View
    {
        $buttonTypes = ButtonType::orderBy('sort_order')->get();
        return view('admin.button-types.index', compact('buttonTypes'));
    }

    public function create(): View
    {
        return view('admin.button-types.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'variant' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        ButtonType::create([
            'name' => $request->input('name'),
            'variant' => $request->input('variant'),
            'description' => $request->input('description', ''),
            'image' => $this->storeImage($request),
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $request->input('sort_order', 0),
        ]);

        return redirect()->route('admin.button-types.index')->with('success', 'Clinical Specialty / Highlight created successfully!');
    }

    private function storeImage(Request $request): ?string
    {
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            return $request->file('image')->store('button-types', 'public');
        }
        return null;
    }

    public function edit(ButtonType $buttonType): View
    {
        return view('admin.button-types.edit', compact('buttonType'));
    }

    public function update(Request $request, ButtonType $buttonType): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'variant' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $data = [
            'name' => $request->input('name'),
            'variant' => $request->input('variant'),
            'description' => $request->input('description', ''),
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $request->input('sort_order', 0),
        ];

        if ($newImage = $this->storeImage($request)) {
            $data['image'] = $newImage;
        }

        $buttonType->update($data);

        return redirect()->route('admin.button-types.index')->with('success', 'Clinical Specialty / Highlight updated successfully!');
    }

    public function destroy(ButtonType $buttonType): RedirectResponse
    {
        $buttonType->delete();
        return redirect()->route('admin.button-types.index')->with('success', 'Clinical Specialty / Highlight deleted successfully!');
    }
}
