@extends('layouts.master')
@section('title')Boxplot charts @endsection
@section('content')

{{-- breadcrumbs  --}}
    @section('breadcrumb')
        @component('components.breadcrumb')
            @slot('li_1') Charts @endslot
            @slot('title') Boxplot charts @endslot
        @endcomponent
    @endsection

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Basic Box Chart</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="basic_box" data-colors='["--bs-primary", "--bs-info"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->
    </div><!-- end col -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Boxplot with Scatter Chart</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="box_plot" data-colors='["--bs-danger", "--bs-info", "--bs-danger", "--bs-primary"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->
    </div><!-- end col -->
</div><!-- end row -->

@endsection
@section('script')

<!-- apexcharts -->
<script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<!-- boxplotcharts init -->
<script src="{{ URL::asset('assets/js/pages/apexcharts-boxplot.init.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>

@endsection
