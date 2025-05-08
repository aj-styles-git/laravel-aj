@extends('layouts.master')
@section('title')Line charts @endsection
@section('content')

{{-- breadcrumbs  --}}
    @section('breadcrumb')
        @component('components.breadcrumb')
            @slot('li_1') Charts @endslot
            @slot('title') Line charts @endslot
        @endcomponent
    @endsection

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Basic Line Chart</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="line_chart_basic" data-colors='["--bs-primary"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Zoomable Timeseries</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="line_chart_zoomable" data-colors='["--bs-primary"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->
</div><!-- end row -->

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Line with Data Labels</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="line_chart_datalabel" data-colors='["--bs-primary", "--bs-danger"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Dashed Line</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="line_chart_dashed" data-colors='["--bs-primary", "--bs-danger", "--bs-success"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->
</div><!-- end row -->

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Line with Annotations</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="line_chart_annotations" data-colors='["--bs-primary"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Syncing Charts</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="apex-charts" dir="ltr">
                    <div id="syncingchart-line" data-colors='["--bs-primary"]'></div>
                    <div id="syncingchart-area" data-colors='["--bs-success"]'></div>
                </div>
            </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->
</div><!-- end row -->

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Brush Charts</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div>
                    <div id="brushchart_line2" data-colors='["--bs-danger"]' class="apex-charts" dir="ltr"></div>
                    <div id="brushchart_line" data-colors='["--bs-primary"]' class="apex-charts" dir="ltr"></div>
                </div>
            </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Stepline Charts</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="line_chart_stepline" data-colors='["--bs-primary"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->
</div><!-- end row -->

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Gradient Charts</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="line_chart_gradient" data-colors='["--bs-primary"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Missing Data/ Null Value Charts</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="line_chart_missing_data" data-colors='["--bs-primary", "--bs-danger", "--bs-success"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->
</div><!-- end row -->

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Realtimes Charts</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="line_chart_realtime" data-colors='["--bs-primary"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->
</div><!-- end row -->

@endsection
@section('script')

<!-- apexcharts -->
<script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ URL::asset('https://apexcharts.com/samples/assets/stock-prices.js') }}"></script>
<!-- linecharts init -->
<script src="{{ URL::asset('assets/js/pages/apexcharts-line.init.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>

@endsection
