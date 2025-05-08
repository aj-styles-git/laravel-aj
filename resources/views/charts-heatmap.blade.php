@extends('layouts.master')
@section('title')Heatmap charts @endsection
@section('content')

{{-- breadcrumbs  --}}
    @section('breadcrumb')
        @component('components.breadcrumb')
            @slot('li_1') Charts @endslot
            @slot('title') Heatmap charts @endslot
        @endcomponent
    @endsection

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Basic Heatmap Chart</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="basic_heatmap" data-colors='["--bs-success"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->
    </div><!-- end col -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Heatmap - Multiple Series</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="multiple_heatmap" data-colors='["--bs-primary", "--bs-secondary", "--bs-success", "--bs-info", "--bs-warning", "--bs-danger", "--bs-dark", "--bs-primary"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->
    </div><!-- end col -->
</div><!-- end row -->

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Heatmap Color Range</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="color_heatmap" data-colors='["--bs-info", "--bs-success", "--bs-primary", "--bs-warning"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->
    </div><!-- end col -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Heatmap - Range Without Shades</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="shades_heatmap" data-colors='["--bs-info", "--bs-primary"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->
    </div><!-- end col -->
</div><!-- end row -->

@endsection
@section('script')

<!-- apexcharts -->
<script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<!-- heatmapscharts init -->
<script src="{{ URL::asset('assets/js/pages/apexcharts-heatmap.init.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>

@endsection
