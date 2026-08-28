@extends('layouts.frontend')

@section('content')
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('about') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-indigo-500 transition mb-8">
            <i class="fas fa-arrow-left"></i> Back to About
        </a>
        <div class="max-w-3xl mx-auto">
            <span class="inline-block px-4 py-1 bg-indigo-100 text-indigo-600 rounded-full text-sm font-semibold mb-4">Mission</span>
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Our Mission</h1>
            <div class="section-divider w-20 mb-8"></div>
        </div>
    </div>
</section>

<section class="pb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <p class="text-gray-600 leading-relaxed text-lg mb-8">
                At Alam Buttons, our mission is to deliver premium quality garments and fashion solutions that exceed customer expectations. We are committed to:
            </p>

            <ul class="space-y-6 mb-12">
                <li class="flex items-start gap-4">
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                        <i class="fas fa-check text-green-500 text-sm"></i>
                    </div>
                    <span class="text-gray-600">Providing exceptional quality products crafted with attention to detail</span>
                </li>
                <li class="flex items-start gap-4">
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                        <i class="fas fa-check text-green-500 text-sm"></i>
                    </div>
                    <span class="text-gray-600">Maintaining ethical and sustainable manufacturing practices</span>
                </li>
                <li class="flex items-start gap-4">
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                        <i class="fas fa-check text-green-500 text-sm"></i>
                    </div>
                    <span class="text-gray-600">Continuously innovating to meet evolving fashion needs</span>
                </li>
                <li class="flex items-start gap-4">
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                        <i class="fas fa-check text-green-500 text-sm"></i>
                    </div>
                    <span class="text-gray-600">Building lasting relationships with customers and partners</span>
                </li>
                <li class="flex items-start gap-4">
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                        <i class="fas fa-check text-green-500 text-sm"></i>
                    </div>
                    <span class="text-gray-600">Empowering our workforce through training and development</span>
                </li>
            </ul>

            <blockquote class="border-l-4 border-indigo-500 pl-6 py-4 bg-indigo-50 rounded-r-xl">
                <p class="text-gray-600 italic text-lg">"Quality is not an act, it is a habit. We believe in doing things right the first time, every time."</p>
            </blockquote>
        </div>
    </div>
</section>
@endsection