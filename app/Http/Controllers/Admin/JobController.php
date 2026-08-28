<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class JobController extends Controller
{
    public function index(Request $request): View
    {
        $query = Job::query();
        
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        
        if ($request->status === 'active') {
            $query->where('is_active', true);
        } elseif ($request->status === 'inactive') {
            $query->where('is_active', false);
        }
        
        $jobs = $query->orderBy('sort_order')->paginate(20);
        
        return view('admin.jobs.index', compact('jobs'));
    }

    public function create(): View
    {
        return view('admin.jobs.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:career_jobs,slug',
        ]);
        
        $data = [
            'title' => $request->input('title'),
            'slug' => $request->input('slug'),
            'description' => $request->input('description', ''),
            'requirements' => $request->input('requirements', ''),
            'location' => $request->input('location', ''),
            'type' => $request->input('type', ''),
            'salary' => $request->input('salary'),
            'deadline' => $request->input('deadline'),
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $request->input('sort_order', 0),
        ];
        
        Job::create($data);
        
        return redirect()->route('admin.jobs.index')->with('success', 'Job created successfully');
    }

    public function edit(Job $job): View
    {
        return view('admin.jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:career_jobs,slug,' . $job->id,
        ]);
        
        $data = [
            'title' => $request->input('title'),
            'slug' => $request->input('slug'),
            'description' => $request->input('description', ''),
            'requirements' => $request->input('requirements', ''),
            'location' => $request->input('location', ''),
            'type' => $request->input('type', ''),
            'salary' => $request->input('salary'),
            'deadline' => $request->input('deadline'),
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $request->input('sort_order', 0),
        ];
        
        $job->update($data);
        
        return redirect()->route('admin.jobs.index')->with('success', 'Job updated successfully');
    }

    public function destroy(Job $job): RedirectResponse
    {
        $job->delete();
        return redirect()->route('admin.jobs.index')->with('success', 'Job deleted successfully');
    }

    public function showApplications(Job $job): View
    {
        $applications = $job->applications()->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.jobs.applications', compact('job', 'applications'));
    }

    public function applications(Request $request): View
    {
        $query = Application::with('job');
        
        if ($request->status) {
            $query->where('status', $request->status);
        }
        
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }
        
        $applications = $query->orderBy('created_at', 'desc')->paginate(20);
        
        return view('admin.applications.index', compact('applications'));
    }

    public function updateApplicationStatus(Request $request, Application $application): RedirectResponse
    {
        $request->validate([
            'status' => 'required|in:pending,reviewing,shortlisted,rejected,hired',
        ]);
        
        $application->update(['status' => $request->status]);
        
        return back()->with('success', 'Application status updated');
    }

    public function destroyApplication(Application $application): RedirectResponse
    {
        $application->delete();
        return back()->with('success', 'Application deleted');
    }
}