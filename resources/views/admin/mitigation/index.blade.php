@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Risk Mitigation</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($riskMitigations->isEmpty())
        <div class="alert alert-info mt-4">No risk mitigation records found.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Risk Level</th>
                        <th>Existing Control</th>
                        <th>Risk Treatment</th>
                        <th>Solution Details</th>
                        <th>Status</th>
                        <th>Date Assigned</th>
                        <th>Assigned To</th>
                        <th class="text-center">Edit</th>
                        <th class="text-center">Approve</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($riskMitigations as $mitigation)
                        @php
                            $level = (int) $mitigation->risk_level;
                            if ($level < 20) {
                                $label = 'Low';
                                $badgeClass = 'bg-success';
                            } elseif ($level < 50) {
                                $label = 'Medium';
                                $badgeClass = 'bg-warning text-dark';
                            } else {
                                $label = 'High';
                                $badgeClass = 'bg-danger';
                            }

                            $statusClass = match(strtolower($mitigation->status)) {
                                'pending' => 'bg-warning text-dark',
                                'completed' => 'bg-success',
                                'awaiting approval' => 'bg-info text-dark',
                                default => 'bg-secondary'
                            };
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><span class="badge {{ $badgeClass }}">{{ $level }} ({{ $label }})</span></td>
                            <td>{{ $mitigation->existing_control }}</td>
                            <td class="text-capitalize">{{ $mitigation->risk_treatment }}</td>
                            <td>{{ Str::limit($mitigation->staff_solution, 50) }}</td>
                            <td><span class="badge {{ $statusClass }}">{{ $mitigation->status }}</span></td>
                            <td>{{ \Carbon\Carbon::parse($mitigation->date_assigned)->format('d M Y') }}</td>
                            <td>{{ $mitigation->assignedStaff->name ?? 'Not Assigned' }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.risks.mitigation.edit', $mitigation->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                            </td>
                            <td class="text-center">
                                @if (strtolower($mitigation->status) === 'awaiting approval')
                                    <form action="{{ route('admin.tasks.approve', $mitigation->id) }}" method="POST" onsubmit="return confirm('Approve this mitigation?');">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="bi bi-check-lg"></i> Approve
                                        </button>
                                    </form>
                                @else
                                    <span class="text-muted" title="No action available">—</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

{{-- Bootstrap Icons CDN (if not already loaded globally) --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
@endsection
