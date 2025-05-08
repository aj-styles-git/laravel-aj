@extends('layouts.master')
@section('title')Swiper Slider @endsection
@section('css')
<link href="{{ URL::asset('assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
@endsection
@section('content')
{{-- breadcrumbs  --}}
    @section('breadcrumb')
        @component('components.breadcrumb')
            @slot('li_1') Extended UI @endslot
            @slot('title') Swiper Slider @endslot
        @endcomponent
    @endsection
<div class="row">

    <div class="col-xl-6 col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Default Swiper</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="swiper-container default-swiper" dir="ltr">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div>
                                <img src="{{URL::asset('assets/images/small/img-1.jpg')}}" class="img-fluid mx-auto d-block" alt>
                            </div>
                        </div><!-- end swiper-slide -->

                        <div class="swiper-slide">
                            <div>
                                <img src="{{URL::asset('assets/images/small/img-2.jpg')}}" class="img-fluid mx-auto d-block" alt>
                            </div>
                        </div><!-- end swiper-slide -->

                        <div class="swiper-slide">
                            <div>
                                <img src="{{URL::asset('assets/images/small/img-3.jpg')}}" class="img-fluid mx-auto d-block" alt>
                            </div>
                        </div><!-- end swiper-slide -->
                    </div><!-- end swiper wrapper -->
                </div><!-- end swiper container -->
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->

    <div class="col-xl-6 col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Navigation Swiper</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="swiper-container navigation-swiper" dir="ltr">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div>
                                <img src="{{URL::asset('assets/images/small/img-4.jpg')}}" class="img-fluid mx-auto d-block" alt>
                            </div>
                        </div><!-- end swiper-slide -->

                        <div class="swiper-slide">
                            <div>
                                <img src="{{URL::asset('assets/images/small/img-5.jpg')}}" class="img-fluid mx-auto d-block" alt>
                            </div>
                        </div><!-- end swiper-slide -->

                        <div class="swiper-slide">
                            <div>
                                <img src="{{URL::asset('assets/images/small/img-6.jpg')}}" class="img-fluid mx-auto d-block" alt>
                            </div>
                        </div><!-- end swiper-slide -->
                    </div><!-- end swiper wrapper -->
                    <div class="swiper-arrow">
                        <div class="swiper-button-next"><i class="mdi mdi-arrow-right"></i></div>
                        <div class="swiper-button-prev"><i class="mdi mdi-arrow-left"></i></div>
                    </div>
                </div><!-- end swiper container -->
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->

    <div class="col-xl-6 col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Pagination Swiper</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="swiper-container pagination-swiper" dir="ltr">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div>
                                <img src="{{URL::asset('assets/images/small/img-7.jpg')}}" class="img-fluid mx-auto d-block" alt>
                            </div>
                        </div><!-- end swiper-slide -->

                        <div class="swiper-slide">
                            <div>
                                <img src="{{URL::asset('assets/images/small/img-1.jpg')}}" class="img-fluid mx-auto d-block" alt>
                            </div>
                        </div><!-- end swiper-slide -->

                        <div class="swiper-slide">
                            <div>
                                <img src="{{URL::asset('assets/images/small/img-6.jpg')}}" class="img-fluid mx-auto d-block" alt>
                            </div>
                        </div><!-- end swiper-slide -->

                        <div class="swiper-slide">
                            <div>
                                <img src="{{URL::asset('assets/images/small/img-5.jpg')}}" class="img-fluid mx-auto d-block" alt>
                            </div>
                        </div><!-- end swiper-slide -->
                    </div><!-- end swiper wrapper -->
                    <div class="swiper-pagination"></div>
                </div><!-- end swiper container -->
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->

    <div class="col-xl-6 col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Keyboard control</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="swiper-container keyboard-control" dir="ltr">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div>
                                <img src="{{URL::asset('assets/images/small/img-2.jpg')}}" class="img-fluid mx-auto d-block" alt>
                            </div>
                        </div><!-- end swiper-slide -->

                        <div class="swiper-slide">
                            <div>
                                <img src="{{URL::asset('assets/images/small/img-1.jpg')}}" class="img-fluid mx-auto d-block" alt>
                            </div>
                        </div><!-- end swiper-slide -->

                        <div class="swiper-slide">
                            <div>
                                <img src="{{URL::asset('assets/images/small/img-5.jpg')}}" class="img-fluid mx-auto d-block" alt>
                            </div>
                        </div><!-- end swiper-slide -->
                        <div class="swiper-slide">
                            <div>
                                <img src="{{URL::asset('assets/images/small/img-7.jpg')}}" class="img-fluid mx-auto d-block" alt>
                            </div>
                        </div><!-- end swiper-slide -->
                    </div><!-- end swiper wrapper -->
                    <div class="swiper-pagination"></div>
                </div><!-- end swiper container -->
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->

    <div class="col-xl-6 col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Pagination Progress</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="swiper-container progress-swiper" dir="ltr">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div>
                                <img src="{{URL::asset('assets/images/small/img-7.jpg')}}" class="img-fluid mx-auto d-block" alt>
                            </div>
                        </div><!-- end swiper-slide -->

                        <div class="swiper-slide">
                            <div>
                                <img src="{{URL::asset('assets/images/small/img-1.jpg')}}" class="img-fluid mx-auto d-block" alt>
                            </div>
                        </div><!-- end swiper-slide -->

                        <div class="swiper-slide">
                            <div>
                                <img src="{{URL::asset('assets/images/small/img-6.jpg')}}" class="img-fluid mx-auto d-block" alt>
                            </div>
                        </div><!-- end swiper-slide -->

                        <div class="swiper-slide">
                            <div>
                                <img src="{{URL::asset('assets/images/small/img-5.jpg')}}" class="img-fluid mx-auto d-block" alt>
                            </div>
                        </div><!-- end swiper-slide -->
                    </div><!-- end swiper wrapper -->
                    <div class="swiper-arrow">
                        <div class="swiper-button-next"><i class="mdi mdi-arrow-right"></i></div>
                        <div class="swiper-button-prev"><i class="mdi mdi-arrow-left"></i></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div><!-- end swiper container -->
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->

    <div class="col-xl-6 col-lg-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Effect Flip</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="swiper-container effectfade-swiper" dir="ltr">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div>
                                <img src="{{URL::asset('assets/images/small/img-3.jpg')}}" class="img-fluid mx-auto d-block" alt>
                            </div>
                        </div><!-- end swiper-slide -->

                        <div class="swiper-slide">
                            <div>
                                <img src="{{URL::asset('assets/images/small/img-2.jpg')}}" class="img-fluid mx-auto d-block" alt>
                            </div>
                        </div><!-- end swiper-slide -->

                        <div class="swiper-slide">
                            <div>
                                <img src="{{URL::asset('assets/images/small/img-1.jpg')}}" class="img-fluid mx-auto d-block" alt>
                            </div>
                        </div><!-- end swiper-slide -->
                    </div><!-- end swiper wrapper -->
                    <div class="swiper-arrow">
                        <div class="swiper-button-next"><i class="mdi mdi-arrow-right"></i></div>
                        <div class="swiper-button-prev"><i class="mdi mdi-arrow-left"></i></div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div><!-- end swiper container -->
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Responsive Breakpoints</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="swiper-container responsive-swiper" dir="ltr">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div>
                                <img src="{{URL::asset('assets/images/small/img-3.jpg')}}" class="img-fluid mx-auto d-block" alt>
                            </div>
                        </div><!-- end swiper-slide -->

                        <div class="swiper-slide">
                            <div>
                                <img src="{{URL::asset('assets/images/small/img-2.jpg')}}" class="img-fluid mx-auto d-block" alt>
                            </div>
                        </div><!-- end swiper-slide -->

                        <div class="swiper-slide">
                            <div>
                                <img src="{{URL::asset('assets/images/small/img-1.jpg')}}" class="img-fluid mx-auto d-block" alt>
                            </div>
                        </div><!-- end swiper-slide -->

                        <div class="swiper-slide">
                            <div>
                                <img src="{{URL::asset('assets/images/small/img-4.jpg')}}" class="img-fluid mx-auto d-block" alt>
                            </div>
                        </div><!-- end swiper-slide -->

                        <div class="swiper-slide">
                            <div>
                                <img src="{{URL::asset('assets/images/small/img-5.jpg')}}" class="img-fluid mx-auto d-block" alt>
                            </div>
                        </div><!-- end swiper-slide -->
                    </div><!-- end swiper wrapper -->
                    <div class="swiper-arrow">
                        <div class="swiper-button-next"><i class="mdi mdi-arrow-right"></i></div>
                        <div class="swiper-button-prev"><i class="mdi mdi-arrow-left"></i></div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div><!-- end swiper container -->
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->

@endsection
@section('script')

<!-- swiper js -->
<script src="{{ URL::asset('assets/libs/swiper/swiper-bundle.min.js') }}"></script>
<!-- notification init -->
<script src="{{ URL::asset('assets/js/pages/swiper-slider.init.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>

@endsection
