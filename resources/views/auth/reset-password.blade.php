@extends('layouts.guest')

@section('content')
<form method="POST" action="{{ route('password.store') }}">
@csrf

<input type="hidden" name="token" value="{{ $request->route('token') }}">

<div>
    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
    <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus
        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
</div>

<div class="mt-4">
    <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
    <input id="password" type="password" name="password" required autocomplete="new-password"
        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
</div>

<div class="mt-4">
    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
</div>

<div class="flex items-center justify-end mt-4">
    <button type="submit" class="px-4 py-2 bg-[#296d6d] text-white rounded-md hover:bg-[#235d5d]">Reset Password</button>
</div>
</form>