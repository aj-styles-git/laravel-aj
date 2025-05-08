@extends('layouts.master')
@section('title')Radialbar charts @endsection
@section('content')
{{-- breadcrumbs  --}}
    @section('breadcrumb')
        @component('components.breadcrumb')
            @slot('li_1') Charts @endslot
            @slot('title') Radialbar charts @endslot
        @endcomponent
    @endsection
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Basic Radialbar Chart</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="basic_radialbar" data-colors='["--bs-success"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->
    </div><!-- end col -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Multiple Radialbar</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="multiple_radialbar" data-colors='["--bs-primary", "--bs-success", "--bs-warning", "--bs-danger"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->
    </div><!-- end col -->
</div><!-- end row -->

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Circle Chart - Custom Angle</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="circle_radialbar" data-colors='["--bs-primary", "--bs-info", "--bs-danger", "--bs-success"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->
    </div><!-- end col -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Gradient Circle Chart</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="gradient_radialbar" data-colors='["--bs-success"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->
    </div><!-- end col -->
</div><!-- end row -->

<div class="row mb-4">
    <div class="col-lg-6">
        <div class="card h-100 mb-xl-0">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Stroked Circular Gauge</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="stroked_radialbar" data-colors='["--bs-success"]' class="apex-charts" dir="ltr"></div>
            </div><!-- end cardbody -->
        </div>
        <!--end card-->
    </div><!-- end col -->
    <div class="col-lg-6">
        <div class="card h-100 mb-xl-0">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Semi Circular Gauge</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="semi_radialbar" data-colors='["--bs-primary"]' class="apex-charts" dir="ltr"></div>
            </div><!-- end cardbody -->
        </div>
        <!--end card-->
    </div><!-- end col -->
</div><!-- end row -->

@endsection
@section('script')

<!-- apexcharts -->
<script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<!-- radialbar init -->
<script src="{{ URL::asset('assets/js/pages/apexcharts-radialbar.init.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>

@endsection
