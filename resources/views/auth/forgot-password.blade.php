@extends('layouts.guest')

@section('content')
<div class="mb-4 text-sm text-gray-600">
    Forgot your password? Just let us know your email address and we will email you a password reset link.
</div>

<form method="POST" action="{{ route('password.email') }}">
@csrf

<div>
    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
</div>

<div class="flex items-center justify-end mt-4">
    <button type="submit" class="px-4 py-2 bg-[#296d6d] text-white rounded-md hover:bg-[#235d5d]">Email Password Reset Link</button>
</div>
</form>