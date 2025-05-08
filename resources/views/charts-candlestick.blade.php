@extends('layouts.master')
@section('title')Candlestick charts @endsection
@section('content')

{{-- breadcrumbs  --}}
    @section('breadcrumb')
        @component('components.breadcrumb')
            @slot('li_1') Charts @endslot
            @slot('title') Candlestick chart @endslot
        @endcomponent
    @endsection

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Basic Candlestick Chart</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="basic_candlestick" data-colors='["--bs-success", "--bs-danger"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->
    </div><!-- end col -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Candlestick Synced with Brush Chart (Combo)</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="combo_candlestick" data-colors='["--bs-info", "--bs-danger"]' class="apex-charts" dir="ltr"></div>
                <div id="combo_candlestick_chart" data-colors='["--bs-warning", "--bs-danger"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->
    </div><!-- end col -->
</div><!-- end row -->

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Category X-Axis</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="category_candlestick" data-colors='["--bs-success", "--bs-danger"]' class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->
    </div><!-- end col -->

</div><!-- end row -->

@endsection
@section('script')

<!-- apexcharts -->
<script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ URL::asset('https://apexcharts.com/samples/assets/ohlc.js') }}"></script>
<!-- for Category x-axis chart -->
<script src="{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.8.17/dayjs.min.js') }}"></script>
<!-- candlestick init -->
<script src="{{ URL::asset('assets/js/pages/apexcharts-candlestick.init.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>

@endsection
