<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Showroom;
use Illuminate\View\View;

class ShowroomController extends Controller
{
    public function index(): View
    {
        $showrooms = Showroom::where('is_active', true)->orderBy('sort_order')->get();
        return view('frontend.showrooms.index', compact('showrooms'));
    }

    public function show(string $slug): View
    {
        $showroom = Showroom::where('slug', $slug)->with('category')->firstOrFail();
        return view('frontend.showrooms.show', compact('showroom'));
    }
}