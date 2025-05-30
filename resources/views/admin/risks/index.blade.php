@extends('layouts.admin')

@section('content')
<div class="container my-5">
    <h2 class="mb-4 text-primary fw-bold">Risks Reported to Your Company</h2>

    {{-- ✅ Review State Filter --}}
    <form method="GET" action="{{ route('admin.risks.index') }}" class="mb-4">
        <div class="row g-2 align-items-center">
            <div class="col-auto">
                <label for="filter" class="form-label fw-semibold">Filter by Review State:</label>
            </div>
            <div class="col-auto">
                <select name="review_state" id="filter" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">All</option>
                    <option value="New" {{ request('review_state') === 'New' ? 'selected' : '' }}>New</option>
                    <option value="Reviewed" {{ request('review_state') === 'Reviewed' ? 'selected' : '' }}>Reviewed</option>
                </select>
            </div>
        </div>
    </form>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @forelse($risks as $risk)
        <div class="card shadow-sm mb-4 border-start border-5
            @if($risk->severity ?? false)
                @switch($risk->severity)
                    @case('Low') border-success @break
                    @case('Medium') border-warning @break
                    @case('High') border-danger @break
                    @default border-secondary
                @endswitch
            @else
                border-secondary
            @endif
        ">
            <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-start">
                <div>
                    <h5 class="card-title mb-1">
                        Risk #{{ $risk->company_risk_id }}
                        <span class="badge
                            @if($risk->severity ?? false)
                                @switch($risk->severity)
                                    @case('Low') bg-success @break
                                    @case('Medium') bg-warning text-dark @break
                                    @case('High') bg-danger @break
                                    @default bg-secondary
                                @endswitch
                            @else
                                bg-secondary
                            @endif
                        ">{{ $risk->severity ?? 'Unknown' }}</span>
                    </h5>

                    {{-- ✅ Review State Badge --}}
                    <p class="mb-1">
                        <strong>Review State:</strong>
                        <span class="badge {{ $risk->review_state === 'Reviewed' ? 'bg-success' : 'bg-secondary' }}">
                            {{ $risk->review_state ?? 'New' }}
                        </span>
                    </p>

                    <p class="mb-1"><strong>Reported by:</strong> {{ $risk->user->name }}</p>
                    <p class="mb-1"><strong>Category:</strong> <span class="text-capitalize">{{ $risk->category }}</span></p>
                    <p class="mb-1 text-truncate" style="max-width: 400px;" title="{{ $risk->risk_detail }}"><strong>Risk Detail:</strong> {{ $risk->risk_detail }}</p>
                    <p class="mb-1 text-truncate" style="max-width: 500px;" title="{{ $risk->problem_description }}"><strong>Problem:</strong> {{ $risk->problem_description }}</p>
                    <small class="text-muted">{{ \Carbon\Carbon::parse($risk->reported_date)->format('d M Y') }}</small>
                </div>
                <div class="mt-3 mt-md-0">
                    <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#riskModal{{ $risk->id }}"
                        title="Open evaluation form to rate this risk" data-bs-toggle="tooltip">
                        <i class="bi bi-pencil-square"></i> Evaluate
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal with progress bars and tooltips -->
        <div class="modal fade" id="riskModal{{ $risk->id }}" tabindex="-1" aria-labelledby="riskModalLabel{{ $risk->id }}" aria-hidden="true">
          <div class="modal-dialog">
            <form action="{{ route('admin.risk.evaluate', $risk->id) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="riskModalLabel{{ $risk->id }}" data-bs-toggle="tooltip" title="Evaluate the risk by scoring severity factors.">
                            Evaluate Risk #{{ $risk->company_risk_id }}
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @php
                            $inputs = [
                                'vulnerability' => 'How exposed the system is to this risk.',
                                'impact' => 'The level of damage or consequences if the risk happens.',
                                'likelihood' => 'The chance or probability that the risk will occur.'
                            ];
                            $colors = ['vulnerability' => 'danger', 'impact' => 'warning', 'likelihood' => 'info'];
                        @endphp

                        @foreach($inputs as $input => $tooltip)
                        <div class="mb-4">
                            <label for="{{ $input }}{{ $risk->id }}" class="form-label fw-semibold text-capitalize">
    <span
        data-bs-toggle="tooltip"
        data-bs-placement="top"
        data-bs-html="true"
        title="<i class='bi bi-info-circle-fill text-primary me-1'></i> {{ $tooltip }}"
    >
        {{ ucfirst($input) }}: <span id="{{ $input }}Value{{ $risk->id }}">3</span> <i class="bi bi-info-circle text-secondary"></i>
    </span>
</label>

                            <input type="range" class="form-range" min="1" max="5" step="1" name="{{ $input }}" id="{{ $input }}{{ $risk->id }}" value="3" required
                                oninput="document.getElementById('{{ $input }}Value{{ $risk->id }}').innerText = this.value; updateProgressBar('{{ $input }}Progress{{ $risk->id }}', this.value)">
                            <div class="progress mt-2" style="height: 10px;">
                                <div id="{{ $input }}Progress{{ $risk->id }}" class="progress-bar bg-{{ $colors[$input] }}" role="progressbar" style="width: 60%;" aria-valuenow="3" aria-valuemin="0" aria-valuemax="5"></div>
                            </div>
                            <div class="invalid-feedback">Please provide a {{ $input }} rating.</div>
                        </div>
                        @endforeach

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success w-100 fw-semibold"
                            data-bs-toggle="tooltip" title="Submit this evaluation to finalize risk scoring.">
                            Submit Evaluation
                        </button>
                    </div>
                </div>
            </form>
          </div>
        </div>
    @empty
        <div class="alert alert-info text-center fst-italic">No risks reported yet.</div>
    @endforelse
</div>

<script>
function updateProgressBar(id, value) {
    const progressBar = document.getElementById(id);
    if (progressBar) {
        const percent = (value / 5) * 100;
        progressBar.style.width = percent + '%';
        progressBar.setAttribute('aria-valuenow', value);
    }
}

// Bootstrap 5 form validation
(() => {
    'use strict'
    const forms = document.querySelectorAll('.needs-validation')
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            form.classList.add('was-validated')
        }, false)
    })
})();

document.addEventListener('DOMContentLoaded', function () {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
        new bootstrap.Tooltip(tooltipTriggerEl, {
            html: true  // ✅ Enable HTML in tooltips
        });
    });
});

</script>
@endsection
