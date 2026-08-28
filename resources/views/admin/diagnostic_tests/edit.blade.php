@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-3xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-extrabold text-white">Edit Diagnostic Test: {{ $test->name }}</h1>
            <a href="{{ route('admin.diagnostic-tests.index') }}" class="text-xs font-bold text-slate-400 hover:text-white">&larr; Back to Tests List</a>
        </div>

        <form action="{{ route('admin.diagnostic-tests.update', $test) }}" method="POST" class="bg-slate-900 p-8 rounded-2xl border border-slate-800 space-y-5">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Diagnostic Test Name *</label>
                <input type="text" name="name" required value="{{ $test->name }}" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
            </div>

            <div class="grid sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Test Code</label>
                    <input type="text" name="code" value="{{ $test->code }}" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Category Name *</label>
                    <input type="text" name="category_name" required value="{{ $test->category_name }}" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Price / Rate (BDT) *</label>
                    <input type="number" step="0.01" name="price" required value="{{ $test->price }}" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Test Description</label>
                <textarea name="description" rows="2" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7] resize-none">{{ $test->description }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Preparation Instructions</label>
                <textarea name="preparation_instructions" rows="2" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7] resize-none">{{ $test->preparation_instructions }}</textarea>
            </div>

            <div class="pt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ $test->is_active ? 'checked' : '' }} class="rounded">
                    <span class="text-xs text-slate-300 font-bold">Active in Price List</span>
                </label>
            </div>

            <button type="submit" class="w-full py-3.5 bg-[#0284C7] hover:bg-sky-700 text-white font-extrabold text-xs uppercase rounded-xl shadow transition">Update Diagnostic Test</button>
        </form>
    </div>
</div>
@endsection
