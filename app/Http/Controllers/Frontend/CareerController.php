<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Application;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\ApplicationRequest;

class CareerController extends Controller
{
    public function index(): View
    {
        $jobs = Job::where('is_active', true)
            ->orderBy('sort_order')
            ->paginate(10);
            
        return view('frontend.career.index', compact('jobs'));
    }

    public function show(string $slug): View
    {
        $job = Job::where('slug', $slug)->firstOrFail();
        return view('frontend.career.show', compact('job'));
    }

    public function apply(ApplicationRequest $request, string $slug): View
    {
        $job = Job::where('slug', $slug)->firstOrFail();
        
        $application = new Application();
        $application->job_id = $job->id;
        $application->name = $request->name;
        $application->email = $request->email;
        $application->phone = $request->phone;
        $application->address = $request->address;
        $application->cover_letter = $request->cover_letter;
        
        if ($request->hasFile('cv')) {
            $path = $request->file('cv')->store('applications', 'public');
            $application->cv_path = $path;
        }
        
        $application->save();
        
        return view('frontend.career.success', compact('job'));
    }
}