@extends('layouts.vertical-master-layout')
@section('title')
    {{ __('Coupons') }}
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    {{-- breadcrumbs  --}}
@section('breadcrumb')
    @component('components.breadcrumb')
        @slot('li_1')
            {{ __('Coupons') }}
        @endslot
        @slot('title')
            {{ __('All Coupons') }}
        @endslot
    @endcomponent
@endsection

@section('pagecontentinfo')
@endsection

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">{{ __('Coupons') }} </h4>
            </div>
            <div class="card-body">
                <div id="Table"></div>
            </div>
        </div>
    </div>


    {{-- Modal  --}}

    <!-- Large modal -->

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Courses') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style=" max-height: 70vh; overflow-y: scroll; ">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">

                                <div class="card-body">
                                    <div id="courseTable"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                </div>
            </div>
        </div>
    </div>




</div>
@endsection
@section('script')
<!-- gridjs js -->
<script src="{{ URL::asset('assets/libs/gridjs/gridjs.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>


<script>
    var apiBase = `{{ url('/') }}`;
    apiBase += '/api/';

    var couponsURL = `${apiBase}coupons`;
    var courseGrid;

    const grid = new gridjs.Grid({
        columns: [{
                name: "ID ",
                hidden: true
            },
            {
                name: `{{ 'Institute Name' }}`,


            },
            {
                name: `{{ __('Courses') }}`,
                formatter: (cell, row) => {


                    return gridjs.html(
                        `<span class="cp " data-toggle="modal" data-target=".bd-example-modal-lg" onclick="loadCourses(this,${row._cells[0].data})">${cell}  </span>`
                    )



                }


            },
            {
                name: `{{ __('Code') }}`,
            },
            {
                name: `{{ __('Status') }}`,
                formatter: (cell, row) => {
                    if (cell == 1) {
                        return gridjs.html(
                            `<span class="badge rounded-pill badge-soft-success" data-key="t-hot">Active </span>`
                        )
                    } else if (cell == 0) {
                        return gridjs.html(
                            `<span class="badge rounded-pill badge-soft-danger" data-key="t-hot">Blocked  </span>`
                        )


                    }
                }
            },

            {
                name: `{{ __('Type') }}`,
                formatter: (cell, row) => {
                    if (cell == 1) {
                        return gridjs.html(
                            `<p> {{ __('Flat Discount') }}</p>`
                        )
                    } else {
                        return gridjs.html(
                            `<p> {{ __('In Percentage') }} </p>`

                        )


                    }
                }

            },
            {
                name: `{{ __('Amount') }}`,
            },

            {
                name: `{{ __('Action') }}`,
                width: '80px',
                formatter: (cell, row) => {

                    return gridjs.html(`                      
                    <div class="overlay-content rounded-top">
                        <div>
                            <div class="user-nav p-3">
                                <div class="d-flex justify-content-end">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bx bx-dots-horizontal font-size-20 text-primary"></i>
                                        </a>

                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li class=" cp dropdown-item " onclick="redirectEditPage(this,'${cell}')" >Edit </li>
                                            <li class="cp dropdown-item" onclick="deleteRecord(this, '${cell}')" >Block </li>
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                  `)

                }
            }

        ],
        search: true,
        sort: true,
        resizable: true,
        pagination: {
            enabled: true,
            limit: 10,
        },
        server: {
            url: couponsURL,
            method: 'GET',
            then: (data) => {
                data = data['data'];
                return data.map(inst => [inst.id, inst.institute ? inst.institute.name : "Applied to all",
                    inst.courses_count, inst.code, inst.status, inst.coupon_type, inst.amount, inst
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




    var apiBase = ` {{ url('/') }}`;
    apiBase += "/api/";
    window.courseGrid = new gridjs.Grid({
        columns: [{
                name: 'lang',
                hidden: true
            }, {
                name: `{{ __('Name') }}`,
            },
            {
                name: `{{ __('Title') }}`,
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
            },


            {
                name: `{{ __('Price') }}`,
            },


        ],
        search: true,
        sort: true,
        resizable: true,
        pagination: {
            enabled: true,
            limit: 10,
        },
       data:[]


    }).render(document.getElementById('courseTable'));


    console.log(window.courseGrid, " Immediate after init")


    function deleteRecord(e, id) {

        const result = window.confirm("Do you really want to delete this Item...");

        if (result) {
            var apiBase = `{{ url('/') }}`;
            apiBase += '/api/'

            var deleteCouponURL = `${apiBase}coupons/${id}`;

            $.ajax({
                url: deleteCouponURL, // The URL to send the DELETE request to
                type: 'DELETE', // HTTP method

                success: function(res) {
                    if (res['code'] == 200) {
                        $(e).closest('tr').remove();
                        alert(res.message)

                    } else {
                        alert(res.message)

                    }

                },
                error: function(xhr, status, error) {
                    console.error('Error deleting data:', error);
                }
            });

        } else {
            // User clicked Cancel
            console.log("User canceled.");
        }


    }

    function profilePage(e, id) {
        var url = `{{ route('profile_institute', ':id') }}`;
        url = url.replace(':id', id);
        window.location = url;
    }

    function redirectEditPage(e, id) {
        var url = `{{ route('coupon_edit', ['id' => ':id']) }}`;
        url = url.replace(':id', id);
        window.location = url;
        return;
    }


    function loadCourses(e, id) {


        console.log(courseGrid)
        $.get(couponsURL + `/${id}`, (res) => {
            console.log("🚀 ~ file: coupons.blade.php:385 ~ loadCourses ~ getCouponDetail:", couponsURL)

            console.log(res.data.courses)
            var dataValues = res.data.courses

          console.log(   window.courseGrid , " update fun")
            var instContainer = document.getElementById('courseTable')
         
            window.courseGrid.updateConfig({

                data:dataValues 
            }).forceRender(instContainer)


        })

    }
</script>
@endsection
