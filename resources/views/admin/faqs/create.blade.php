@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-3xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-extrabold text-white">Add Patient FAQ Question</h1>
            <a href="{{ route('admin.faqs.index') }}" class="text-xs font-bold text-slate-400 hover:text-white">&larr; Back to FAQs</a>
        </div>

        <form action="{{ route('admin.faqs.store') }}" method="POST" class="bg-slate-900 p-8 rounded-2xl border border-slate-800 space-y-6">
            @csrf

            <div>
                <label class="block text-xs font-bold uppercase text-slate-400 mb-1">FAQ Question *</label>
                <input type="text" name="question" required placeholder="What are the OPD consultation timings?" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Category *</label>
                <select name="category" required class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                    <option value="OPD & Appointments">OPD &amp; Appointments</option>
                    <option value="Cabins & Admission">Cabins &amp; Admission</option>
                    <option value="Emergency & ICU">Emergency &amp; ICU</option>
                    <option value="Diagnostics & Reports">Diagnostics &amp; Reports</option>
                    <option value="General Inquiry">General Inquiry</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Answer / Response *</label>
                <textarea name="answer" rows="4" required placeholder="Detailed answer for patients..." class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7] resize-none"></textarea>
            </div>

            <div class="flex items-center gap-6 pt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" checked class="rounded">
                    <span class="text-xs text-slate-300 font-bold">Active in FAQ Accordion</span>
                </label>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Sort Order</label>
                    <input type="number" name="sort_order" value="0" class="w-24 px-3 py-1.5 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold">
                </div>
            </div>

            <button type="submit" class="w-full py-3.5 bg-[#0284C7] hover:bg-sky-700 text-white font-extrabold text-xs uppercase rounded-xl shadow transition">Save FAQ Question</button>
        </form>
    </div>
</div>
@endsection
