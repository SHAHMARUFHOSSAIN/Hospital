@extends('layouts.guest')

@section('content')
<div class="mb-4 text-sm text-gray-600">
    Thanks for signing up! Please verify your email address by clicking on the link we just emailed to you.
</div>

@if (session('status') == 'verification-link-sent')
<div class="mb-4 font-medium text-sm text-green-600">
    A new verification link has been sent to your email.
</div>
@endif

<div class="mt-4 flex items-center justify-between">
    <form method="POST" action="{{ route('verification.send') }}">
    @csrf
    <button type="submit" class="px-4 py-2 bg-[#296d6d] text-white rounded-md hover:bg-[#235d5d]">Resend Verification Email</button>
    </form>

    <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="underline text-sm text-gray-600">Log Out</button>
    </form>
</div>