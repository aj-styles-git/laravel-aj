@extends('layouts.master')
@section('title')Form File Upload @endsection
@section('css')
<link href="{{ URL::asset('assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet">
@endsection
@section('content')
{{-- breadcrumbs  --}}
    @section('breadcrumb')
        @component('components.breadcrumb')
            @slot('li_1') Forms @endslot
            @slot('title') Form File Upload @endslot
        @endcomponent
    @endsection
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Dropzone</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div>
                    <form action="#" class="dropzone">
                        <div class="fallback">
                            <input name="file" type="file" multiple="multiple">
                        </div>
                        <div class="dz-message needsclick">
                            <div class="mb-3">
                                <i class="display-4 text-muted uil uil-cloud-upload"></i>
                            </div>

                            <h4>Drop files here or click to upload.</h4>
                        </div>
                    </form>
                    <!-- end form -->
                </div>

                <div class="text-center mt-4">
                    <button type="button" class="btn btn-primary">Send
                        Files</button>
                </div>
            </div>
        </div><!-- end card -->
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection
@section('script')

<!-- Plugins js -->
<script src="{{ URL::asset('assets/libs/dropzone/dropzone.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>

@endsection
