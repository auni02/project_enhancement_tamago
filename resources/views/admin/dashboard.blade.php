@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-lg text-center">

        <h1 class="text-3xl font-bold text-gray-800 mb-4">👋 Welcome, {{ Auth::user()->name }}</h1>
        <p class="text-gray-600 mb-6">You are logged in as <span class="font-medium text-blue-600">Admin</span> of <span class="font-semibold">{{ Auth::user()->company->name ?? 'N/A' }}</span></p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-10">
            <!-- Quick Summary Cards -->
            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded shadow">
                <h2 class="text-lg font-semibold text-blue-700">Reported Risks</h2>
                <p class="text-sm text-gray-600 mt-1">View and evaluate risks reported by staff.</p>
            </div>

            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded shadow">
                <h2 class="text-lg font-semibold text-yellow-700">Tasks Pending</h2>
                <p class="text-sm text-gray-600 mt-1">Assign or review mitigation tasks.</p>
            </div>

            <div class="bg-green-50 border-l-4 border-green-400 p-4 rounded shadow">
                <h2 class="text-lg font-semibold text-green-700">Reports & Insights</h2>
                <p class="text-sm text-gray-600 mt-1">Generate and view overall risk summaries.</p>
            </div>
        </div>

        <div class="mt-10">
            <a href="{{ route('admin.risks.index') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg shadow hover:bg-blue-700 transition">
                Let's get started!
            </a>
        </div>
    </div>
</div>
@endsection
