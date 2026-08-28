@extends('layouts.guest')

@section('content')
<form method="POST" action="{{ route('register') }}">
@csrf

<div>
    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
</div>

<div class="mt-4">
    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
    <input id="email" type="email" name="email" value="{{ old('email') }}" required
        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
</div>

<div class="mt-4">
    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
    <input id="password" type="password" name="password" required
        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
</div>

<div class="mt-4">
    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
    <input id="password_confirmation" type="password" name="password_confirmation" required
        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
</div>

<div class="flex items-center justify-end mt-4">
    <a class="underline text-sm text-gray-600" href="{{ route('login') }}">Already registered?</a>
    <button type="submit" class="ml-4 px-4 py-2 bg-[#296d6d] text-white rounded-md hover:bg-[#235d5d]">Register</button>
</div>
</form>