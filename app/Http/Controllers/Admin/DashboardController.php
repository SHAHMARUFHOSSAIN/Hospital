<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Job;
use App\Models\Application;
use App\Models\Showroom;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'categories' => Category::count(),
            'products' => Product::count(),
            'jobs' => Job::count(),
            'applications' => Application::count(),
            'showrooms' => Showroom::count(),
        ];
        
        $recentApplications = Application::with('job')->orderBy('created_at', 'desc')->take(10)->get();
        
        return view('admin.dashboard', compact('stats', 'recentApplications'));
    }
}