<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class HistoryController extends Controller
{
    public function index(): View
    {
        $histories = History::orderBy('year', 'desc')->get();
        return view('admin.histories.index', compact('histories'));
    }

    public function create(): View
    {
        return view('admin.histories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'year' => 'required|integer|min:1900|max:2100',
            'title' => 'required|string|max:255',
        ]);
        
        $data = [
            'year' => $request->input('year'),
            'title' => $request->input('title'),
            'description' => $request->input('description', ''),
            'sort_order' => $request->input('sort_order', 0),
        ];
        
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $data['image'] = $request->file('image')->store('histories', 'public');
        }
        
        History::create($data);
        
        return redirect()->route('admin.histories.index')->with('success', 'History created successfully');
    }

    public function edit(History $history): View
    {
        return view('admin.histories.edit', compact('history'));
    }

    public function update(Request $request, History $history): RedirectResponse
    {
        $validated = $request->validate([
            'year' => 'required|integer|min:1900|max:2100',
            'title' => 'required|string|max:255',
        ]);
        
        $data = [
            'year' => $request->input('year'),
            'title' => $request->input('title'),
            'description' => $request->input('description', ''),
            'sort_order' => $request->input('sort_order', 0),
        ];
        
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $data['image'] = $request->file('image')->store('histories', 'public');
        }
        
        $history->update($data);
        
        return redirect()->route('admin.histories.index')->with('success', 'History updated successfully');
    }

    public function destroy(History $history): RedirectResponse
    {
        $history->delete();
        return redirect()->route('admin.histories.index')->with('success', 'History deleted successfully');
    }
}