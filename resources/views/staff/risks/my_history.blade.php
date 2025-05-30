@extends('layouts.staff')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h2 class="text-4xl font-bold text-gray-900 mb-10 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 3.75L5.25 7.5v9l4.5 3.75h9l4.5-3.75v-9l-4.5-3.75h-9z"/>
        </svg>
        My Reported Risks
    </h2>

    @forelse ($risks as $risk)
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-md transition-all duration-200 mb-6 overflow-hidden">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between p-6 gap-6">
            <!-- Left Icon + Info -->
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0 bg-gradient-to-br from-blue-100 to-blue-200 text-blue-700 rounded-xl p-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 3.75L5.25 7.5v9l4.5 3.75h9l4.5-3.75v-9l-4.5-3.75h-9z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">
                        Risk #{{ $risk->company_risk_id }}
                    </h3>
                    <p class="text-sm text-gray-600 font-medium">
                        {{ $risk->risk_detail }}
                    </p>
                    <p class="text-sm text-gray-500 mt-1">
                        {{ $risk->problem_description }}
                    </p>
                </div>
            </div>

            <!-- Category and Date -->
            <div class="text-right">
                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800 mb-2">
                    {{ $risk->category }}
                </span>
                <p class="text-xs text-gray-400">📅 {{ \Carbon\Carbon::parse($risk->reported_date)->format('d M Y') }}</p>
            </div>
        </div>
    </div>
    @empty
    <div class="text-center py-20">
        <p class="text-gray-400 text-lg">🚫 You haven't reported any risks yet.</p>
    </div>
    @endforelse
</div>
@endsection
