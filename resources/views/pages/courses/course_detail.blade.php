@extends('layouts.vertical-master-layout')
@section('title')
    {{ __('Courses') }}
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    {{-- breadcrumbs  --}}
@section('breadcrumb')
    @component('components.breadcrumb')
        @slot('li_1')
            {{ __('Courses') }}
        @endslot
        @slot('title')
            {{ __('All Courses') }}
        @endslot
    @endcomponent
@endsection

@section('pagecontentinfo')
    {{-- <div class="col">
    <div class="mt-md-0 py-3 px-4 mx-2">
        <p class="text-white-50 mb-2 text-truncate">Total Courses </p>
        <h3 class="text-white mb-0"> {{  $courses->count() }}</h3>
    </div>
</div>

<div class="col">
    <div class="mt-md-0 py-3 px-4 mx-2">
        <p class="text-white-50 mb-2 text-truncate">  Enrolled Students</p>
        <h3 class="text-white mb-0">{{ $courses->sum('students_count') }}</h3>
    </div>
</div>


<div class="col">
    <div class="mt-md-0 py-3 px-4 mx-2">
        <p class="text-white-50 mb-2 text-truncate">  Published </p>
        <h3 class="text-white mb-0">{{ $courses->where('is_published',1)->count() }}</h3>
    </div>
</div> --}}
@endsection



<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                {{-- <h1>{{ $course_count }}</h1> --}}
                <div class="row">

                    {{-- Means two courses are available  --}}
                    {{-- @if ($course_count>1)
                    <div class="col-md-10"></div>
                    <div class="col-md-2">
                        <div class="col-md-2 float-right ">

                            <form action="{{ route('change_page_language') }}" method="POST">
                                @csrf
                                <select name="page_lang" onchange="this.form.submit()">
                                    <option value="en" {{ session('page_lang') === 'en' ? 'selected' : '' }}>English
                                    </option>
                                    <option value="ar" {{ session('page_lang') === 'ar' ? 'selected' : '' }}>Arabic
                                    </option>
                                    <!-- Add more language options as needed -->
                                </select>
                            </form>

                        </div>
                    </div>
                    @endif --}}
                   
                    <div class="col-xl-4">
                        <div class="product-detail">
                            {{-- <div class="product-wishlist">
                                <a href="#">
                                    <i class="mdi mdi-heart-outline"></i>
                                </a>
                            </div> --}}


                            <div class="mt-4">
                                <div class="swiper product-nav-slider mt-2 overflow-hidden">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide rounded">
                                            <div class="nav-slide-item"><img
                                                    src="{{ asset('storage/' . $course->thumbnail) }}"
                                                    style="height: 100%; width:100%" alt=""
                                                    class="img-fluid d-block" /></div>
                                        </div>

                                    </div>

                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="mt-4 mt-xl-3 ps-xl-4">
                            <h5 class="font-size-14">
                                <p class="text-muted">{{ $course->institute->name ?? ' No Institute Name Available' }}
                                </p>
                            </h5>

                            <div class="text-muted">
                                <span class="badge bg-success font-size-14 me-1"><i class="mdi mdi-star"></i> {{ number_format($course->institute->ratings->avg('rating'),1) ?? 0 }}</span>
                                {{ $course->institute->ratings->count() }} Reviews
                            </div>

                            <h5 class="mt-2">
                                <a class="text-dark lh-base">{{ $course->title ?? ' No Title' }}</a>
                            </h5>


                            {{-- <h5 class="font-size-20 mt-4 pt-2">${{ $course->price ?? "0" }} <span class="text-danger font-size-14 ms-2">- 20 % Off</span></h5> --}}
                            {{-- <del class="text-muted me-2">$280</del> --}}
                            {{-- <p class="mt-4 text-muted">If several languages coalesce, the grammar of the resulting language is more simple and regular</p> --}}

                            <div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mt-3">

                                            <h5 class="font-size-14">{{ __('Description') }} : </h5>
                                            <p class="mt-4 text-muted"> {{ $course->des }}</p>

                                            <ul class="list-unstyled product-desc-list text-muted">



                                                <li><i class="mdi mdi-circle-medium me-1 align-middle"></i>
                                                    {{ __('Start Date') }} :
                                                    {{ $course->start_date }}</li>
                                                <li><i class="mdi mdi-circle-medium me-1 align-middle"></i>
                                                    {{ __('End Date') }} :
                                                    {{ $course->end_date }}</li>
                                                <li><i class="mdi mdi-circle-medium me-1 align-middle"></i>
                                                    {{ __('Featured') }} :
                                                    {{ $course->is_feature ? 'Yes' : 'No' }}</li>
                                                
                                                @if ($course->seats)
                                                    <li><i class="mdi mdi-circle-medium me-1 align-middle"></i>
                                                        {{ __('Seats') }} :
                                                        {{ $course->seats }}</li>
                                                    <li><i class="mdi mdi-circle-medium me-1 align-middle"></i>
                                                        {{ __('Filled') }} :
                                                        {{ $course->filled_seats }}</li>
                                                @endif
                                            </ul>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mt-3">
                                            <h5 class="font-size-14">{{ __('Course Type') }} :</h5>
                                            <ul class="list-unstyled product-desc-list text-muted">
                                                <li><i class="bx bx-log-in-circle text-primary me-1"></i>
                                                    {{ $course->course_type ? 'Online ' : 'Offline' }}</li>


                                            </ul>
                                        </div>
                                        <div class="mt-3">
                                            <h5 class="font-size-14">{{ __('Duration') }} :</h5>
                                            <ul class="list-unstyled product-desc-list text-muted">
                                                <li><i class="bx bx-log-in-circle text-primary me-1"></i>
                                                    {{ $course->duration }}</li>
                                            </ul>
                                        </div>
                                        <div class="mt-3">
                                            <h5 class="font-size-14">{{ __('Timing') }} :</h5>
                                            <ul class="list-unstyled product-desc-list text-muted">
                                                <li><i class="bx bx-log-in-circle text-primary me-1"></i>
                                                    {{ $course->timing }}</li>
                                            </ul>
                                        </div>
                                        {{-- <div class="mt-3">
                                            <h5 class="font-size-14">{{ __('Language') }} :</h5>
                                            <ul class="list-unstyled product-desc-list text-muted">
                                                <li><i class="bx bx-log-in-circle text-primary me-1"></i>
                                                    {{ __('English') }} </li>
                                                <li><i class="bx bx-log-in-circle text-primary me-1"></i>
                                                    {{ __('Arabic') }} </li>
                                            </ul>
                                        </div> --}}
                                    </div>
                                </div>

                                {{-- <div class="mt-3">

                                    <h5 class="font-size-14 mb-3"><i class="bx bx-map-pin font-size-20 text-primary align-middle me-2"></i> Delivery location</h5>

                                    <div class="d-inline-flex">

                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Enter Delivery pincode ">

                                            <button class="btn btn-light" type="button">Check</button>

                                        </div>
                                    </div>

                                </div> --}}

                                {{-- <div class="row">
                                    <div class="col-lg-7 col-sm-8">
                                        <div class="product-desc-color mt-3">
                                            <h5 class="font-size-14">Colors :</h5>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <a href="#" class="active" data-bs-toggle="tooltip" data-bs-placement="top" title="Gray">
                                                        <div class="product-color-item">
                                                            <img src="{{URL::asset('assets/images/product/img-1.png')}}" alt="" class="avatar-md">
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Dark">
                                                        <div class="product-color-item">
                                                            <img src="{{URL::asset('assets/images/product/img-2.png')}}" alt="" class="avatar-md">
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Purple">
                                                        <div class="product-color-item">
                                                            <img src="{{URL::asset('assets/images/product/img-3.png')}}" alt="" class="avatar-md">
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#" class="text-primary border-0 p-1" data-bs-toggle="modal" data-bs-target="#color-img">
                                                        2 + Colors
                                                    </a>
                                                </li>
                                            </ul>

                                        </div>
                                    </div>

                                    <div class="col-lg-5 col-sm-4">
                                        <div class="mt-3">
                                            <h5 class="font-size-14 mb-3">Select Sizes :</h5>

                                            <div class="d-inline-flex">
                                                <select class="form-select w-sm">
                                                    <option value="1">3</option>
                                                    <option value="2">4</option>
                                                    <option value="3">5</option>
                                                    <option value="4">6</option>
                                                    <option value="5" selected>7</option>
                                                    <option value="6">8</option>
                                                    <option value="7">9</option>
                                                    <option value="8">10</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                {{-- Students SS  Row  --}}
                <div class="row">
                    <div class="mt-4 pt-3">
                        <h5 class="card-title mb-4">{{ __('Students') }}</h5>
                        <div id="StudentsTable"></div>
                    </div>
                </div>
                {{-- Coupons CC Row  --}}
                <div class="row">
                    <div class="mt-4 pt-3">
                        <h5 class="card-title mb-4">{{ __('Coupons') }}</h5>
                        <div id="couponsTable"></div>
                    </div>
                </div>



            </div>
        </div>
    </div>
</div>
<!-- end row -->

<!-- sample modal content -->
<div id="color-img" class="modal fade" tabindex="-1" aria-labelledby="color-imgLabel" aria-hidden="true"
    data-bs-scroll="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="color-imgLabel">Product Images</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="product-desc-color">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="#" class="active" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="" data-bs-original-title="Gray">
                                <div class="product-color-item">
                                    <img src="{{ URL::asset('assets/images/product/img-1.png') }}" alt=""
                                        class="avatar-md">
                                </div>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                data-bs-original-title="Dark">
                                <div class="product-color-item">
                                    <img src="{{ URL::asset('assets/images/product/img-2.png') }}" alt=""
                                        class="avatar-md">
                                </div>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                data-bs-original-title="Purple">
                                <div class="product-color-item">
                                    <img src="{{ URL::asset('assets/images/product/img-3.png') }}" alt=""
                                        class="avatar-md">
                                </div>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                data-bs-original-title="Sky">
                                <div class="product-color-item">
                                    <img src="{{ URL::asset('assets/images/product/img-4.png') }}" alt=""
                                        class="avatar-md">
                                </div>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                data-bs-original-title="Green">
                                <div class="product-color-item">
                                    <img src="{{ URL::asset('assets/images/product/img-5.png') }}" alt=""
                                        class="avatar-md">
                                </div>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                data-bs-original-title="White">
                                <div class="product-color-item">
                                    <img src="{{ URL::asset('assets/images/product/img-6.png') }}" alt=""
                                        class="avatar-md">
                                </div>
                            </a>
                        </li>

                    </ul>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



@endsection
@section('script')
<!-- gridjs js -->
<script src="{{ URL::asset('assets/libs/gridjs/gridjs.min.js') }}"></script>
{{-- <script src="{{ URL::asset('assets/js/pages/gridjs.init.js') }}"></script> --}}
<script src="{{ URL::asset('assets/js/app.js') }}"></script>
<script src="{{ URL::asset('assets/libs/gridjs/gridjs.min.js') }}"></script>

<script>
    var apiBase = `{{ url('/') }}`;
    apiBase = apiBase + '/api/';
    var url = window.location.href;
    var parts = url.split("/");
    var course_id = parts[parts.length - 1];


    if (course_id.includes('?')) {
        var course_id = course_id.split('?')[0];
    }

    var couponsURL = `${apiBase}courses/${course_id}/coupons`;
    var studentsURL = `${apiBase}courses/${course_id}/students`;




    const coupongrid = new gridjs.Grid({
        columns: [

            {

                name: "ID",
                hidden: true
            }, {
                name: `{{ __('Name') }}`,
            },
            {
                name: `{{ __('Type') }}`,
                formatter: (cell, row) => {
                    if (cell) {
                        return gridjs.html(
                            `<span class=" text-bold " >{{ __('Flat Discount') }}</span>`
                        )
                    } else {
                        return gridjs.html(
                            `<span class=" text-bold" >{{ __('Percentage') }}  </span>`
                        )


                    }
                }
            },

            {
                name: `{{ __('Amount') }}`,
            },

            {
                name: `{{ __('Start Date') }}`,
            },
            {
                name: `{{ __('End Date') }}`,
            },


            {
                name: `{{ __('Action') }}`,
                formatter: (cell, row) => {
                    return gridjs.html(`       <button type="button" onclick="addData(this)"
                            class="btn btn-primary btn-sm btn-rounded">{{ __('Edit') }}  </button>
                            <button type="button" 
                            class="btn btn-danger btn-sm btn-rounded"  onclick='deleteRecord(this, ${row['_cells'][0]['data']})' > {{ __('Delete') }}    </button>
                            `)
                }
            }
        ],
        search: true, // Enable search functionality
        sort: true,
        pagination: {
            enabled: true, // Enable pagination
            limit: 10, // Set the number of rows per page
        },
        server: {
            url: couponsURL,
            method: 'GET',
            then: (res) => {
                //  res = JSON.parse(res);
                var data = res['data'];
                console.log(data)
                return data.map(inst => [inst.id, inst.code, inst.coupon_type, inst.amount,
                    inst.start_date, inst.end_date, inst.id,
                ]);
            },
            handle: (res) => {
                if (res.status === 404) return {
                    data: []
                };
                if (res.ok) return res.json();
                throw Error('Oh no :(');
            },


        }
    });

    coupongrid.render(document.getElementById('couponsTable'));


    // Student Grid 
    const studentgrid = new gridjs.Grid({
        columns: [

            {

                name: "ID",
                hidden: true
            }, {
                name: 'Name',
            },
            {
                name: 'Email',
            },
            {
                name: 'Mobile',
            },
            {
                name: 'Address',
            }


        ],
        search: true,
        sort: true,
        resizable: true,
        pagination: {
            enabled: true, // Enable pagination
            limit: 10, // Set the number of rows per page
        },
        server: {
            url: studentsURL,
            method: 'GET',
            then: (res) => {
                var data = res['data'];
                console.log(data)


                return data.map(inst => [inst.id, inst.name, inst.email, inst.mobile, inst.address, inst
                    .id
                ]);
            },
            handle: (res) => {
                console.log(res)
                if (res.status === 404) return {
                    data: []
                };
                if (res.ok) return res.json();
                throw Error('Oh no :(');
            }


        }
    });

    studentgrid.render(document.getElementById('StudentsTable'));
</script>
@endsection
