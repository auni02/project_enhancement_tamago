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

        {{-- ✨ Chatbox – copy this whole block into your dashboard view --}}
<div class="card shadow-sm mb-4" style="max-height:400px;display:flex;flex-direction:column;">
    <div class="card-header bg-primary text-white p-2 d-flex align-items-center">
        <strong class="flex-grow-1">Team Chat</strong>
    </div>

    {{-- chat scroll area --}}
    <div id="chat-scroll" class="p-3 flex-grow-1 overflow-auto" style="background:#f8fafc;">
        @foreach($messages as $msg)
            @php
                $isMe = $msg->from_user_id === auth()->id();
            @endphp
            <div class="d-flex mb-2 {{ $isMe ? 'justify-content-end' : 'justify-content-start' }}">
                <div class="px-3 py-2 rounded-3
                    {{ $isMe ? 'bg-success text-white' : 'bg-light border' }}"
                     style="max-width:70%;">
                    <small class="fw-bold">{{ $msg->sender->name }}</small><br>
                    {{ $msg->message }}
                    <div class="text-muted small text-end">{{ $msg->created_at->diffForHumans() }}</div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- send form --}}
    <form action="{{ route('chat.send') }}" method="POST" class="d-flex border-top">
        @csrf
        <input type="hidden" name="to_user_id" value="{{ $targetId ?? 1 }}"> {{-- default admin id --}}
        <input name="message" class="form-control border-0" placeholder="Type a message…" required>
        <button class="btn btn-primary rounded-0 px-4" type="submit">Send</button>
    </form>
</div>

{{-- auto-scroll to newest --}}
@push('scripts')
<script>
    const chatBox = document.getElementById('chat-scroll');
    if (chatBox) chatBox.scrollTop = chatBox.scrollHeight;
</script>
@endpush

    </div>
</div>
@endsection
