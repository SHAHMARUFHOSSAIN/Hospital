@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-extrabold text-white flex items-center gap-2">
                    <i class="fas fa-[#0284C7]"></i> Patient FAQs &amp; Help Desk
                </h1>
                <p class="text-slate-400 text-xs mt-1">Manage interactive patient questions and answers.</p>
            </div>
            <a href="{{ route('admin.faqs.create') }}" class="px-5 py-2.5 bg-[#0284C7] hover:bg-sky-700 text-white font-extrabold text-xs rounded-xl shadow transition">
                + Add FAQ Question
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
                        <th class="px-6 py-3.5 text-left">Question</th>
                        <th class="px-6 py-3.5 text-left">Category</th>
                        <th class="px-6 py-3.5 text-left">Sort Order</th>
                        <th class="px-6 py-3.5 text-left">Status</th>
                        <th class="px-6 py-3.5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800 font-medium">
                    @forelse($faqs as $faq)
                    <tr class="hover:bg-slate-800/40 transition">
                        <td class="px-6 py-4">
                            <p class="text-white font-bold text-sm">{{ $faq->question }}</p>
                            <p class="text-slate-400 text-[11px] truncate max-w-md">{{ $faq->answer }}</p>
                        </td>
                        <td class="px-6 py-4 text-sky-400 font-bold">{{ $faq->category }}</td>
                        <td class="px-6 py-4 text-slate-300 font-bold">{{ $faq->sort_order }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 text-[10px] rounded-full font-bold {{ $faq->is_active ? 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30' : 'bg-slate-800 text-slate-400' }}">
                                {{ $faq->is_active ? 'Active' : 'Hidden' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.faqs.edit', $faq) }}" class="text-sky-400 hover:underline font-bold">Edit</a>
                            <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="inline" onsubmit="return confirm('Delete this FAQ?')">
                                @csrf @method('delete')
                                <button type="submit" class="text-rose-400 hover:underline font-bold">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-slate-500 font-semibold">No FAQs added yet. Click "+ Add FAQ Question" above.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
