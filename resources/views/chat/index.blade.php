@extends('layouts.admin') {{-- or layouts.app if you use same layout --}}

@section('content')
<div class="container my-4">
    <h3>Chat</h3>

    {{-- Chat messages --}}
    <div class="border rounded p-3 mb-4" style="height: 300px; overflow-y: auto;">
        @forelse ($messages as $msg)
            <div class="mb-2">
                <strong>{{ $msg->from_user_id == auth()->id() ? 'You' : $msg->sender->name }}:</strong>
                {{ $msg->message }}
                <br>
                <small class="text-muted">{{ $msg->created_at->diffForHumans() }}</small>
            </div>
        @empty
            <p>No messages yet.</p>
        @endforelse
    </div>

    {{-- Send message --}}
    <form method="POST" action="{{ route('chat.send') }}">
        @csrf
        <div class="mb-3">
            <label for="to_user_id">Send to:</label>
            <select name="to_user_id" class="form-select">
                @foreach(App\Models\User::where('id', '!=', auth()->id())->get() as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->role }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="message">Message:</label>
            <textarea name="message" class="form-control" rows="3" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Send</button>
    </form>
</div>
@endsection
