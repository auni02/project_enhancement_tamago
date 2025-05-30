@extends('layouts.staff')

@section('content')
<div class="max-w-5xl mx-auto px-6 py-8">
    <h2 class="text-3xl font-bold text-blue-800 mb-8 text-center">🗂️ Task Assignment Folder View</h2>

    @php
        $pendingTasks = $tasks->where('status', 'Pending');
        $completedTasks = $tasks->where('status', 'Completed');
    @endphp

    {{-- Accordion Section --}}
    <div class="space-y-6">

        {{-- Pending Folder --}}
        <div class="border border-yellow-300 rounded-xl shadow">
            <button onclick="toggleAccordion('pendingTasksBody')" class="w-full flex justify-between items-center bg-yellow-200 hover:bg-yellow-300 text-yellow-900 font-semibold text-lg px-6 py-4 rounded-t-xl focus:outline-none">
                📁 Pending Tasks ({{ $pendingTasks->count() }})
                <span id="icon-pending">▼</span>
            </button>
            <div id="pendingTasksBody" class="px-6 pb-4 hidden">
                @forelse ($pendingTasks as $task)
                <div class="bg-white border-l-4 border-yellow-500 mt-4 shadow-sm rounded-lg p-4 space-y-2 text-sm text-gray-700">
                    <div class="font-semibold text-blue-700">🛡️ {{ $task->risk->category }}</div>
                    <p><strong>Details:</strong> {{ $task->risk->risk_detail }}</p>
                    <p><strong>Admin's Solution:</strong> {{ $task->solution_details ?? 'Not updated yet' }}</p>
                    <p><strong>Your Solution:</strong> {{ $task->staff_solution ?? 'Not submitted yet' }}</p>

                    <form action="{{ route('staff.tasks.update', $task->id) }}" method="POST" class="space-y-3 mt-3">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block font-medium">Update your solution:</label>
                            <textarea name="staff_solution" class="w-full border rounded-md p-2" rows="3" required>{{ old('staff_solution', $task->staff_solution) }}</textarea>
                        </div>

                        <div>
                            <label class="block font-medium">Update Task Status:</label>
                            <select name="status" class="w-full border rounded-md p-2">
                                <option value="Pending" {{ $task->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Completed" {{ $task->status === 'Completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </div>

                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            💾 Update Task
                        </button>
                    </form>
                </div>
                @empty
                <p class="text-gray-600 mt-4">No pending tasks found.</p>
                @endforelse
            </div>
        </div>

        {{-- Completed Folder --}}
        <div class="border border-green-300 rounded-xl shadow">
            <button onclick="toggleAccordion('completedTasksBody')" class="w-full flex justify-between items-center bg-green-200 hover:bg-green-300 text-green-900 font-semibold text-lg px-6 py-4 rounded-t-xl focus:outline-none">
                ✅ Completed Tasks ({{ $completedTasks->count() }})
                <span id="icon-completed">▼</span>
            </button>
            <div id="completedTasksBody" class="px-6 pb-4 hidden">
                @forelse ($completedTasks as $task)
                <div class="bg-gray-50 border-l-4 border-green-500 mt-4 shadow-sm rounded-lg p-4 space-y-2 text-sm text-gray-700">
                    <div class="font-semibold text-green-800">🛡️ {{ $task->risk->category }}</div>
                    <p><strong>Details:</strong> {{ $task->risk->risk_detail }}</p>
                    <p><strong>Admin's Solution:</strong> {{ $task->solution_details ?? 'Not updated yet' }}</p>
                    <p><strong>Your Submission:</strong> {{ $task->staff_solution ?? 'Not submitted' }}</p>
                </div>
                @empty
                <p class="text-gray-600 mt-4">No completed tasks found.</p>
                @endforelse
            </div>
        </div>

    </div>
</div>

{{-- Accordion JS --}}
<script>
    function toggleAccordion(sectionId) {
        const section = document.getElementById(sectionId);
        const icon = document.getElementById('icon-' + sectionId.replace('TasksBody', ''));

        const isOpen = !section.classList.contains('hidden');
        section.classList.toggle('hidden');

        if (icon) {
            icon.textContent = isOpen ? '▼' : '▲';
        }
    }
</script>
@endsection
