@extends('layouts.vertical-master-layout')

@section('title', __('Document'))

@section('content')
<div class="mt-4">
    @if ($institute->document)
        <h5 class="mb-2">{{ __('Current Document:') }}</h5>

        @php
            $extension = pathinfo($institute->document, PATHINFO_EXTENSION);
            $fileUrl = asset('storage/' . $institute->document);
        @endphp

        @if (in_array($extension, ['jpg', 'jpeg', 'png']))
            <div style="max-width: 1000px;">
                <img src="{{ $fileUrl }}" alt="Document Image" class="img-fluid rounded shadow-sm mb-2" style="width:100%;">
                <a href="{{ $fileUrl }}" target="_blank" class="btn btn-sm btn-primary">{{ __('View Full Image') }}</a>
            </div>

        @elseif ($extension === 'pdf')
            <div style="max-width: 1000px; border: 1px solid #ccc; border-radius: 6px; overflow: hidden;">
                <iframe src="{{ $fileUrl }}#toolbar=0&navpanes=0&scrollbar=0"
                        width="100%"
                        height="500"
                        style="border: none;">
                </iframe>
            </div>
            <a href="{{ $fileUrl }}" target="_blank" class="btn btn-sm btn-danger mt-2">{{ __('Open Full PDF') }}</a>

        @else
            <p class="text-warning">{{ __('Unsupported file format.') }}</p>
        @endif
    @else
        <p class="text-muted">{{ __('No document uploaded yet.') }}</p>
    @endif
</div>
<!-- Status Display -->
<div class="mt-4 p-3 rounded bg-light shadow-sm d-flex align-items-center">
    <h5 class="me-3 mb-0">{{ __('Status:') }}</h5>
    <div class="d-flex align-items-center">
        <span class="fs-5 me-2">
            @if($institute->approved == 1)
                <span class="text-success">{{ __("Approved") }}</span>
                <i class="bi bi-check-circle-fill text-success" style="font-size: 1.2rem;"></i> <!-- Icon for Approved -->
            @else
                <span class="text-danger">{{ __("Rejected") }}</span>
                <i class="bi bi-x-circle-fill text-danger" style="font-size: 1.2rem;"></i> <!-- Icon for Rejected -->
            @endif
        </span>
    </div>
</div>


<!-- Approve and Reject Buttons -->
<div class="mt-4">
    <button type="button" class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#actionModal">
        {{ __('Approve') }}
    </button>
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#actionModal">
        {{ __('Reject') }}
    </button>
</div>

<!-- Action Confirmation Modal -->
<div class="modal fade" id="actionModal" tabindex="-1" aria-labelledby="actionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="actionModalLabel">{{ __('Confirm Action') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
            </div>
            <div class="modal-body text-center">
                <p>{{ __('Are you sure you want to proceed?') }}</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                <button type="button" class="btn btn-danger" onclick="window.handleAction('0')">{{ __('Reject') }}</button>
                <button type="button" class="btn btn-success" onclick="window.handleAction('1')">{{ __('Approve') }}</button>
            </div>
        </div>
    </div>
</div>


<script>
    window.handleAction = function(action) {
        const windowUrl = window.location.href.split('?')[0];
        const parts = windowUrl.split('/');
        const inst_id = parts[parts.length - 2];

        const formData = new FormData();
        const apiBase = `{{ url('/') }}/api/`;
        const updateURL = `${apiBase}institutes/${inst_id}`;

        const page_lang = `{{ session('page_lang') }}`;
        formData.append('lang', page_lang);
        formData.append('adminRequest', 1);
        formData.append('approved', action); // 1 for approved, 0 for rejected
        formData.append('_method', 'PUT');

        $.ajax({
            url: updateURL,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(res) {
                if (res.code === 200) {
                    alert(res.message);
                    window.location.href = `{{ route('all_institutes', ['lang' => app()->getLocale()]) }}`;
                } else {
                    alert(res.message || 'Something went wrong.');
                }
            },
            error: function(xhr) {
                alert('Something went wrong.');
            }
        });

        const modalEl = document.getElementById('actionModal');
        const modalInstance = bootstrap.Modal.getInstance(modalEl);
        modalInstance.hide();
    };
</script>
@endsection
