@extends('layouts.super-admin')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10">

    <h1 class="text-4xl font-extrabold text-blue-900 mb-8 border-b-4 border-blue-600 pb-3">
        👥 Pending User Approvals
    </h1>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-md shadow-md">
            {{ session('success') }}
        </div>
    @endif

    {{-- Users Sections --}}
    @foreach([
        ['title' => '⏳ Pending Users', 'users' => $pendingUsers, 'bg' => 'yellow', 'text' => 'yellow-900', 'border' => 'yellow-300'],
        ['title' => '✅ Approved Users', 'users' => $approvedUsers, 'bg' => 'green', 'text' => 'green-900', 'border' => 'green-300'],
        ['title' => '❌ Rejected Users', 'users' => $rejectedUsers, 'bg' => 'red', 'text' => 'red-900', 'border' => 'red-300'],
    ] as $section)
        <section class="mb-12 bg-{{ $section['bg'] }}-50 border border-{{ $section['border'] }} rounded-xl shadow-md p-6">
            <h2 class="text-2xl font-semibold text-{{ $section['text'] }} mb-5 flex items-center">
                {{ $section['title'] }}
            </h2>

            @if($section['users']->isEmpty())
                <p class="text-gray-600 italic">No users found.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                        <thead class="bg-{{ $section['bg'] }}-100 text-{{ $section['text'] }}">
                            <tr>
                                <th class="py-3 px-5 text-left font-medium">👤 Name</th>
                                <th class="py-3 px-5 text-left font-medium">📧 Email</th>
                                <th class="py-3 px-5 text-left font-medium">🏢 Company</th>
                                <th class="py-3 px-5 text-left font-medium">🎓 Role</th>
                                @if($section['title'] === '⏳ Pending Users')
                                    <th class="py-3 px-5 text-center font-medium">⚙️ Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($section['users'] as $user)
                            <tr class="border-t hover:bg-{{ $section['bg'] }}-100 transition duration-150">
                                <td class="py-3 px-5">{{ $user->name }}</td>
                                <td class="py-3 px-5">{{ $user->email }}</td>
                                <td class="py-3 px-5">{{ $user->company->name ?? 'N/A' }}</td>
                                <td class="py-3 px-5">{{ ucfirst($user->role) }}</td>

                                @if($section['title'] === '⏳ Pending Users')
                                    <td class="py-3 px-5 text-center space-x-2">
                                        <form action="{{ route('approve.user', $user->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit"
                                                class="bg-green-600 hover:bg-green-700 text-white font-semibold py-1.5 px-4 rounded-md shadow-md transition duration-150"
                                            >
                                                Approve
                                            </button>
                                        </form>
                                        <form action="{{ route('reject.user', $user->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit"
                                                class="bg-red-600 hover:bg-red-700 text-white font-semibold py-1.5 px-4 rounded-md shadow-md transition duration-150"
                                            >
                                                Reject
                                            </button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>
    @endforeach

</div>
@endsection
