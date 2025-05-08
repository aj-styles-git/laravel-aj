@extends('layouts.master')
@section('title')Google maps @endsection
@section('content')
{{-- breadcrumbs  --}}
    @section('breadcrumb')
        @component('components.breadcrumb')
            @slot('li_1') Maps @endslot
            @slot('title') Google maps @endslot
        @endcomponent
    @endsection
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Markers</h4>
                <a href="https://hpneo.dev/gmaps/examples/markers.html" target="_blank" class="btn btn-sm btn-soft-secondary">Docs <i class="mdi mdi-arrow-right align-middle"></i></a>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="gmaps-markers" class="gmaps"></div>
            </div>
        </div><!-- end card -->
    </div><!-- end col -->

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Overlays</h4>
                <a href="https://hpneo.dev/gmaps/examples/overlays.html" target="_blank" class="btn btn-sm btn-soft-secondary">Docs <i class="mdi mdi-arrow-right align-middle"></i></a>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="gmaps-overlay" class="gmaps"></div>
            </div>
        </div><!-- end card -->
    </div> <!-- end col -->
</div> <!-- end row -->


<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Street View Panoramas</h4>
                <a href="https://hpneo.dev/gmaps/examples/streetview.html" target="_blank" class="btn btn-sm btn-soft-secondary">Docs <i class="mdi mdi-arrow-right align-middle"></i></a>
            </div><!-- end card header -->
            <div class="card-body">

                <div id="panorama" class="gmaps-panaroma"></div>
            </div><!-- end card body-->
        </div><!-- end card -->
    </div> <!-- end col -->

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Map Types</h4>
                <a href="https://hpneo.dev/gmaps/examples/map_types.html" target="_blank" class="btn btn-sm btn-soft-secondary">Docs <i class="mdi mdi-arrow-right align-middle"></i></a>
            </div><!-- end card header -->
            <div class="card-body">

                <div id="gmaps-types" class="gmaps"></div>
            </div><!-- end card body-->
        </div><!-- end card -->
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection
@section('script')

<!-- google maps api -->
<script src="{{ URL::asset('https://maps.google.com/maps/api/js?key=AIzaSyCtSAR45TFgZjOs4nBFFZnII-6mMHLfSYI') }}"></script>
<!-- Gmaps file -->
<script src="{{ URL::asset('assets/libs/gmaps/gmaps.min.js') }}"></script>
<!-- gmaps init -->
<script src="{{ URL::asset('assets/js/pages/gmaps.init.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>

@endsection
