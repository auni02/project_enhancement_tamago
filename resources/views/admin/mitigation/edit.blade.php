@extends('layouts.admin')

@section('content')
<div class="container my-5" style="max-width: 720px;">
    <div class="card shadow-sm rounded-4 p-4" style="background: #f8fafc;">
        <!-- Title with black-green gradient and icon -->
        <h2 class="mb-4 text-gradient d-flex align-items-center" style="background: linear-gradient(90deg, #000000, #00ff00); -webkit-background-clip: text; color: transparent; font-weight: 900;">
            <svg xmlns="http://www.w3.org/2000/svg" style="width:32px; height:32px; margin-right:8px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 20a8 8 0 100-16 8 8 0 000 16z" />
            </svg>
            Edit Risk Mitigation
        </h2>

        <form action="{{ route('admin.risks.mitigation.update', $mitigation->id) }}" method="POST" novalidate>
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="existing_control" class="form-label fw-semibold text-secondary">Existing Control</label>
                <textarea name="existing_control" id="existing_control" rows="4" class="form-control border-2 border-success shadow-sm" placeholder="Describe the existing controls...">{{ old('existing_control', $mitigation->existing_control) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="risk_treatment" class="form-label fw-semibold text-secondary">Risk Treatment</label>
                <select name="risk_treatment" id="risk_treatment" class="form-select border-2 border-success shadow-sm" required>
                    <option value="" disabled>Select Risk Treatment</option>
                    @foreach(['avoidance', 'mitigation', 'transfer', 'acceptance'] as $option)
                        <option value="{{ $option }}" @selected(old('risk_treatment', $mitigation->risk_treatment) === $option)>{{ ucfirst($option) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="solution_details" class="form-label fw-semibold text-secondary">Solution Details</label>
                <textarea name="solution_details" id="solution_details" rows="5" class="form-control border-2 border-success shadow-sm" placeholder="Explain the solution details...">{{ old('solution_details', $mitigation->solution_details) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="assigned_to" class="form-label fw-semibold text-secondary">Assign To</label>
                <select name="assigned_to" id="assigned_to" class="form-select border-2 border-success shadow-sm">
                    <option value="">-- Select Staff --</option>
                    @foreach ($staffs as $staff)
                        <option value="{{ $staff->id }}" @selected(old('assigned_to', $mitigation->assigned_to) == $staff->id)>{{ $staff->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="status" class="form-label fw-semibold text-secondary">Status</label>
                <select name="status" id="status" class="form-select border-2 border-success shadow-sm">
                    <option value="Pending" @selected(old('status', $mitigation->status) == 'Pending')>Pending</option>
                    <option value="Completed" @selected(old('status', $mitigation->status) == 'Completed')>Completed</option>
                </select>
            </div>

            <div class="mb-5">
                <label for="date_assigned" class="form-label fw-semibold text-secondary">Date Assigned</label>
                <input type="date" name="date_assigned" id="date_assigned" class="form-control border-2 border-success shadow-sm" value="{{ old('date_assigned', $mitigation->date_assigned) }}">
            </div>

            <div class="d-flex justify-content-end gap-3">
                <button type="submit" class="btn btn-primary px-5 py-2 fw-semibold shadow-sm rounded-3">
                    Update
                </button>
                <a href="{{ route('admin.risks.mitigation') }}" class="btn btn-outline-secondary px-5 py-2 fw-semibold rounded-3 shadow-sm">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<style>
    /* Black-green gradient and styling */
    .text-gradient {
        background: linear-gradient(90deg, #000000, #00ff00);
        -webkit-background-clip: text;
        color: transparent;
        font-weight: 900;
    }

    .btn-primary {
        background: linear-gradient(90deg, #000000, #00ff00);
        border: none;
        transition: background 0.3s ease;
    }

    .btn-primary:hover {
        background: linear-gradient(90deg, #00ff00, #000000);
    }

    .form-control:focus,
    .form-select:focus {
        box-shadow: 0 0 8px rgba(0, 255, 0, 0.5);
        border-color: #00ff00 !important;
        outline: none;
    }
</style>
@endsection
