@extends('layouts.staff')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">👋 Welcome, {{ Auth::user()->name }}</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Profile Summary -->
        <div class="bg-white rounded-xl shadow p-5 border-l-4 border-blue-400">
            <h2 class="text-lg font-semibold text-blue-700 mb-2">🧑‍💼 Profile Info</h2>
            <p><span class="font-medium">Company:</span> {{ Auth::user()->company->name ?? 'N/A' }}</p>
            <p><span class="font-medium">Role:</span> {{ ucfirst(Auth::user()->role) }}</p>
        </div>

        <!-- Risk Log Section -->
        <div class="bg-white rounded-xl shadow p-5 border-l-4 border-yellow-400">
            <h2 class="text-lg font-semibold text-yellow-700 mb-2">📋 Risk Management</h2>
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('staff.logrisk') }}" class="text-blue-600 hover:underline">
                        ➕ Log a New Risk
                    </a>
                </li>
                <li>
                    <a href="{{ route('staff.risks.my_history') }}" class="text-blue-600 hover:underline">
                        📚 View My Risk Logs
                    </a>
                </li>
            </ul>
        </div>

        <!-- Task Section -->
        <div class="bg-white rounded-xl shadow p-5 border-l-4 border-green-400">
            <h2 class="text-lg font-semibold text-green-700 mb-2">✅ Assigned Tasks</h2>
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('staff.tasks.my_task') }}" class="text-blue-600 hover:underline">
                        🧩 View Assigned Tasks
                    </a>
                </li>
                <li>
                    <a href="{{ route('staff.tasks.my_task') }}#completed" class="text-blue-600 hover:underline">
                        📂 Completed Tasks
                    </a>
                </li>
            </ul>
        </div>

    </div>

    <!-- Optional: Announcement or Alert Section -->
    <div class="mt-8 bg-indigo-50 border-l-4 border-indigo-500 text-indigo-700 p-4 rounded shadow">
        <p class="font-medium">📢 Tip:</p>
        <p class="text-sm">You can always update your task status and solution from the "Assigned Tasks" section. Stay proactive!</p>
    </div>

    {{-- ✨ Chatbox – copy this whole block into your dashboard view --}}
<div class="card shadow-sm mb-4" style="max-height:400px;display:flex;flex-direction:column;">
    <div class="card-header bg-primary text-black p-2 d-flex align-items-center">
        <strong class="flex-grow-1" >Team Chat</strong>
    </div>

    {{-- chat scroll area --}}
    <div id="chat-scroll" class="p-3 flex-grow-1 overflow-auto" style="background:#5e6266;">
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
@endsection
