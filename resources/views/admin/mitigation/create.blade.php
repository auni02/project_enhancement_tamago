@extends('layouts.admin')

@section('content')
<div class="container my-5" style="max-width: 720px;">
    <div class="card shadow-sm rounded-4 p-4 bg-white border border-success-subtle">
        <h2 class="mb-4 text-gradient d-flex align-items-center" style="background: linear-gradient(90deg, #000000, #00ff00); -webkit-background-clip: text; color: transparent; font-weight: 900;">
            🛡️ Create Risk Mitigation
        </h2>

        <form action="{{ route('admin.risks.mitigation.store', $risk->id) }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="risk_level" class="form-label fw-semibold text-secondary">Risk Level</label>
                <input type="text" name="risk_level" id="risk_level{{ $risk->id }}"
                       value="{{ session('calculated_level') }}"
                       readonly
                       class="form-control border-success border-2 shadow-sm">
            </div>

            <div class="mb-4">
                <label for="existing_control" class="form-label fw-semibold text-secondary">Existing Control</label>
                <textarea name="existing_control" rows="3"
                          class="form-control border-success border-2 shadow-sm"
                          placeholder="Describe any current controls..."></textarea>
            </div>

            <div class="mb-4">
                <label for="risk_treatment" class="form-label fw-semibold text-secondary">Risk Treatment</label>
                <select name="risk_treatment"
                        class="form-select border-success border-2 shadow-sm">
                    <option value="avoidance">Avoidance</option>
                    <option value="mitigation">Mitigation</option>
                    <option value="transfer">Transfer</option>
                    <option value="acceptance">Acceptance</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="solution_details" class="form-label fw-semibold text-secondary">Solution Details</label>
                <textarea name="solution_details" rows="3"
                          class="form-control border-success border-2 shadow-sm"
                          placeholder="Explain your solution proposal..."></textarea>
            </div>

            <div class="mb-4">
                <label for="assigned_to" class="form-label fw-semibold text-secondary">Assign to Staff</label>
                <select name="assigned_to" required
                        class="form-select border-success border-2 shadow-sm">
                    @foreach ($staffs as $staff)
                        <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="status" class="form-label fw-semibold text-secondary">Status</label>
                <select name="status"
                        class="form-select border-success border-2 shadow-sm">
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>

            <div class="mb-5">
                <label for="date_assigned" class="form-label fw-semibold text-secondary">Date Assigned</label>
                <input type="date" name="date_assigned"
                       class="form-control border-success border-2 shadow-sm">
            </div>

            <div class="text-end">
                <button type="submit"
                        class="btn btn-success px-5 py-2 fw-semibold rounded-pill shadow-sm">
                    💾 Save Mitigation
                </button>
            </div>
        </form>

        <!-- JavaScript logic retained as-is -->
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            const vuln = document.getElementById('vulnerability{{ $risk->id }}');
            const impact = document.getElementById('impact{{ $risk->id }}');
            const likelihood = document.getElementById('likelihood{{ $risk->id }}');
            const riskLevel = document.getElementById('risk_level{{ $risk->id }}');

            function updateRiskLevel() {
                const v = parseInt(vuln?.value || 0);
                const i = parseInt(impact?.value || 0);
                const l = parseInt(likelihood?.value || 0);

                riskLevel.value = v && i && l ? v * i * l : '';
            }

            vuln?.addEventListener('input', updateRiskLevel);
            impact?.addEventListener('input', updateRiskLevel);
            likelihood?.addEventListener('input', updateRiskLevel);
        });
        </script>
    </div>
</div>

<style>
    .text-gradient {
        background: linear-gradient(90deg, #000000, #00ff00);
        -webkit-background-clip: text;
        color: transparent;
        font-weight: 900;
    }

    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 0 0.2rem rgba(0, 255, 0, 0.25);
        border-color: #00c853 !important;
    }

    .btn-success {
        background: linear-gradient(90deg, #000000, #00ff00);
        border: none;
    }

    .btn-success:hover {
        background: linear-gradient(90deg, #00ff00, #000000);
    }
</style>
@endsection
