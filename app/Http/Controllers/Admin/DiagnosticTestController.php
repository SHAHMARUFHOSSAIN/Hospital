<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiagnosticTest;
use Illuminate\Http\Request;

class DiagnosticTestController extends Controller
{
    public function index()
    {
        $tests = DiagnosticTest::latest()->paginate(15);
        return view('admin.diagnostic_tests.index', compact('tests'));
    }

    public function create()
    {
        return view('admin.diagnostic_tests.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'category_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'preparation_instructions' => 'nullable|string',
        ]);

        $validated['is_active'] = $request->has('is_active');

        DiagnosticTest::create($validated);

        return redirect()->route('admin.diagnostic-tests.index')->with('success', 'Diagnostic Test added successfully!');
    }

    public function edit(DiagnosticTest $diagnosticTest)
    {
        return view('admin.diagnostic_tests.edit', ['test' => $diagnosticTest]);
    }

    public function update(Request $request, DiagnosticTest $diagnosticTest)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'category_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'preparation_instructions' => 'nullable|string',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $diagnosticTest->update($validated);

        return redirect()->route('admin.diagnostic-tests.index')->with('success', 'Diagnostic Test updated!');
    }

    public function destroy(DiagnosticTest $diagnosticTest)
    {
        $diagnosticTest->delete();
        return redirect()->route('admin.diagnostic-tests.index')->with('success', 'Diagnostic Test deleted!');
    }
}
