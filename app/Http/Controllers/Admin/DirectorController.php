<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Director;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class DirectorController extends Controller
{
    public function index(): View
    {
        $directors = Director::orderBy('sort_order')->get();
        return view('admin.directors.index', compact('directors'));
    }

    public function create(): View
    {
        return view('admin.directors.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:directors,slug',
        ]);
        
        $data = [
            'name' => $request->input('name'),
            'slug' => \Illuminate\Support\Str::slug($request->input('slug')),
            'designation' => $request->input('designation', ''),
            'degree' => $request->input('degree', ''),
            'specialization' => $request->input('specialization', ''),
            'experience_years' => $request->input('experience_years', 10),
            'consultation_fee' => $request->input('consultation_fee', 1000.00),
            'chamber_days' => $request->input('chamber_days', 'Sat - Wed'),
            'chamber_time' => $request->input('chamber_time', '4:00 PM - 8:00 PM'),
            'room_no' => $request->input('room_no', 'Room 302'),
            'bio' => $request->input('bio', ''),
            'facebook' => $request->input('facebook', ''),
            'linkedin' => $request->input('linkedin', ''),
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $request->input('sort_order', 0),
        ];
        
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $data['photo'] = $request->file('photo')->store('directors', 'public');
        }
        
        Director::create($data);
        
        return redirect()->route('admin.directors.index')->with('success', 'Doctor profile created successfully!');
    }

    public function edit(Director $director): View
    {
        return view('admin.directors.edit', compact('director'));
    }

    public function update(Request $request, Director $director): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:directors,slug,' . $director->id,
        ]);
        
        $data = [
            'name' => $request->input('name'),
            'slug' => \Illuminate\Support\Str::slug($request->input('slug')),
            'designation' => $request->input('designation', ''),
            'degree' => $request->input('degree', ''),
            'specialization' => $request->input('specialization', ''),
            'experience_years' => $request->input('experience_years', 10),
            'consultation_fee' => $request->input('consultation_fee', 1000.00),
            'chamber_days' => $request->input('chamber_days', 'Sat - Wed'),
            'chamber_time' => $request->input('chamber_time', '4:00 PM - 8:00 PM'),
            'room_no' => $request->input('room_no', 'Room 302'),
            'bio' => $request->input('bio', ''),
            'facebook' => $request->input('facebook', ''),
            'linkedin' => $request->input('linkedin', ''),
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $request->input('sort_order', 0),
        ];
        
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $data['photo'] = $request->file('photo')->store('directors', 'public');
        }
        
        $director->update($data);
        
        return redirect()->route('admin.directors.index')->with('success', 'Doctor profile updated successfully!');
    }

    public function destroy(Director $director): RedirectResponse
    {
        $director->delete();
        return redirect()->route('admin.directors.index')->with('success', 'Doctor profile deleted!');
    }
}