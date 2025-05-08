@extends('layouts.master')
@section('title')Mixed charts @endsection
@section('content')
{{-- breadcrumbs  --}}
    @section('breadcrumb')
        @component('components.breadcrumb')
            @slot('li_1') Charts @endslot
            @slot('title') Mixed charts @endslot
        @endcomponent
    @endsection
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Line & Column Charts</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="line_column_chart" data-colors='["--bs-primary", "--bs-success"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->
    </div><!-- end col -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Multiple Y-Axis Charts</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="multi_chart" data-colors='["--bs-primary", "--bs-info", "--bs-success"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->
    </div><!-- end col -->
</div><!-- end row -->

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Line & Area Charts</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="line_area_chart" data-colors='["--bs-primary", "--bs-success"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->
    </div><!-- end col -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Line, Column & Area Charts</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="line_area_charts" data-colors='["--bs-primary", "--bs-success", "--bs-danger"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->
    </div><!-- end col -->
</div><!-- end row -->

@endsection
@section('script')

<!-- apexcharts -->
<script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<!-- mixed init -->
<script src="{{ URL::asset('assets/js/pages/apexcharts-mixed.init.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>

@endsection
