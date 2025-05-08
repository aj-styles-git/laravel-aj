@extends('layouts.master')
@section('title')Lightbox @endsection
@section('css')
<link href="{{ URL::asset('assets/libs/glightbox/glightbox.min.css') }}" rel="stylesheet">
@endsection
@section('content')
{{-- breadcrumbs  --}}
    @section('breadcrumb')
        @component('components.breadcrumb')
            @slot('li_1') Extended UI @endslot
            @slot('title') Lightbox @endslot
        @endcomponent
    @endsection
<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Single Image Lightbox</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div>
                            <a href="{{URL::asset('assets/images/small/img-1.jpg')}}" class="thumb preview-thumb image-popup">
                                <img src="{{URL::asset('assets/images/small/img-1.jpg')}}" class="img-fluid" alt="work-thumbnail">
                            </a>
                        </div>
                    </div><!-- end col -->
                    <div class="col-md-6">
                        <div class="mt-4 mt-md-0">
                            <a href="{{URL::asset('assets/images/small/img-2.jpg')}}" class="thumb preview-thumb image-popup">
                                <img src="{{URL::asset('assets/images/small/img-2.jpg')}}" class="img-fluid" alt="work-thumbnail">
                            </a>
                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->

    <div class="col-xl-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Images with Description</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div>
                            <a href="{{URL::asset('assets/images/small/img-4.jpg')}}" class="thumb preview-thumb image-popup-desc" data-title="Project 01" data-description="Lorem ipsum dolor sit amet, consectetuer adipiscing elit">
                                <img src="{{URL::asset('assets/images/small/img-4.jpg')}}" class="img-fluid" alt="work-thumbnail">
                            </a>
                        </div>
                    </div><!-- end col -->

                    <div class="col-lg-3 col-sm-6">
                        <div class="mt-4 mt-md-0">
                            <a href="{{URL::asset('assets/images/small/img-5.jpg')}}" class="thumb preview-thumb image-popup-desc" data-title="Project 02" data-description="Lorem ipsum dolor sit amet, consectetuer adipiscing elit">
                                <img src="{{URL::asset('assets/images/small/img-5.jpg')}}" class="img-fluid" alt="work-thumbnail">
                            </a>
                        </div>
                    </div><!-- end col -->

                    <div class="col-lg-3 col-sm-6">
                        <div class="mt-4 mt-lg-0">
                            <a href="{{URL::asset('assets/images/small/img-1.jpg')}}" class="thumb preview-thumb image-popup-desc" data-title="Project 03" data-description="Lorem ipsum dolor sit amet, consectetuer adipiscing elit">
                                <img src="{{URL::asset('assets/images/small/img-1.jpg')}}" class="img-fluid" alt="work-thumbnail">
                            </a>
                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end card body -->
        </div><!-- end card -->

        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Popup with Video or Map</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="d-flex flex-wrap gap-2">
                    <a href="https://www.youtube.com/watch?v=0O2aH4XLbto" class="btn btn-light image-popup-video-map" data-title="YouTube Video" data-description="YouTube Video Popup">
                        Open YouTube Video
                    </a>

                    <a href="https://vimeo.com/45830194" class="btn btn-light image-popup-video-map" data-title="Vimeo Video" data-description="Vimeo Video Popup">
                        Open Vimeo Video
                    </a>
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->

@endsection
@section('script')

<!-- dragula plugins -->
<script src="{{ URL::asset('assets/libs/glightbox/glightbox.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/lightbox.init.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>

@endsection
