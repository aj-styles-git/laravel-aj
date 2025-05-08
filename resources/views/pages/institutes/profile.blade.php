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
            {{ __('Institutes') }}
        @endslot
        @slot('title')
            {{ __('Profile') }}
        @endslot
    @endcomponent
@endsection
<div class="row">
    {{-- Means two courses are available  --}}
    @if ($languageCount > 1)
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
    @endif

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

                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a>
                                            </li>
                                            <li><a class="dropdown-item" href="#">Something else
                                                    here</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end user-profile-img -->

                <div class="mt-n5 position-relative">
                    <div class="text-center">
                        <img src="{{ asset('storage/' . $institute->logo) }}" alt=""
                            class="avatar-xl rounded-circle img-thumbnail">

                        <div class="mt-3">
                            @if (session('page_lang') === 'en')
                                <h5 class="mb-1">{{ $institute->name_en }}</h5>
                            @elseif (session('page_lang') === 'ar')
                                <h5 class="mb-1">{{ $institute->name_ar }}</h5>
                            @else
                                <h5 class="mb-1">{{ $institute->name }}</h5>
                            @endif


                        </div>

                    </div>
                </div>

                <div class="p-3 mt-3">
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
                </div>


            </div>
            <!-- end card body -->
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-2">{{ __('Options') }} </h5>
                <div>
                    <ul class="list-unstyled mb-0 text-muted">
                        {{-- <li onclick="loadPageOptionViews(this,'#studentsView')" style="cursor: pointer">
                            <div class="d-flex align-items-center py-2">
                                <div class="flex-grow-1">
                                    <i class="mdi mdi-github font-size-16 text-dark me-1"></i> Students
                                </div>

                            </div>
                        </li> --}}
                        <li onclick="loadPageOptionViews(this,'#coursesView')" style="cursor: pointer">
                            <div class="d-flex align-items-center py-2">
                                <div class="flex-grow-1">
                                    <i class="mdi mdi-bookshelf font-size-16 text-info me-1"></i> {{ __('Courses') }}
                                </div>

                            </div>
                        </li>
                        <li onclick="loadPageOptionViews(this,'#couponsView')" style="cursor: pointer">
                            <div class="d-flex align-items-center py-2">
                                <div class="flex-grow-1">
                                    <i class="mdi mdi-file-document-multiple font-size-16 text-primary me-1"></i>
                                    {{ __('Coupons') }}
                                </div>

                            </div>
                        </li>
                        <li onclick="loadPageOptionViews(this,'#walletView')" style="cursor: pointer">
                            <div class="d-flex align-items-center pt-2 pb-1">
                                <div class="flex-grow-1">
                                    <i
                                        class="mdi mdi-currency-usd  font-size-16  text-success  me-1"></i>{{ __('Statement') }}
                                </div>

                            </div>
                        </li>
                        <li onclick="loadPageOptionViews(this,'#withdrawRequests')" style="cursor: pointer">
                            <div class="d-flex align-items-center pt-2 pb-1">
                                <div class="flex-grow-1">
                                    <i
                                        class="mdi mdi-message-flash font-size-16 text-warning me-1"></i>{{ __('Withdraw Requests') }}
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
        <div class="card view-part" id="coursesView">
            <div class="card-body">
                <h5 class="card-title mb-3">{{ __('About') }}</h5>
                <div class="mt-3">
                    {{-- <p class="font-size-15 mb-1">{{ $institute->name  }}</p> --}}

                    <p class="text-muted">{{ $institute->des }}</p>

                </div>
                <div class="mt-4 pt-3">
                    <h5 class="card-title mb-4">{{ __('Courses') }}</h5>
                    <div id="Table"></div>
                </div>


            </div>
        </div>
        <div class="card view-part" id="studentsView" style="display: none ">
            <div class="card-body">
                <h5 class="card-title mb-3">{{ __('Students') }} </h5>
                <div class="mt-3">
                    {{-- <p class="font-size-15 mb-1">{{ $institute->name  }}</p> --}}

                    <p class="text-muted">{{ $institute->des }}</p>

                </div>
                <div class="mt-4 pt-3">
                    <h5 class="card-title mb-4">{{ __('All Students') }} </h5>
                    <div id="StudentsTable"></div>
                </div>


            </div>
        </div>
        <div class="card view-part" id="couponsView" style="display: none ">
            <div class="card-body">
                {{-- <h5 class="card-title mb-3">{{ __('Coupons') }} </h5> --}}

                <div class="mt-4 pt-3">
                    <h5 class="card-title mb-4">{{ __('All Coupons') }} </h5>
                    <div id="couponsTable"></div>
                </div>


            </div>
        </div>

        <div class="card view-part" id="walletView" style="display: none ">

            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0"><i class="mdi mdi-emoticon-wink-outline me-1"></i>
                            {{ __('Statement') }}
                        </h4>
                        <div class="d-flex flex-wrap gap-2 align-items-center">
                            {{-- <button type="button" class="btn btn-primary btn-sm">Withdraw Blance  </button> --}}
                        </div>
                    </div>
                    <div class="card-body">


                        <h6>{{ __('History') }} </h6>
                        <div class="row">

                            <div class="col-lg-12">

                                <div id="StatementTable"></div>

                            </div>
                        </div>


                    </div>

                </div>
            </div>

        </div>


        <div class="card view-part" id="withdrawRequests" style="display: none ">

            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header d-flex flex-wrap gap-2 justify-content-between ">
                        <h4 class="card-title mb-0"><i class="mdi mdi-emoticon-wink-outline me-1"></i>
                            {{ __('Withdraw Requests') }}
                        </h4>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target=".bs-example-modal-center">Request </button>
                    </div>
                    <div class="card-body">

                        <div class="row">

                            <div class="col-lg-12">
                                <div id="withdrawRequestsTable"></div>

                            </div>
                        </div>


                    </div>

                </div>
            </div>

        </div>

    </div>

    {{-- Ratings   --}}

    <div class="row">
        <div class="col-xl-8">
            <div class="mt-4 pt-3">
                <h5 class="font-size-14 mb-3">Reviews : </h5>
                <div class="text-muted mb-3">
                    <span class="badge bg-success font-size-14 me-1"><i class="mdi mdi-star"></i>
                        <span id="average_rating"> 0 </span> </span><span id="total_rating">0 </span> Reviews
                </div>
                <div class="border py-4 rounded">

                    <div class="px-4" data-simplebar style="max-height: 260px;" id="ratingDiv">

                        {{-- <div class="border-bottom pb-3">
                            <p class="float-sm-end text-muted font-size-13">12 July, 2021</p>
                            <div class="badge bg-success mb-2"><i class="mdi mdi-star"></i> 4.1</div>
                            <p class="text-muted mb-4">It will be as simple as in fact, it will be Occidental. It will
                                seem like simplified</p>
                            <div class="d-flex align-items-start">
                                <div class="flex-grow-1">
                                    <h5 class="font-size-15 mb-0">Samuel</h5>
                                </div>

                                <div class="flex-shrink-0">
                                    <ul class="list-inline product-review-link mb-0">
                                        <li class="list-inline-item">
                                            <a href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="" data-bs-original-title="Like"><i
                                                    class="bx bx-like"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="" data-bs-original-title="Comment"><i
                                                    class="bx bx-comment-dots"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>

                        <div class="border-bottom py-3">
                            <p class="float-sm-end text-muted font-size-13">06 July, 2021</p>
                            <div class="badge bg-success mb-2"><i class="mdi mdi-star"></i> 4.0</div>
                            <p class="text-muted mb-4">Sed ut perspiciatis unde omnis iste natus error sit</p>
                            <div class="d-flex align-items-start">
                                <div class="flex-grow-1">
                                    <h5 class="font-size-15 mb-0">Joseph</h5>
                                </div>

                                <div class="flex-shrink-0">
                                    <ul class="list-inline product-review-link mb-0">
                                        <li class="list-inline-item">
                                            <a href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="" data-bs-original-title="Like"><i
                                                    class="bx bx-like"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="" data-bs-original-title="Comment"><i
                                                    class="bx bx-comment-dots"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="border-bottom py-3">
                            <p class="float-sm-end text-muted font-size-13">26 June, 2021</p>
                            <div class="badge bg-success mb-2"><i class="mdi mdi-star"></i> 4.2</div>
                            <p class="text-muted mb-4">Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet
                            </p>
                            <div class="d-flex align-items-start">
                                <div class="flex-grow-1">
                                    <h5 class="font-size-15 mb-0">Paul</h5>
                                </div>

                                <div class="flex-shrink-0">
                                    <ul class="list-inline product-review-link mb-0">
                                        <li class="list-inline-item">
                                            <a href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="" data-bs-original-title="Like"><i
                                                    class="bx bx-like"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="" data-bs-original-title="Comment"><i
                                                    class="bx bx-comment-dots"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div> --}}

                    </div>

                    {{-- <div class="px-4">
                        <div class="border rounded mt-4">
                            <form action="#">
                                <div class="px-2 py-1 bg-light">
                                    <div class="btn-group" role="group">
                                        <button type="button"
                                            class="btn btn-sm btn-link text-dark text-decoration-none"><i
                                                class="bx bx-link"></i></button>
                                        <button type="button"
                                            class="btn btn-sm btn-link text-dark text-decoration-none"><i
                                                class="bx bx-smile"></i></button>
                                        <button type="button"
                                            class="btn btn-sm btn-link text-dark text-decoration-none"><i
                                                class="bx bx-at"></i></button>
                                    </div>
                                </div>
                                <textarea rows="2" class="form-control border-0 resize-none" placeholder="Your Message..."></textarea>
                            </form>
                        </div>

                        <div class="text-end mt-3">
                            <button type="button" class="btn btn-success w-sm text-truncate ms-2"> Send <i
                                    class="bx bx-send ms-2 align-middle"></i></button>
                        </div>
                    </div> --}}

                </div>

            </div>

        </div>

        {{-- <div class="col-xl-4">
            <div class="mt-4 pt-3">
                <h5 class="font-size-14 mb-3">Product description: </h5>
                <div class="product-desc">
                    <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="desc-tab" data-bs-toggle="tab" href="#desc"
                                role="tab">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" id="specifi-tab" data-bs-toggle="tab" href="#specifi"
                                role="tab">Specifications</a>
                        </li>
                    </ul>
                    <div class="tab-content border border-top-0 p-4">
                        <div class="tab-pane fade" id="desc" role="tabpanel">
                            <div class="row">
                                <div class="col-md-3">
                                    <div>
                                        <img src="{{ URL::asset('assets/images/product/img-6.png') }}" alt=""
                                            class="img-fluid mx-auto d-block">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="text-muted">
                                        <p>If several languages coalesce, the grammar of the resulting language is more
                                            simple and regular</p>
                                        <p>It will be as simple as occidental in fact.</p>

                                        <div>
                                            <ul class="list-unstyled product-desc-list text-muted mb-0">
                                                <li><i class="mdi mdi-circle-medium me-1 align-middle"></i> Sed ut
                                                    perspiciatis omnis iste</li>
                                                <li><i class="mdi mdi-circle-medium me-1 align-middle"></i> Neque porro
                                                    quisquam est</li>
                                                <li><i class="mdi mdi-circle-medium me-1 align-middle"></i> Quis autem
                                                    vel eum iure</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show active" id="specifi" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-nowrap mb-0">
                                    <tbody>
                                        <tr>
                                            <th scope="row" style="width: 50%;"><b>Category :</b></th>
                                            <td>Shoes</td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><b>Brand :</b></th>
                                            <td>Nike</td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><b>Color :</b></th>
                                            <td>Gray</td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><b>Quality :</b></th>
                                            <td>High</td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><b>Material :</b></th>
                                            <td>Leather</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>



    {{-- <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target=".bs-example-modal-center">Center modal</button> --}}

    {{-- Modals  Codes  --}}
    <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Request </h5>
                    <button type="button" class="btn-close" id="closeMdl" data-bs-dismiss="modal"
                        aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form onsubmit="return false " id="withdrawForm">
                        <div class="form-group">
                            <label for="inputField">Amount</label>
                            <input type="text" class="form-control" id="withdrawAmount" name="amount"
                                placeholder="Enter your Amount">
                        </div>
                        <button type="button" class="btn btn-sm btn-primary mt-4"
                            onclick="makeRequest(this)">Request</button>
                    </form>


                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>



</div><!-- end row -->



@endsection

@section('script')
<script src="{{ URL::asset('assets/libs/gridjs/gridjs.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.js"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>


<script>
    var apiBase = `{{ url('/') }}`;

    apiBase = apiBase + '/api/';

    var url = window.location.href;
    var parts = url.split("/");
    var institute_id = parts[parts.length - 1];

    var couponsURL = `${apiBase}institutes/${institute_id}/coupons`;
    var coursesURL = `${apiBase}institutes/${institute_id}/courses`;
    var studentsURL = `${apiBase}students`;

    var statementsURL = `${apiBase}institutes/${institute_id}/wallet-transactions`;
    var walletTransactionsURL = `${apiBase}institutes/${institute_id}/wallet-transactions`;
    var withdrawRequestURL = `${apiBase}institutes/${institute_id}/withdraw-requests`;




    // Course table 
    const grid = new gridjs.Grid({
        columns: [{
                name: `{{ __('Name') }}`,
            },
            {
                name: `{{ __('Title') }}`
            },
            {
                name: `{{ __('Enrolled Students') }}`,
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

            // {
            //     name: `{{ __('Action') }}`,
            //     formatter: (cell, row) => {
            //         return gridjs.html(`       <button type="button" onclick="addData(this)"
            //                 class="btn btn-primary btn-sm btn-rounded">{{ __('Edit') }}   </button>
            //                 <button type="button" onclick="addData(this)"
            //                 class="btn btn-danger btn-sm btn-rounded">{{ __('Delete') }}   </button>
            //                 `)
            //     }
            // }

        ],
        search: true, // Enable search functionality
        sort: true,
        resizable: true,
        pagination: {
            enabled: true, // Enable pagination
            limit: 10, // Set the number of rows per page
        },
        server: {
            url: coursesURL,
            method: 'GET',
            then: (res) => {
                var res = res.data
                return res.map(data => [data.name, data.title, data.students_count, data.status, data
                    .price
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
                name: 'Enrolled Courses',
            },
            {
                name: 'Mobile Verfied',
                formatter: (cell, row) => {
                    console.log(cell, " cell val ")
                    if (cell) {
                        return gridjs.html(
                            `<span class="badge rounded-pill badge-soft-success" data-key="t-hot">Approved </span>`
                        )
                    } else {
                        return gridjs.html(
                            `<span class="badge rounded-pill badge-soft-danger" data-key="t-hot">Pending  </span>`
                        )


                    }
                }
            },
            {
                name: 'Email Verfied',
                formatter: (cell, row) => {
                    console.log(cell, " cell val ")
                    if (cell) {
                        return gridjs.html(
                            `<span class="badge rounded-pill badge-soft-success" data-key="t-hot">Approved </span>`
                        )
                    } else {
                        return gridjs.html(
                            `<span class="badge rounded-pill badge-soft-danger" data-key="t-hot">Pending  </span>`
                        )


                    }
                }
            },

            {
                name: 'Country',
            },
            {
                name: 'State',
            },
            {
                name: 'City',
            },

            {
                name: 'Address',
            },

            {
                name: 'Actions',
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
        pagination: {
            enabled: true, // Enable pagination
            limit: 10, // Set the number of rows per page
        },
        server: {
            url: studentsURL,
            method: 'GET',
            then: (data) => {
                console.log(data)
                //   data = JSON.parse(data);
                return data.map(inst => [inst.id, inst.name, inst.email, inst.mobile, inst.courses_count,
                    inst
                    .mobileVerified, inst.emailVerified, inst.country_id, , inst.state_id, inst
                    .city_id, inst.address
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

    // Course table 
    const statementGrid = new gridjs.Grid({
        columns: [{
                name: `{{ __('Message') }}`,
            },

            {
                name: `{{ __('Dr/Cr') }}`,
                formatter: (cell, row) => {
                    return gridjs.html(
                        `   <h6 class="my-0 ">  <span class="badge bg-${cell == "Credited" ? "success" : `danger`  } font-size-12 ms-2">${cell == "Debited" ? `{{ __('Debited') }}` : `{{ __('Credited') }}`  }</span>   </h6> `
                    )
                }
            },

            {
                name: `{{ __('Amount') }}`
            },
            {
                name: `{{ __('Balance') }}`
            },
            {
                name: `{{ __('Date') }}`
            }

        ],
        search: true,
        sort: true, // Enable search functionality
        resizable: true,
        pagination: {
            enabled: true, // Enable pagination
            limit: 10, // Set the number of rows per page
        },
        server: {
            url: statementsURL,
            method: 'GET',
            then: (res) => {
                var res = res.data
                return res.map(data => [data.message, data.transection_type, data.amount, data
                    .wallet_amount, data
                    .created_at
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

    statementGrid.render(document.getElementById('StatementTable'));




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


            // {
            //     name: `{{ __('Action') }}`,
            //     formatter: (cell, row) => {
            //         return gridjs.html(`       <button type="button" onclick="addData(this)"
            //                 class="btn btn-primary btn-sm btn-rounded">{{ __('Edit') }}  </button>
            //                 <button type="button" 
            //                 class="btn btn-danger btn-sm btn-rounded"  onclick='deleteRecord(this, ${row['_cells'][0]['data']})' > {{ __('Delete') }}    </button>
            //                 `)
            //     }
            // }
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
                var data = res['data']
                //   data = JSON.parse(data);
                return data.map(inst => [inst.id, inst.code, inst.coupon_type, inst.amount,
                    inst.start_date, inst.end_date, inst.id,
                ]);
            },
            handle: (res) => {
                console.log(res)
                if (res.status === 404) return {
                    data: []
                };
                if (res.ok) return res.json();
                throw Error('Oh no :(');
            },


        }
    });

    coupongrid.render(document.getElementById('couponsTable'));




    // Course table 
    const withdrawPendingGrid = new gridjs.Grid({
        columns: [{
                name: `{{ __(' Request ID ') }}`,
            }, {
                name: `{{ __('Amount') }}`
            },
            {
                name: `{{ __('Status') }}`,
                formatter: (cell, row) => {
                    return gridjs.html(
                        `<span class="badge rounded-pill badge-soft-danger" data-key="t-hot">{{ __('Pending') }}   </span>`
                    )
                }
            },
            {
                name: `{{ __('Date') }}`
            }

        ],
        search: true, // Enable search functionality
        sort: true,
        pagination: {
            enabled: true, // Enable pagination
            limit: 10, // Set the number of rows per page
        },
        server: {
            url: withdrawRequestURL,
            method: 'GET',
            then: (res) => {
                var res = res.data

                return res.map(data => [data.id,
                    data.amount, data.status, data
                    .created_at
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


    withdrawPendingGrid.render(document.getElementById('withdrawRequestsTable'));


    function getWalletMeta() {
        var wallet_meta = $("#wallet_meta");
        var apiBase = `{{ url('/') }}`;
        apiBase = apiBase + "/api/";
        var url = window.location.href;
        var parts = url.split("/");
        var institute_id = parts[parts.length - 1];
        var url = `${apiBase}institutes/${institute_id}/wallet-transactions`
        $.get(url, (res) => {

            var str = ` `;
            if (res['code'] == 200) {


                walletBalance = res['current_balance'];
                $(".myWalletBal").text(walletBalance);



            }
        })
    }

    getWalletMeta();

    function loadPageOptionViews(e, id) {
        console.log(id)
        $('.view-part').hide();
        console.log($('.view-part'))
        $(id).show();


    }

    function makeRequest(e) {
        console.log(" done ")
        var amount = $('#makeRequest').val();
        var formData = new FormData($('#withdrawForm')[0]);
        var serializedData = {};

        for (var [key, value] of formData.entries()) {
            serializedData[key] = value;
        }

        $.post(withdrawRequestURL, serializedData, (res) => {
            console.log(res)
            if (res['code'] == 500) {
                $('#closeMdl').trigger('click')
                return alert(res['message']);
            }
            if (res['code'] == 200) {
                $('#closeMdl').trigger('click')
                return alert(res['message']);
            }
        })

    }


    function downloadStatements(e) {
        const element = document.getElementById('StatementTable'); // Get the container element
        html2pdf().from(element).save('table.pdf');


    }


    var loadRating = async () => {



        var url = window.location.href;
        var parts = url.split("/");
        var institute_id = parts[parts.length - 1];

        if (!institute_id) {
            alert(" Something went wrong.");
            return;
        }
        var ratingURL = `${apiBase}institutes/${institute_id}/ratings`;


        var str = ``;
        $.get(ratingURL, (res) => {


            if (res.code == 200) {
                var str = ``;
                var data = res.data;

                $('#average_rating').text(res.average_rating ? res.average_rating.toFixed(1) : 0);
                $('#total_rating').text(res.total_rating);
                console.log(data)
                data.map((val) => {
                    str = str + ` <div class="border-bottom pb-3">
                            <p class="float-sm-end text-muted font-size-13">${val.created_at}</p>
                            <div class="badge bg-success mb-2"><i class="mdi mdi-star"></i> ${val.rating}</div>
                            <p class="text-muted mb-4">${val.comment}</p>
                            <div class="d-flex align-items-start">
                                <div class="flex-grow-1">
                                    <h5 class="font-size-15 mb-0">${val.student.name}</h5>
                                </div>

                            
                            </div>

                        </div>`
                })
                $("#ratingDiv").html(str);

            } else {
                alert(res.message)
                return
            }



        })

    }

    loadRating();
</script>
@endsection
