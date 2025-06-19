@extends('layouts.app')

@section('content')
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
@endsection
