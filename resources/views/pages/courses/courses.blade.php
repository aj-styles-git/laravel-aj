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
    <div class="col">
        <div class="mt-md-0 py-3 px-4 mx-2">
            <p class="text-white-50 mb-2 text-truncate">{{ __('Total Courses') }} </p>
            <h3 class="text-white mb-0"> {{ $courses->count() }}</h3>
        </div>
    </div>

    <div class="col">
        <div class="mt-md-0 py-3 px-4 mx-2">
            <p class="text-white-50 mb-2 text-truncate"> {{ __('Enrolled Students') }}</p>
            <h3 class="text-white mb-0">{{ $courses->sum('students_count') }}</h3>
        </div>
    </div>



    <div class="col">
        <div class="mt-md-0 py-3 px-4 mx-2">
            <p class="text-white-50 mb-2 text-truncate"> {{ __('Pending') }} </p>
            <h3 class="text-white mb-0">{{ $courses->where('status', 2)->count() }}</h3>
        </div>
    </div>

    <div class="col">
        <div class="mt-md-0 py-3 px-4 mx-2">
            <p class="text-white-50 mb-2 text-truncate"> {{ __('Ongoing') }} </p>
            <h3 class="text-white mb-0">{{ $courses->where('status', 4)->count() }}</h3>
        </div>
    </div>
    <div class="col">
        <div class="mt-md-0 py-3 px-4 mx-2">
            <p class="text-white-50 mb-2 text-truncate"> {{ __('Upcoming') }} </p>
            <h3 class="text-white mb-0">{{ $courses->where('status', 5)->count() }}</h3>
        </div>
    </div>
    <div class="col">
        <div class="mt-md-0 py-3 px-4 mx-2">
            <p class="text-white-50 mb-2 text-truncate"> {{ __('Expired') }} </p>
            <h3 class="text-white mb-0">{{ $courses->where('status', 6)->count() }}</h3>
        </div>
    </div>
@endsection
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">{{ __('All Courses') }} </h4>
            </div>
            <div class="card-body">
                <div id="Table"></div>
            </div>
        </div>
    </div>

</div>

{{-- Modal  --}}

<!-- Modal -->
<div class="modal fade" id="reasonMDL" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Reasons') }} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form action="" onsubmit="return false ; ">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="choices-single-default"
                                    class="form-label font-size-13 text-muted">{{ __('Reason') }}</label>

                                <select class="form-control" data-trigger name="reason" id="resonsSel" required>
                                    <option value="">{{ __('Select Reason') }} </option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="reasonMDLBTN"
                    onclick="updateCourseStatus(this,null,3,null)">Save changes</button>
            </div>
        </div>
    </div>
</div>


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none" id="docModalBTN" data-toggle="modal" data-target="#documentModal">
    btn
</button>

<!-- Modal -->
<div class="modal fade" id="documentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Document') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="docModalBody">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
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
    var apiBase = ` {{ url('/') }}`;
    apiBase += "/api/";
    const grid = new gridjs.Grid({
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
                name: `{{ __('Institute Name') }}`,
            },
            {
                name: `{{ __('Students') }}`,
                width: '80px'
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

            {
                name: `{{ __('Action') }}`,
                width: '90px',
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
                                            <li class=" cp dropdown-item " onclick="redirectCoursePage(this,'${cell}')"  >{{ __('View') }} </li>
                                            <li class=" cp dropdown-item " onclick="redirectCourseEditPage(this,'${cell}')">{{ __('Edit') }} </li>
                                            <li class=" cp dropdown-item " onclick="viewDocument(this,'${cell}')">{{ __('Document') }} </li>
                                            <li class=" cp dropdown-item " onclick="updateCourseStatus(this,'${cell}',1 , ${row._cells[0].data})">{{ __('Approve') }} </li>
                                            <li class=" cp dropdown-item "  data-toggle="modal" data-target="#reasonMDL" onclick="updateCourseStatus(this,'${cell}',-1, ${row._cells[0].data})">{{ __('Reject') }} </li>
                                           
                                            
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
            url: `${apiBase}courses`,
            method: 'GET',
            then: (res) => {

                console.log(res.data)
                res = res.data
                return res.map(data => [data.language_id, data.name, data.title, data.institute ? data
                    .institute.name : " Not Found", data.students_count, data.status, data.price,
                    data.course_id
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


    function redirectCoursePage(e, id) {
        console.log(id)
        var url = `{{ route('course_detail', ['course_id' => ':course_id']) }}`;
        url = url.replace(':course_id', id);
        window.location = url;
        return;

    }

    function redirectCourseEditPage(e, id) {

        var url = `{{ route('edit_course', ['id' => ':id']) }}`;
        url = url.replace(':id', id);
        window.location = url;
        return;

    }

    function deleteRecord(e, id, lang) {
        var mess = `{{ __('Do you really want to Block this Institute') }}`

        const result = window.confirm(mess);


        if (result) {
            var apiBase = `{{ url('/') }}`;
            apiBase += "/api/";

            var obj = {
                "language_id": lang
            }
            var deleteUrl = `${apiBase}courses/${id}`;
            $.ajax({
                url: deleteUrl, // The URL to send the DELETE request to
                type: 'DELETE', // HTTP method
                data: obj,
                success: function(result) {
                    if (result['code'] == 200) {
                        alert(result['message']);

                    } else {
                        alert(result['message']);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error deleting data:', error);
                }
            });

        } else {
            console.log("User canceled.");
        }


    }

    function updateCourseStatus(e, id, status, lang) {

        // update modal btn 
        if (status == -1) {
            $("#reasonMDLBTN").attr('data-id', id)
            $("#reasonMDLBTN").attr('lang', lang)
            return;
        }


        var reason_id = "";

        if (status == 3) {


            id = $("#reasonMDLBTN").attr('data-id')
            lang = $("#reasonMDLBTN").attr('lang')

            reason_id = $('#resonsSel').val();

            if (!reason_id) {
                alert(" Please Select the reason.")
                return;
            }

        }



        var mess = `{{ __('Are you sure?') }}`

        const result = window.confirm(mess);


        if (result) {
            var apiBase = `{{ url('/') }}`;
            apiBase += "/api/";

            lang = "en";

            if (lang == 1002) {

                lang = "ar";
            } else if (lang == "en") {
                lang = "en"
            }

            console.log(lang)
            const formData = new FormData();
            formData.append('status', status);
            formData.append('lang', lang);

            formData.append('reason_id', reason_id);

            formData.append('_method', 'PUT');

            var updateURL = `${apiBase}courses/${id}`;

            $.ajax({
                url: updateURL, // Replace with your API endpoint URL
                type: 'POST',
                data: formData, // Convert the data to JSON format
                processData: false,
                contentType: false,

                success: function(res) {
                    console.log(res)
                    if (res['code'] == 200) {
                        alert(res.message)
                        return;
                    } else {
                        alert(res.message)
                        return

                    }



                }

            });


        } else {
            console.log("User canceled.");
        }

    }

    // Load Reasons 
    function loadReasons(e, status) {

        var apiBase = `{{ url('/') }}`;
        apiBase = apiBase + '/api/'
        var url = `${apiBase}appsettings/reasons`;


        var resobj = {
            type: 0,
            lang: "en",
            page_id: "course_rejected"
        }



        $.post(url, resobj, (res) => {
            if (res['code'] == 200) {
                var data = res.data
                var str = ``;
                // MicroModal.show('reasonMDL');

                // $('#reasonMDL').trigger('click')

                data.map((val) => {

                    str += `   <option value="${val.id}">${val.message}</option> `
                })
                $('#resonsSel').html(str);


            } else {
                console.log(" Error is here ")
                alert(res['message'])
                return
            }
        })

        return


    }


    function viewDocument(e, id) {

        $("#docModalBTN").trigger('click')

        var url = `{{ url('api/courses') }}/${id}`;
        var obj = {
            "_fields": "document"
        }
        $("#docModalBody").empty()
        loader(`  {{ __('Processing') }}... `);
        $.get(url, obj, (res) => {
            var str = `<h4>{{ __('No Document Found.') }}</h4>`;
            
            if (res.code == 200) {

                if (res.data[0].documet!="") {
                     str = ` <img src="{{ asset('storage') }}/${res.data[0].document}" alt="Not Found"  style="height: 100% ; width:100% ">`
                }
                loader(`  {{ __('Docuement Not Found') }}... `);

                $("#docModalBody").append(str)


            } else {

                loader(`  {{ __('Something Went wrong') }}... `);


            }

        })

    }

    loadReasons();
</script>
@endsection
