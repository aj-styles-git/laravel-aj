@extends('layouts.master')
@section('title')Polararea charts @endsection
@section('content')
{{-- breadcrumbs  --}}
    @section('breadcrumb')
        @component('components.breadcrumb')
            @slot('li_1') Charts @endslot
            @slot('title') Polararea charts @endslot
        @endcomponent
    @endsection
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Basic-Polar Area Chart</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="basic_polar_area" data-colors='["--bs-primary", "--bs-success", "--bs-warning","--bs-danger", "--bs-info", "--bs-success", "--bs-primary", "--bs-dark", "--bs-secondary"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->
    </div><!-- end col -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Polar-Area Monochrome</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="monochrome_polar_area" data-colors='["--bs-primary"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->
    </div><!-- end col -->
</div><!-- end row -->

@endsection
@section('script')

<!-- apexcharts -->
<script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<!-- polarareacharts init -->
<script src="{{ URL::asset('assets/js/pages/apexcharts-polararea.init.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>

@endsection
