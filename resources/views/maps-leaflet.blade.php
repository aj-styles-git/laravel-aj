@extends('layouts.master')
@section('title')Leaflet @endsection
@section('css')
<link href="{{ URL::asset('assets/libs/leaflet/leaflet.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
{{-- breadcrumbs  --}}
    @section('breadcrumb')
        @component('components.breadcrumb')
            @slot('li_1') Maps @endslot
            @slot('title') Leaflet @endslot
        @endcomponent
    @endsection
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Example</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="leaflet-map" class="leaflet-map"></div>
            </div>
        </div>
    </div><!-- end col -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Markers, Circles and Polygons</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="leaflet-map-marker" class="leaflet-map"></div>
            </div>
        </div>
    </div><!-- end col -->
</div><!-- end row -->

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Working with Popups</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="leaflet-map-popup" class="leaflet-map"></div>
            </div>
        </div>
    </div><!-- end col -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Markers with Custom Icons</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="leaflet-map-custom-icons" class="leaflet-map"></div>
            </div>
        </div>
    </div><!-- end col -->
</div><!-- end row -->

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Interactive Choropleth Map</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="leaflet-map-interactive-map" class="leaflet-map"></div>
            </div>
        </div>
    </div><!-- end col -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Layer Groups and Layers Control</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="leaflet-map-group-control" class="leaflet-map"></div>
            </div>
        </div>
    </div><!-- end col -->
</div><!-- end row -->

@endsection
@section('script')

<!-- leaflet plugin -->
<script src="{{ URL::asset('assets/libs/leaflet/leaflet.min.js') }}"></script>
<!-- leaflet map.init -->
<script src="{{ URL::asset('assets/js/pages/leaflet-us-states.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/leaflet-map.init.js') }}"></script>

<script src="{{ URL::asset('assets/js/app.js') }}"></script>

@endsection
