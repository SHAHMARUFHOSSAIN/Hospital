@extends('layouts.frontend')
@php use Illuminate\Support\Facades\Route; @endphp

@section('content')
<section class="min-h-screen flex items-center justify-center py-16 hero-gradient">
    <div class="w-full max-w-md px-4">
        <div class="card-3d bg-white rounded-3xl p-10 shadow-3d">
            <div class="text-center mb-8">
                <div class="w-16 h-16 mx-auto bg-gradient-to-br from-[#296d6d] to-[#235d5d] rounded-2xl flex items-center justify-center shadow-lg mb-4">
                    <span class="text-white font-bold text-2xl">AG</span>
                </div>
                <h1 class="text-2xl font-bold">Admin Login</h1>
                <p class="text-gray-500 mt-2">Sign in to your account</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus 
                        class="w-full px-4 py-4 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#296d6d] focus:border-transparent outline-none" 
                        placeholder="admin@alam.com">
                    @error('email')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" name="password" required 
                        class="w-full px-4 py-4 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#296d6d] focus:border-transparent outline-none" 
                        placeholder="••••••••">
                    @error('password')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="w-4 h-4 text-[#296d6d] border-gray-300 rounded focus:ring-[#296d6d]">
                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    </label>
                </div>
                <button type="submit" class="w-full py-4 bg-gradient-to-r from-[#296d6d] to-[#235d5d] text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition">
                    Sign In <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </form>
            <div class="mt-8 text-center">
                <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-[#296d6d] transition">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Website
                </a>
            </div>
        </div>
    </div>
</section>
@endsection