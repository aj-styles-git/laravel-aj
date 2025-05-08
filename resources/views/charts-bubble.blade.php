@extends('layouts.master')
@section('title')Bubble charts @endsection
@section('content')

{{-- breadcrumbs  --}}
    @section('breadcrumb')
        @component('components.breadcrumb')
            @slot('li_1') Charts @endslot
            @slot('title') Bubble charts @endslot
        @endcomponent
    @endsection

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Simple Bubble Chart</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="simple_bubble" data-colors='["--bs-primary", "--bs-info", "--bs-warning", "--bs-success"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->
    </div><!-- end col -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">3D Bubble Chart</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="bubble_chart" data-colors='["--bs-primary", "--bs-success", "--bs-warning", "--bs-danger"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->
    </div><!-- end col -->
</div><!-- end row -->

@endsection
@section('script')

<!-- apexcharts -->
<script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<!-- bubblecharts init -->
<script src="{{ URL::asset('assets/js/pages/apexcharts-bubble.init.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>

@endsection
