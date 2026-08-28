@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-extrabold text-white">Diagnostic Tests &amp; Price List</h1>
            <a href="{{ route('admin.diagnostic-tests.create') }}" class="px-5 py-2.5 bg-[#0284C7] hover:bg-sky-700 text-white font-bold text-xs rounded-xl transition shadow">
                + Add Diagnostic Test
            </a>
        </div>

        @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 rounded-xl text-xs font-bold">
            {{ session('success') }}
        </div>
        @endif

        <div class="bg-slate-900 rounded-2xl border border-slate-800 overflow-hidden">
            <table class="min-w-full text-xs">
                <thead class="bg-slate-950 text-slate-400 font-extrabold uppercase">
                    <tr>
                        <th class="px-6 py-3.5 text-left">Code</th>
                        <th class="px-6 py-3.5 text-left">Test Name</th>
                        <th class="px-6 py-3.5 text-left">Category</th>
                        <th class="px-6 py-3.5 text-left">Price (BDT)</th>
                        <th class="px-6 py-3.5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800 font-medium">
                    @forelse($tests as $test)
                    <tr class="hover:bg-slate-800/40 transition">
                        <td class="px-6 py-4 text-sky-400 font-bold">{{ $test->code ?: 'TEST-'.$test->id }}</td>
                        <td class="px-6 py-4 text-white font-bold">{{ $test->name }}</td>
                        <td class="px-6 py-4"><span class="px-2.5 py-1 bg-slate-800 text-slate-300 rounded-full text-[10px] font-bold">{{ $test->category_name }}</span></td>
                        <td class="px-6 py-4 text-emerald-400 font-extrabold">৳ {{ number_format($test->price, 2) }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.diagnostic-tests.edit', $test) }}" class="text-sky-400 hover:underline font-bold">Edit</a>
                            <form action="{{ route('admin.diagnostic-tests.destroy', $test) }}" method="POST" class="inline" onsubmit="return confirm('Delete test?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-400 hover:underline font-bold">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-slate-500 font-semibold">No diagnostic tests listed yet. Click "+ Add Diagnostic Test" above.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
