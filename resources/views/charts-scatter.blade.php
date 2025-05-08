@extends('layouts.master')
@section('title')Scatter charts @endsection
@section('content')
{{-- breadcrumbs  --}}
    @section('breadcrumb')
        @component('components.breadcrumb')
            @slot('li_1') Charts @endslot
            @slot('title') Scatter charts @endslot
        @endcomponent
    @endsection
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Basic Scatter Chart</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="basic_scatter" data-colors='["--bs-primary", "--bs-success", "--bs-warning"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->
    </div><!-- end col -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Scatter - Datetime Chart</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="datetime_scatter" data-colors='["--bs-primary", "--bs-success", "--bs-warning", "--bs-warning", "--bs-info"]' class="apex-charts" dir="ltr"></div>
            </div><!-- end cardbody -->
        </div>
        <!--end card-->
    </div><!-- end col -->
</div><!-- end row -->

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Scatter Images Chart</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="images_scatter" data-colors='["--bs-primary", "--bs-danger"]' class="apex-charts" dir="ltr"></div>
            </div><!-- end cardbody -->
        </div>
        <!--end card-->
    </div><!-- end col -->
</div><!-- end row -->

@endsection
@section('script')

<!-- apexcharts -->
<script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<!-- scatter init -->
<script src="{{ URL::asset('assets/js/pages/apexcharts-scatter.init.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>

@endsection
