<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cabin;
use Illuminate\Http\Request;

class CabinController extends Controller
{
    public function index()
    {
        $cabins = Cabin::latest()->paginate(10);
        return view('admin.cabins.index', compact('cabins'));
    }

    public function create()
    {
        return view('admin.cabins.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'room_type' => 'required|string|max:255',
            'floor_no' => 'nullable|string|max:255',
            'bed_count' => 'nullable|string|max:255',
            'oxygen_type' => 'nullable|string|max:255',
            'rent_per_day' => 'required|numeric|min:0',
            'amenities' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('cabins', 'public');
        }

        $validated['is_available'] = $request->has('is_available');
        $validated['is_active'] = $request->has('is_active');

        Cabin::create($validated);

        return redirect()->route('admin.cabins.index')->with('success', 'Hospital Cabin created successfully!');
    }

    public function edit(Cabin $cabin)
    {
        return view('admin.cabins.edit', compact('cabin'));
    }

    public function update(Request $request, Cabin $cabin)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'room_type' => 'required|string|max:255',
            'floor_no' => 'nullable|string|max:255',
            'bed_count' => 'nullable|string|max:255',
            'oxygen_type' => 'nullable|string|max:255',
            'rent_per_day' => 'required|numeric|min:0',
            'amenities' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('cabins', 'public');
        }

        $validated['is_available'] = $request->has('is_available');
        $validated['is_active'] = $request->has('is_active');

        $cabin->update($validated);

        return redirect()->route('admin.cabins.index')->with('success', 'Hospital Cabin updated successfully!');
    }

    public function destroy(Cabin $cabin)
    {
        $cabin->delete();
        return redirect()->route('admin.cabins.index')->with('success', 'Hospital Cabin deleted!');
    }
}
