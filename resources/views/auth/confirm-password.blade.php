@extends('layouts.guest')

@section('content')
<div class="mb-4 text-sm text-gray-600">
    This is a secure area. Please confirm your password before continuing.
</div>

<form method="POST" action="{{ route('password.confirm') }}">
@csrf

<div>
    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
    <input id="password" type="password" name="password" required autocomplete="current-password"
        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
</div>

<div class="flex justify-end mt-4">
    <button type="submit" class="px-4 py-2 bg-[#296d6d] text-white rounded-md hover:bg-[#235d5d]">Confirm</button>
</div>
</form>