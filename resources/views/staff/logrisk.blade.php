@extends('layouts.staff')

@section('content')
<div class="max-w-2xl mx-auto mt-12 bg-gradient-to-br from-blue-50 to-yellow-50 shadow-lg rounded-2xl p-8 border border-blue-200">
    <h2 class="text-3xl font-extrabold text-center text-blue-800 mb-6">🚨 Log a New Risk</h2>

    <form method="POST" action="{{ route('staff.logrisk.store') }}" class="space-y-6">
        @csrf

        {{-- Category --}}
        <div>
            <label for="category" class="block text-lg font-medium text-gray-800 mb-2">📂 Category</label>
            <select name="category" id="category" class="w-full rounded-xl border border-gray-300 p-3 bg-white shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-300">
                <option value="">-- Choose One --</option>
                <option value="organizational">Organizational</option>
                <option value="people">People</option>
                <option value="physical">Physical</option>
                <option value="technological">Technological</option>
            </select>
        </div>

        {{-- Risk Detail --}}
        <div>
            <label for="risk_detail" class="block text-lg font-medium text-gray-800 mb-2">📌 Risk Detail</label>
            <input type="text" name="risk_detail" id="risk_detail" class="w-full rounded-xl border border-gray-300 p-3 bg-white shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-300" required>
        </div>

        {{-- Problem Description --}}
        <div>
            <label for="problem_description" class="block text-lg font-medium text-gray-800 mb-2">📝 Problem Description</label>
            <textarea name="problem_description" id="problem_description" rows="4" class="w-full rounded-xl border border-gray-300 p-3 bg-white shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-300" required></textarea>
        </div>

        {{-- Date --}}
        <div>
            <label for="reported_date" class="block text-lg font-medium text-gray-800 mb-2">📅 Reported Date</label>
            <input type="date" name="reported_date" id="reported_date" class="w-full rounded-xl border border-gray-300 p-3 bg-white shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-300" required>
        </div>

        {{-- Button --}}
        <div class="text-center">
            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-yellow-400 to-blue-500 text-white font-bold rounded-full shadow-lg hover:scale-105 transform transition">
                Submit Risk
            </button>
        </div>
    </form>
</div>
@endsection
