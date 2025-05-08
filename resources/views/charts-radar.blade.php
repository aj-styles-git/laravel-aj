@extends('layouts.master')
@section('title')Radar charts @endsection
@section('content')
{{-- breadcrumbs  --}}
    @section('breadcrumb')
        @component('components.breadcrumb')
            @slot('li_1') Charts @endslot
            @slot('title') Radar charts @endslot
        @endcomponent
    @endsection
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Basic Radar Chart</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="basic_radar" data-colors='["--bs-info"]' class="apex-charts" dir="ltr"></div>
            </div>
            <!-- end cardbody -->
        </div>
        <!--end card-->
    </div><!-- end col -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Radar Chart - Multiple series</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="multi_radar" data-colors='["--bs-danger", "--bs-success", "--bs-primary"]' class="apex-charts" dir="ltr"></div>
            </div><!-- end cardbody -->
        </div>
        <!--end card-->
    </div><!-- end col -->
</div><!-- end row -->

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Radar Chart - Polygon Fill</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="polygon_radar" data-colors='["--bs-info"]' class="apex-charts" dir="ltr"></div>
            </div><!-- end cardbody -->
        </div>
        <!--end card-->
    </div><!-- end col -->
</div><!-- end row -->

@endsection
@section('script')

<!-- apexcharts -->
<script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<!-- radarcharts init -->
<script src="{{ URL::asset('assets/js/pages/apexcharts-radar.init.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>

@endsection
