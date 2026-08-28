<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BloodBank;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class BloodBankController extends Controller
{
    public function index(): View
    {
        $bloodStocks = BloodBank::orderBy('blood_group')->get();
        return view('admin.blood_banks.index', compact('bloodStocks'));
    }

    public function create(): View
    {
        return view('admin.blood_banks.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'blood_group' => 'required|string|max:10',
            'units_available' => 'required|integer|min:0',
            'contact_number' => 'nullable|string|max:50',
        ]);

        BloodBank::create([
            'blood_group' => strtoupper($validated['blood_group']),
            'units_available' => $validated['units_available'],
            'last_updated' => now()->format('d M Y, h:i A'),
            'contact_number' => $validated['contact_number'] ?? '1-800-CARE-NOW',
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.blood-banks.index')->with('success', 'Blood Bank Group created successfully!');
    }

    public function edit(BloodBank $bloodBank): View
    {
        return view('admin.blood_banks.edit', ['stock' => $bloodBank]);
    }

    public function update(Request $request, BloodBank $bloodBank): RedirectResponse
    {
        $validated = $request->validate([
            'blood_group' => 'required|string|max:10',
            'units_available' => 'required|integer|min:0',
            'contact_number' => 'nullable|string|max:50',
        ]);

        $bloodBank->update([
            'blood_group' => strtoupper($validated['blood_group']),
            'units_available' => $validated['units_available'],
            'last_updated' => now()->format('d M Y, h:i A'),
            'contact_number' => $validated['contact_number'] ?? '1-800-CARE-NOW',
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.blood-banks.index')->with('success', 'Blood Bank Stock updated successfully!');
    }

    public function destroy(BloodBank $bloodBank): RedirectResponse
    {
        $bloodBank->delete();
        return redirect()->route('admin.blood-banks.index')->with('success', 'Blood Bank Group deleted successfully!');
    }
}
