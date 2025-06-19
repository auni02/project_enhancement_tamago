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

    <div class="container">
    <h4>Chat with Admin</h4>

    <form method="POST" action="{{ route('chat.send') }}">
        @csrf
        <input type="hidden" name="to_user_id" value="1"> {{-- Admin user ID --}}
        <div class="mb-3">
            <textarea name="message" class="form-control" placeholder="Type your message..."></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send</button>
    </form>

    <hr>

    <div class="chat-box" style="height: 300px; overflow-y: scroll;">
        @foreach($messages as $msg)
            <div class="mb-2">
                <strong>{{ $msg->sender->name }}:</strong> {{ $msg->message }}
                <br><small class="text-muted">{{ $msg->created_at->diffForHumans() }}</small>
            </div>
        @endforeach
    </div>
</div>
</div>
@endsection
