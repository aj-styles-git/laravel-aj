@extends('layouts.master')
@section('title')Font Awesome @endsection
@section('content')
{{-- breadcrumbs  --}}
    @section('breadcrumb')
        @component('components.breadcrumb')
            @slot('li_1') Icons @endslot
            @slot('title') Font Awesome @endslot
        @endcomponent
    @endsection
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Solid</h4>
                <a href="https://fontawesome.com/v5.15/icons?d=gallery&p=2&s=solid&m=free" target="_blank" class="btn btn-sm btn-soft-secondary">Docs <i class="mdi mdi-arrow-right align-middle"></i></a>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="row icon-demo-content" id="solid">
                </div>
            </div> <!-- end card-body -->
        </div> <!-- end card -->
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Regular</h4>
                <a href="https://fontawesome.com/v5.15/icons?d=gallery&p=2&s=regular&m=free" target="_blank" class="btn btn-sm btn-soft-secondary">Docs <i class="mdi mdi-arrow-right align-middle"></i></a>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="row icon-demo-content" id="regular">
                </div>
            </div> <!-- end card-body -->
        </div> <!-- end card -->
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Brands</h4>
                <a href="https://fontawesome.com/v5.15/icons?d=gallery&p=3&s=brands" target="_blank" class="btn btn-sm btn-soft-secondary">Docs <i class="mdi mdi-arrow-right align-middle"></i></a>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="row icon-demo-content" id="brand">
                </div>
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection
@section('script')

<!-- fontawesome icons init -->
<script src="{{ URL::asset('assets/js/pages/fontawesome.init.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>

@endsection
