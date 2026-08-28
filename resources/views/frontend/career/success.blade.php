@extends('layouts.frontend')

@section('content')
<section class="py-20 bg-white">
    <div class="max-w-2xl mx-auto px-4 text-center">
        <div class="bg-green-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </div>
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Application Submitted!</h1>
        <p class="text-gray-600 mb-6">Thank you for applying for the position. We will review your application and get back to you soon.</p>
        <a href="{{ route('career') }}" class="inline-block px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition">View More Jobs</a>
    </div>
</section>
@endsection