<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BloodDonor;
use Illuminate\Http\Request;

class BloodDonorController extends Controller
{
    public function index(Request $request)
    {
        $query = BloodDonor::latest();

        if ($bloodGroup = $request->input('blood_group')) {
            $query->where('blood_group', $bloodGroup);
        }

        if ($search = $request->input('search')) {
            $query->where('donor_name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
        }

        $donors = $query->paginate(15);
        return view('admin.blood_donors.index', compact('donors'));
    }

    public function create()
    {
        return view('admin.blood_donors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'donor_name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'email' => 'nullable|email|max:255',
            'blood_group' => 'required|string',
            'age' => 'nullable|integer|min:18|max:65',
            'gender' => 'nullable|string',
            'address' => 'nullable|string',
            'last_donated_date' => 'nullable|date',
            'is_eligible' => 'boolean',
            'notes' => 'nullable|string',
        ]);

        $donor = BloodDonor::create($validated);

        return redirect()->route('admin.blood-donors.index')
            ->with('success', 'Volunteer blood donor registered successfully!');
    }

    public function destroy(BloodDonor $bloodDonor)
    {
        $bloodDonor->delete();
        return redirect()->route('admin.blood-donors.index')
            ->with('success', 'Blood donor removed from directory.');
    }
}
