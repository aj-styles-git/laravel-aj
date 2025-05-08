@extends('layouts.vertical-master-layout')
@section('title')
    {{ __('Profile') }}
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    {{-- breadcrumbs  --}}
@section('breadcrumb')
    @component('components.breadcrumb')
        @slot('li_1')
            {{ __('Student') }}
        @endslot
        @slot('title')
            {{ __('Profile') }}
        @endslot
    @endcomponent
@endsection
<div class="row">
    <div class="col-xl-3">
        <div class="card">
            <div class="card-body p-0">
                <div class="user-profile-img">
                    <img src="{{ URL::asset('assets/images/dawrat_logo.png') }}"
                        class="profile-img profile-foreground-img rounded-top" style="height: 120px;" alt="">
                    <div class="overlay-content rounded-top">
                        <div>
                            <div class="user-nav p-3">
                                <div class="d-flex justify-content-end">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bx bx-dots-horizontal font-size-20 text-white"></i>
                                        </a>

                                        {{-- <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a>
                                            </li>
                                            <li><a class="dropdown-item" href="#">Something else
                                                    here</a></li>
                                        </ul> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end user-profile-img -->

                <div class="mt-n5 position-relative">
                    <div class="text-center">
                        <img src="{{ URL::asset('assets/images/dawrat_logo.png') }}" alt=""
                            class="avatar-xl rounded-circle img-thumbnail">

                        <div class="mt-3">
                            <h5 class="mb-1">{{ $student->name }}</h5>

                        </div>

                    </div>
                </div>

                {{-- <div class="p-3 mt-3">
                    <div class="row text-center">
                        <div class="col-6 border-end">
                            <div class="p-1">
                                <h5 class="mb-1">$<span class="myWalletBal">0 </span></h5>
                                <p class="text-muted mb-0">{{ __('Wallet') }} </p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-1">
                                <h5 class="mb-1">{{ $institute->courses->count() }}</h5>
                                <p class="text-muted mb-0">{{ __('Total Courses') }}</p>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
            <!-- end card body -->
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-2">{{ __('Options') }} </h5>
                <div>
                    <ul class="list-unstyled mb-0 text-muted">

                        <li onclick="loadPageOptionViews(this,'#aboutView')" style="cursor: pointer">
                            <div class="d-flex align-items-center py-2">
                                <div class="flex-grow-1">
                                    <i class="mdi mdi-file-document-multiple font-size-16 text-primary me-1"></i>
                                    {{ __('About') }}
                                </div>

                            </div>
                        </li>
                        <li onclick="loadPageOptionViews(this,'#coursesView')" style="cursor: pointer">
                            <div class="d-flex align-items-center py-2">
                                <div class="flex-grow-1">
                                    <i class="mdi mdi-bookshelf font-size-16 text-info me-1"></i> {{ __('Courses') }}
                                </div>

                            </div>
                        </li>


                    </ul>
                </div>
            </div>
            <!-- end card body -->
        </div>
    </div>
    <div class="col-xl-9" id="maindivloadviews">

        <div class="card view-part " id="aboutView">
            <div class="card-body">
                <div class="mt-3">
                    <h5 class="card-title mb-4">{{ __('About') }}</h5>
                    <p class="text-muted">{{ $student->des }}</p>
                    <div class="col-md-12">
                        <div class="mt-3">

                            <h5 class="font-size-14">{{ __('Other Information') }} : </h5>

                            <ul class="list-unstyled product-desc-list text-muted">

                                <li><i class="mdi mdi-circle-medium me-1 align-middle"></i> {{ __('Mobile') }} :
                                    {{ $student->mobile }}</li>
                                <li><i class="mdi mdi-circle-medium me-1 align-middle"></i> {{ __('Email') }} :
                                    {{ $student->email }}</li>
                                <li><i class="mdi mdi-circle-medium me-1 align-middle"></i> {{ __('Address') }} :
                                    {{ $student->address }}</li>


                            </ul>

                        </div>
                    </div>


                </div>

            </div>
        </div>


        <div class="card view-part  " id="coursesView">
            <div class="card-body">

                <div class="mt-4 pt-3">
                    <h5 class="card-title mb-4">{{ __('Courses') }}</h5>
                    <div id="Table"></div>
                </div>


            </div>
        </div>




    </div>




</div><!-- end row -->



@endsection

@section('script')
<script src="{{ URL::asset('assets/libs/gridjs/gridjs.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.js"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>


<script>
    $('.view-part').hide();
    $('#aboutView').show();

    var apiBase = `{{ url('/') }}`;

    apiBase = apiBase + '/api/';

    var url = window.location.href;
    var parts = url.split("?")[0];
    parts = parts.split('/');
    var student_id = parts[parts.length - 1];

    var coursesURL = `${apiBase}students/${student_id}/courses`;



    // Course table 
    const grid = new gridjs.Grid({
        columns: [{
                name: `{{ __('Name') }}`,
            },
            {
                name: `{{ __('Title') }}`
            },
            {
                name: `{{ __('Status') }}`,
                formatter: (cell, row) => {


                    if (cell == 1) {
                        return gridjs.html(
                            `<span class="badge rounded-pill badge-soft-success" data-key="t-hot">{{ __('Active') }} </span>`
                        )
                    } else if (cell == 0) {
                        return gridjs.html(
                            `<span class="badge rounded-pill badge-soft-danger" data-key="t-hot">{{ __('Blocked') }}  </span>`
                        )


                    } else if (cell == 2) {
                        return gridjs.html(
                            `<span class="badge rounded-pill badge-soft-warning" data-key="t-hot">{{ __('Pending') }}  </span>`
                        )
                    } else if (cell == 3) {
                        return gridjs.html(
                            `<span class="badge rounded-pill badge-soft-danger" data-key="t-hot">{{ __('Rejected') }}  </span>`
                        )
                    } else if (cell == 4) {
                        return gridjs.html(
                            `<span class="badge rounded-pill badge-soft-success" data-key="t-hot">{{ __('Ongoing') }}  </span>`
                        )
                    } else if (cell == 5) {
                        return gridjs.html(
                            `<span class="badge rounded-pill badge-soft-primary" data-key="t-hot">{{ __('Upcoming') }}  </span>`
                        )
                    } else if (cell == 6) {
                        return gridjs.html(
                            `<span class="badge rounded-pill badge-soft-danger" data-key="t-hot">{{ __('Expired') }}  </span>`
                        )
                    }


                }
            }, {
                name: `{{ __('Price') }}`
            },

            {
                name: `{{ __('Action') }}`,
                formatter: (cell, row) => {
                    return gridjs.html(`       <button type="button" onclick="addData(this)"
                            class="btn btn-primary btn-sm btn-rounded">{{ __('Edit') }}   </button>
                            <button type="button" onclick="addData(this)"
                            class="btn btn-danger btn-sm btn-rounded">{{ __('Delete') }}   </button>
                            `)
                }
            }

        ],
        search: true, // Enable search functionality
        pagination: {
            enabled: true, // Enable pagination
            limit: 10, // Set the number of rows per page
        },
        server: {
            url: coursesURL,
            method: 'GET',
            then: (res) => {
                if (res.code == 500) {
                    alert(res.message);
                    return
                }
                var data = res.data

                return data.map(data => [data.name, data.title, data.status, data.price, data
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


    grid.render(document.getElementById('Table'));




    function loadPageOptionViews(e, id) {
        console.log(id)
        $('.view-part').hide();
        console.log($('.view-part'))
        $(id).show();


    }
</script>
@endsection
