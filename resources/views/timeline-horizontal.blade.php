@extends('layouts.master')
@section('title')Horizontal Timline @endsection
@section('css')
<link href="{{ URL::asset('assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
{{-- breadcrumbs  --}}
    @section('breadcrumb')
        @component('components.breadcrumb')
            @slot('li_1') Timeline @endslot
            @slot('title') Horizontal Timline @endslot
        @endcomponent
    @endsection
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">


                <div class="hori-timeline">
                    <!-- Swiper -->
                    <div class="swiper-container slider">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <h5 class="card-title mb-4">Example</h5>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="swiper-arrow d-flex gap-2 justify-content-end arrow-sm">
                                    <div class="swiper-button-prev position-relative rounded-start"></div>
                                    <div class="swiper-button-next position-relative rounded-end"></div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="event-list">
                                    <p class="font-size-13 text-primary">15 May</p>

                                    <h5 class="font-size-14 mb-1">First Event</h5>
                                    <p class="text-muted">ABC Company</p>

                                    <div>
                                        <p class="text-muted text-truncate">It will be as simple as occidental in fact it will be Cambridge</p>

                                        <div>
                                            <a href="#" class="text-primary">View Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="event-list">
                                    <p class="font-size-13 text-primary">21 May</p>

                                    <h5 class="font-size-14 mb-1">Second Event</h5>
                                    <p class="text-muted">XYZ Company</p>
                                    <div>
                                        <p class="text-muted text-truncate">To an English person, it will seem like simplified English existence.</p>

                                        <div>
                                            <a href="#" class="text-primary">View Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end swiper slide -->
                            <div class="swiper-slide">
                                <div class="event-list">
                                    <p class="font-size-13 text-primary">02 Jun</p>

                                    <h5 class="font-size-14 mb-1">Third Event</h5>
                                    <p class="text-muted">ABC Company</p>
                                    <div>
                                        <p class="text-muted text-truncate">For science, music, sport, etc, Europe uses the same vocabulary.</p>

                                        <div>
                                            <a href="#" class="text-primary">View Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end swiper slide -->
                            <div class="swiper-slide">
                                <div class="event-list">
                                    <p class="font-size-13 text-primary">08 Jun</p>

                                    <h5 class="font-size-14 mb-1">Fourth Event</h5>
                                    <p class="text-muted">XYZ Company</p>
                                    <div>
                                        <p class="text-muted text-truncate">New common language will be more simple than existing.</p>

                                        <div>
                                            <a href="#" class="text-primary">View Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end swiper slide -->
                            <div class="swiper-slide">
                                <div class="event-list">
                                    <p class="font-size-13 text-primary">15 Jun</p>

                                    <h5 class="font-size-14 mb-1">Fifth Event</h5>
                                    <p class="text-muted">XYZ Company</p>
                                    <div>
                                        <p class="text-muted text-truncate">It will be as simple as occidental in fact it will be Cambridge</p>

                                        <div>
                                            <a href="#" class="text-primary">View Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end swiper slide -->
                            <div class="swiper-slide">
                                <div class="event-list">
                                    <p class="font-size-13 text-primary">23 Jun</p>

                                    <h5 class="font-size-14 mb-1">Sixth Event</h5>
                                    <p class="text-muted">XYZ Company</p>
                                    <div>
                                        <p class="text-muted text-truncate">To an English person, it will seem like simplified English existence.</p>

                                        <div>
                                            <a href="#" class="text-primary">View Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end swiper slide -->
                        </div>


                    </div>
                </div>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <div class="hori-timeline timeline-card">
                    <!-- Swiper -->
                    <div class="swiper-container" id="timeline-card-slider">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <h5 class="card-title mb-4">Timeline with Card</h5>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="swiper-arrow d-flex gap-2 justify-content-end arrow-sm">
                                    <div class="swiper-button-prev position-relative rounded-start"></div>
                                    <div class="swiper-button-next position-relative rounded-end"></div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="event-list">
                                    <div class="event-list-item">
                                        <p class="font-size-13 text-primary">15 May</p>

                                        <h5 class="font-size-14 mb-1">First Event</h5>
                                        <p class="text-muted">ABC Company</p>

                                        <div>
                                            <p class="text-muted text-truncate">It will be as simple as occidental in fact it will be Cambridge</p>

                                            <div>
                                                <a href="#" class="text-primary">View Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="event-list">
                                    <div class="event-list-item">
                                        <p class="font-size-13 text-primary">21 May</p>

                                        <h5 class="font-size-14 mb-1">Second Event</h5>
                                        <p class="text-muted">XYZ Company</p>
                                        <div>
                                            <p class="text-muted text-truncate">To an English person, it will seem like simplified English existence.</p>

                                            <div>
                                                <a href="#" class="text-primary">View Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="event-list">
                                    <div class="event-list-item">
                                        <p class="font-size-13 text-primary">02 Jun</p>

                                        <h5 class="font-size-14 mb-1">Third Event</h5>
                                        <p class="text-muted">ABC Company</p>
                                        <div>
                                            <p class="text-muted text-truncate">For science, music, sport, etc, Europe uses the same vocabulary.</p>

                                            <div>
                                                <a href="#" class="text-primary">View Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="event-list">
                                    <div class="event-list-item">
                                        <p class="font-size-13 text-primary">08 Jun</p>

                                        <h5 class="font-size-14 mb-1">Fourth Event</h5>
                                        <p class="text-muted">XYZ Company</p>
                                        <div>
                                            <p class="text-muted text-truncate">New common language will be more simple than existing.</p>

                                            <div>
                                                <a href="#" class="text-primary">View Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="event-list">
                                    <div class="event-list-item">
                                        <p class="font-size-13 text-primary">15 Jun</p>

                                        <h5 class="font-size-14 mb-1">Fifth Event</h5>
                                        <p class="text-muted">XYZ Company</p>
                                        <div>
                                            <p class="text-muted text-truncate">It will be as simple as occidental in fact it will be Cambridge</p>

                                            <div>
                                                <a href="#" class="text-primary">View Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="event-list">
                                    <div class="event-list-item">
                                        <p class="font-size-13 text-primary">23 Jun</p>

                                        <h5 class="font-size-14 mb-1">Sixth Event</h5>
                                        <p class="text-muted">XYZ Company</p>
                                        <div>
                                            <p class="text-muted text-truncate">To an English person, it will seem like simplified English existence.</p>

                                            <div>
                                                <a href="#" class="text-primary">View Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->

@endsection
@section('script')

<!-- swiper js -->
<script src="{{ URL::asset('assets/libs/swiper/swiper-bundle.min.js') }}"></script>
<!-- timeline init -->
<script src="{{ URL::asset('assets/js/pages/timeline.init.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>

@endsection
