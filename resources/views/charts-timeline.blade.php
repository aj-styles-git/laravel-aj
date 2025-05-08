@extends('layouts.master')
@section('title')Timeline charts @endsection
@section('content')
{{-- breadcrumbs  --}}
    @section('breadcrumb')
        @component('components.breadcrumb')
            @slot('li_1') Charts @endslot
            @slot('title') Timeline charts @endslot
        @endcomponent
    @endsection
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Basic TimeLine Charts</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="basic_timeline" data-colors='["--bs-primary"]' class="apex-charts" dir="ltr"></div>
            </div><!-- end cardbody -->
        </div>
        <!--end card-->
    </div><!-- end col -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Different Color For Each Bar</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="color_timeline" data-colors='["--bs-primary", "--bs-danger", "--bs-success", "--bs-warning", "--bs-info"]' class="apex-charts" dir="ltr"></div>
            </div><!-- end cardbody -->
        </div>
        <!--end card-->
    </div><!-- end col -->
</div><!-- end row -->

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Multi Series Timeline</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="multi_series" data-colors='["--bs-primary","--bs-success"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->
    </div><!-- end col -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Advanced Timeline (Multiple Range)</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="advanced_timeline" data-colors='["--bs-primary", "--bs-success", "--bs-warning"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->
    </div><!-- end col -->
</div><!-- end row -->

@endsection
@section('script')

<!-- apexcharts -->
<script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/moment/moment.min.js') }}"></script>

<!-- timeline init -->
<script src="{{ URL::asset('assets/js/pages/apexcharts-timeline.init.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>

@endsection
