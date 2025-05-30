@extends('layouts.super-admin')

@section('content')

<div class="p-8 space-y-16 bg-gradient-to-br from-gray-50 via-white to-gray-100 min-h-screen">

    <!-- Metrics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 max-w-5xl mx-auto">
        <div class="bg-gradient-to-r from-indigo-600 to-blue-700 text-white p-8 rounded-3xl shadow-2xl flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold tracking-wide">Total Users</h2>
                <p class="text-5xl font-extrabold mt-3 drop-shadow-md">{{ $totalUsers }}</p>
            </div>
            <div>
                <svg class="w-14 h-14 opacity-90" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M17 20h5v-2a4 4 0 0 0-3-3.87M9 20h6m-7 0v-2a4 4 0 0 1 3-3.87m7-7.26a4 4 0 1 1-8 0 4 4 0 0 1 8 0z" />
                </svg>
            </div>
        </div>

        <div class="bg-gradient-to-r from-green-600 to-emerald-700 text-white p-8 rounded-3xl shadow-2xl flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold tracking-wide">Total Companies</h2>
                <p class="text-5xl font-extrabold mt-3 drop-shadow-md">{{ $totalCompanies }}</p>
            </div>
            <div>
                <svg class="w-14 h-14 opacity-90" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M4 6h16M4 10h16M10 14h10M4 18h16" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="bg-white rounded-3xl shadow-2xl p-10 max-w-4xl mx-auto">
        <h2 class="text-4xl font-extrabold text-gray-800 mb-8 text-center tracking-tight">User Roles Distribution</h2>
        <canvas id="roleChart" class="mx-auto max-w-md"></canvas>
    </div>

    <!-- Search Input -->
    <div class="max-w-7xl mx-auto px-4">
        <input
            type="text"
            id="userSearch"
            placeholder="Search users by name, email, role, or company..."
            class="w-full max-w-md mb-6 p-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            aria-label="Search users"
        />
    </div>

    <!-- User Table -->
    <div class="bg-white rounded-3xl shadow-xl p-8 max-w-7xl mx-auto">
        <h2 class="text-4xl font-extrabold mb-8 text-gray-900 tracking-wide">User List</h2>
        <div class="overflow-x-auto rounded-lg border border-gray-300">
            <table class="min-w-full text-sm border-collapse" id="usersTable">
                <thead class="bg-gray-100 text-gray-700 uppercase tracking-wide">
                    <tr>
                        <th class="px-6 py-4 text-left">#</th>
                        <th class="px-6 py-4 text-left">Name</th>
                        <th class="px-6 py-4 text-left">Email</th>
                        <th class="px-6 py-4 text-left">Role</th>
                        <th class="px-6 py-4 text-left">Company</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $user)
                    <tr class="border-b border-gray-200 hover:bg-indigo-50 transition duration-200 cursor-pointer">
                        <td class="px-6 py-4 font-medium text-gray-800">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 font-semibold text-gray-900">{{ $user->name }}</td>
                        <td class="px-6 py-4 text-indigo-600 truncate max-w-xs">{{ $user->email }}</td>
                        <td class="px-6 py-4 capitalize text-indigo-700 font-semibold">{{ $user->role }}</td>
                        <td class="px-6 py-4 text-gray-800">{{ $user->company->name ?? 'N/A' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Print Button -->
    <div class="flex justify-center">
        <button
            onclick="window.print()"
            class="bg-gradient-to-r from-indigo-600 to-purple-700 hover:from-indigo-700 hover:to-purple-800 text-white px-8 py-4 rounded-full shadow-xl font-semibold tracking-wide text-lg transform hover:scale-105 transition-transform duration-300 select-none"
            aria-label="Print User Report"
        >
            🖨️ Print User Report
        </button>
    </div>

</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('roleChart').getContext('2d');
    const roleChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($roleLabels) !!},
            datasets: [{
                label: 'Roles',
                data: {!! json_encode($roleCounts) !!},
                backgroundColor: ['#6366F1', '#10B981', '#F59E0B', '#EF4444'],
                borderColor: '#fff',
                borderWidth: 3
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#4B5563', // Tailwind gray-600
                        font: { size: 16, weight: '600' }
                    }
                }
            }
        }
    });
</script>

<!-- Table Search Filter -->
<script>
  document.getElementById('userSearch').addEventListener('input', function() {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('#usersTable tbody tr');

    rows.forEach(row => {
      const text = row.textContent.toLowerCase();
      row.style.display = text.includes(filter) ? '' : 'none';
    });
  });
</script>

@endsection
