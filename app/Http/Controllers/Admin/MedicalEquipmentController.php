<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MedicalEquipment;
use Illuminate\Http\Request;

class MedicalEquipmentController extends Controller
{
    public function index()
    {
        $equipments = MedicalEquipment::latest()->paginate(10);
        return view('admin.medical_equipments.index', compact('equipments'));
    }

    public function create()
    {
        return view('admin.medical_equipments.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'model_name' => 'nullable|string|max:255',
            'manufacturer' => 'nullable|string|max:255',
            'country_of_origin' => 'nullable|string|max:255',
            'department_name' => 'nullable|string|max:255',
            'scan_fee' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'features' => 'nullable|string',
            'specifications' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
            'gallery_images.*' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('equipments', 'public');
        }

        if ($request->hasFile('gallery_images')) {
            $gallery = [];
            foreach ($request->file('gallery_images') as $file) {
                if ($file->isValid()) {
                    $gallery[] = $file->store('equipments/gallery', 'public');
                }
            }
            $validated['gallery_images'] = $gallery;
        }

        $validated['is_active'] = $request->has('is_active');

        MedicalEquipment::create($validated);

        return redirect()->route('admin.medical-equipments.index')->with('success', 'Medical Equipment added successfully!');
    }

    public function edit(MedicalEquipment $medicalEquipment)
    {
        return view('admin.medical_equipments.edit', ['equipment' => $medicalEquipment]);
    }

    public function update(Request $request, MedicalEquipment $medicalEquipment)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'model_name' => 'nullable|string|max:255',
            'manufacturer' => 'nullable|string|max:255',
            'country_of_origin' => 'nullable|string|max:255',
            'department_name' => 'nullable|string|max:255',
            'scan_fee' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'features' => 'nullable|string',
            'specifications' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
            'gallery_images.*' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('equipments', 'public');
        }

        if ($request->hasFile('gallery_images')) {
            $gallery = $medicalEquipment->gallery_images ?? [];
            foreach ($request->file('gallery_images') as $file) {
                if ($file->isValid()) {
                    $gallery[] = $file->store('equipments/gallery', 'public');
                }
            }
            $validated['gallery_images'] = $gallery;
        }

        $validated['is_active'] = $request->has('is_active');

        $medicalEquipment->update($validated);

        return redirect()->route('admin.medical-equipments.index')->with('success', 'Medical Equipment updated successfully!');
    }

    public function destroy(MedicalEquipment $medicalEquipment)
    {
        $medicalEquipment->delete();
        return redirect()->route('admin.medical-equipments.index')->with('success', 'Medical Equipment deleted!');
    }
}
