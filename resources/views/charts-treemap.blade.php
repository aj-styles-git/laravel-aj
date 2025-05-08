@extends('layouts.master')
@section('title')Treemap charts @endsection
@section('content')
{{-- breadcrumbs  --}}
    @section('breadcrumb')
        @component('components.breadcrumb')
            @slot('li_1') Charts @endslot
            @slot('title') Treemap charts @endslot
        @endcomponent
    @endsection
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Basic Treemap Chart</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="basic_treemap" data-colors='["--bs-success"]' class="apex-charts" dir="ltr"></div>
            </div><!-- end cardbody -->
        </div>
        <!--end card-->
    </div><!-- end col -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Multi-Dimensional Treemap Chart</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="multi_treemap" data-colors='["--bs-primary","--bs-success"]' class="apex-charts" dir="ltr"></div>
            </div><!-- end cardbody -->
        </div>
        <!--end card-->
    </div><!-- end col -->
</div><!-- end row -->

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Distributed Treemap Chart (Different Color for each Cell)</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="distributed_treemap" data-colors='["--bs-primary", "--bs-secondary", "--bs-success", "--bs-info","--bs-warning", "--bs-danger"]' class="apex-charts" dir="ltr"></div>
            </div><!-- end cardbody -->
        </div>
        <!--end card-->
    </div><!-- end col -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Treemap Chart with Color Ranges</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="color_range_treemap" data-colors='["--bs-info","--bs-danger"]' class="apex-charts" dir="ltr"></div>
            </div><!-- end cardbody -->
        </div>
        <!--end card-->
    </div><!-- end col -->
</div><!-- end row -->

@endsection
@section('script')

<!-- apexcharts -->
<script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<!-- timeline init -->
<script src="{{ URL::asset('assets/js/pages/apexcharts-treemap.init.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>

@endsection
