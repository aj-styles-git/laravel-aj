@extends('layouts.master')
@section('title')Gallery @endsection
@section('css')
<link href="{{ URL::asset('assets/libs/glightbox/glightbox.min.css') }}" rel="stylesheet">
@endsection
@section('content')

{{-- breadcrumbs  --}}
    @section('breadcrumb')
        @component('components.breadcrumb')
            @slot('li_1') Apps @endslot
            @slot('title') Gallery @endslot
        @endcomponent
    @endsection

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center">
                <h4 class="card-title">Gallery Photos</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <ul class="list-inline categories-filter button-group" id="filter">
                                <li class="list-inline-item"><a class="categories active" data-filter="*">All</a></li>
                                <li class="list-inline-item"><a class="categories" data-filter=".project">Project</a></li>
                                <li class="list-inline-item"><a class="categories" data-filter=".designing">Designing</a></li>
                                <li class="list-inline-item"><a class="categories" data-filter=".photography">Photography</a></li>
                                <li class="list-inline-item"><a class="categories" data-filter=".development">Development</a></li>
                            </ul>
                        </div>

                        <div class="row gallery-wrapper">
                            <div class="element-item col-xl-4 col-sm-6 project designing development" data-category="designing development">
                                <div class="gallery-box card">
                                    <div class="gallery-container">
                                        <a class="image-popup" href="{{URL::asset('assets/images/small/img-1.jpg')}}" title="">
                                            <img class="gallery-img img-fluid mx-auto" src="{{URL::asset('assets/images/small/img-1.jpg')}}" alt="" />
                                            <div class="gallery-overlay"></div>
                                        </a>
                                    </div>

                                    <div class="box-content p-3">
                                        <h5 class="title">Morning photoshoot</h5>
                                        <p class="post">by <a href="" class="text-body">Scott Finch</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="element-item col-xl-4 col-sm-6 photography" data-category="photography">
                                <div class="gallery-box card">
                                    <div class="gallery-container">
                                        <a class="image-popup" href="{{URL::asset('assets/images/small/img-4.jpg')}}" title="">
                                            <img class="gallery-img img-fluid mx-auto" src="{{URL::asset('assets/images/small/img-4.jpg')}}" alt="" />
                                            <div class="gallery-overlay"></div>
                                        </a>

                                    </div>

                                    <div class="box-content p-3">
                                        <h5 class="title">Drawing a sketch</h5>
                                        <p class="post">by <a href="" class="text-body">Clarence Smith</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="element-item col-xl-4 col-sm-6 project development" data-category="development">
                                <div class="gallery-box card">
                                    <div class="gallery-container">
                                        <a class="image-popup" href="{{URL::asset('assets/images/small/img-7.jpg')}}" title="">
                                            <img class="gallery-img img-fluid mx-auto" src="{{URL::asset('assets/images/small/img-7.jpg')}}" alt="" />
                                            <div class="gallery-overlay"></div>
                                        </a>

                                    </div>

                                    <div class="box-content p-3">
                                        <h5 class="title">Coffee with Friends</h5>
                                        <p class="post">by <a href="" class="text-body">Delores Williams</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="element-item col-xl-4 col-sm-6 project designing" data-category="project designing">
                                <div class="gallery-box card">
                                    <div class="gallery-container">
                                        <a class="image-popup" href="{{URL::asset('assets/images/small/img-3.jpg')}}" title="">
                                            <img class="gallery-img img-fluid mx-auto" src="{{URL::asset('assets/images/small/img-3.jpg')}}" alt="" />
                                            <div class="gallery-overlay"></div>
                                        </a>

                                    </div>

                                    <div class="box-content p-3">
                                        <h5 class="title">Beautiful Day with Friends</h5>
                                        <p class="post">by <a href="" class="text-body">Keith McCoy</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="element-item col-xl-4 col-sm-6 project designing" data-category="project designing">
                                <div class="gallery-box card">
                                    <div class="gallery-container">
                                        <a class="image-popup" href="{{URL::asset('assets/images/small/img-5.jpg')}}" title="">
                                            <img class="gallery-img img-fluid mx-auto" src="{{URL::asset('assets/images/small/img-5.jpg')}}" alt="" />
                                            <div class="gallery-overlay"></div>
                                        </a>
                                    </div>

                                    <div class="box-content p-3">
                                        <h5 class="title">Lorem ipsum Dummy text</h5>
                                        <p class="post">by <a href="" class="text-body">Silvia Martinez</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="element-item col-xl-4 col-sm-6 photography" data-category="photography">
                                <div class="gallery-box card">
                                    <div class="gallery-container">
                                        <a class="image-popup" href="{{URL::asset('assets/images/small/img-6.jpg')}}" title="">
                                            <img class="gallery-img img-fluid mx-auto" src="{{URL::asset('assets/images/small/img-6.jpg')}}" alt="" />
                                            <div class="gallery-overlay"></div>
                                        </a>

                                    </div>

                                    <div class="box-content p-3">
                                        <h5 class="title">Project discussion with team</h5>
                                        <p class="post">by <a href="" class="text-body">Patsy Waters</a></p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- end row -->
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- ene card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->

@endsection
@section('script')

<script src="{{ URL::asset('assets/libs/glightbox/glightbox.min.js') }}"></script>

<!-- or -->
<script src="{{ URL::asset('assets/libs/isotope-layout/isotope-layout.min.js') }}"></script>

<script src="{{ URL::asset('assets/js/pages/gallery.init.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>


@endsection
