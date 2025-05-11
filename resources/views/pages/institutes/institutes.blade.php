@extends('layouts.vertical-master-layout')
@section('title')
    {{ __('Institutes') }}
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    {{-- breadcrumbs  --}}
@section('breadcrumb')
    @component('components.breadcrumb')
        @slot('li_1')
            {{ __('Institutes') }}
        @endslot
        @slot('title')
            {{ __('All Institutes') }}
        @endslot
    @endcomponent
@endsection

@section('pagecontentinfo')
    <div class="col">
        <div class="mt-md-0 py-3 px-4 mx-2">
            <p class="text-white-50 mb-2 text-truncate">{{ __('Total Institutes') }} </p>
            <h3 class="text-white mb-0"> {{ $institutes->count() }}</h3>
        </div>
    </div>

    <div class="col">
        <div class="mt-md-0 py-3 px-4 mx-2">
            <p class="text-white-50 mb-2 text-truncate">{{ __('Incomplete') }} </p>
            <h3 class="text-white mb-0">{{ $institutes->where('status', 4)->count() }}</h3>
        </div>
    </div>
    <div class="col">
        <div class="mt-md-0 py-3 px-4 mx-2">
            <p class="text-white-50 mb-2 text-truncate">{{ __('Approved') }} </p>
            <h3 class="text-white mb-0">{{ $institutes->where('status', 1)->count() }}</h3>
        </div>
    </div>

    <div class="col">
        <div class="mt-md-0 py-3 px-4 mx-2">
            <p class="text-white-50 mb-2 text-truncate">{{ __('Pending For Approval') }} </p>
            <h3 class="text-white mb-0">{{ $institutes->where('status', 2)->count() }}</h3>
        </div>
    </div>


    <div class="col">
        <div class="mt-md-0 py-3 px-4 mx-2">
            <p class="text-white-50 mb-2 text-truncate">{{ __('Rejected') }} </p>
            <h3 class="text-white mb-0">{{ $institutes->where('status', 3)->count() }}</h3>
        </div>
    </div>

    <div class="col">
        <div class="mt-md-0 py-3 px-4 mx-2">
            <p class="text-white-50 mb-2 text-truncate">{{ __('Blocked') }} </p>
            <h3 class="text-white mb-0">{{ $institutes->where('status', 0)->count() }}</h3>
        </div>
    </div>
@endsection

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">{{ __('All Institutes') }} </h4>
            </div>
            <div class="card-body">
                <div id="Table"></div>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-success d-none " data-bs-toggle="modal" data-bs-target="#mdl"
        id="viewDocBTN">Large modal</button>

    <!--  Large modal example -->
    <div class="modal fade bs-example-modal-md" tabindex="-1" aria-hidden="true" aria-labelledby="myLargeModalLabel"
        aria-hidden="true" id="mdl">
        <div class="modal-dialog modal-md modal-dialog-centered modal-top ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">{{ __('Document') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body" id="viewDocDiv" style="height:50vh;width: 300px">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <button type="button" class="btn btn-danger " onclick="loadReasons(this,3)"
                        data-bs-target="#reasonsModal" data-bs-toggle="modal"
                        data-bs-dismiss="modal">{{ __('Reject') }}</button>
                    <button type="button" class="btn btn-primary " onclick="loadReasons(this,1)"
                        data-bs-target="#reasonsModal" data-bs-toggle="modal"
                        data-bs-dismiss="modal">{{ __('Approve') }}</button>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



</div>

{{-- MODAL mm  --}}
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none   " id="reasonMDL" data-toggle="modal" data-target="#reasonsModal">
    Reasons
</button>

<!-- Modal -->
<div class="modal fade" id="reasonsModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Reasons') }} </h5>
                <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close">
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
                <button type="button" class="btn btn-primary" id="approvedBTN"
                    onclick="approveInst(this)">{{ __('Save') }}</button>
                    
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
    $(document).ready(() => {})
    var apiBase = `{{ url('/') }}`;
    apiBase += '/api/';

    var institutesURL = `${apiBase}institutes`
    const grid = new gridjs.Grid({
        columns: [{
                name: `{{ __("ID") }}`,
                hidden: true
            },
            {
                name: `{{ __('Name') }}`,
                formatter: (cell, row) => {
                    return gridjs.html(`    <a href='#' onclick='profilePage(this, ${row['_cells'][0]['data']})' > ${cell}</a>
                            `)
                }

            },
            {
                name: `{{ __('Email') }}`,
            },
            {
                name: `{{ __('Total Students') }}`,
            },
            {
                name: `{{ __('Status') }}`,
                width: '100px',
                formatter: (cell, row) => {
                    if (cell == 1) {
                        return gridjs.html(
                            `<span class="badge rounded-pill badge-soft-success" data-key="t-hot">{{ __('Active') }} </span>`
                        )
                    } else if (cell == 0) {
                        return gridjs.html(
                            `<span class="badge rounded-pill badge-soft-danger" data-key="t-hot">{{ __('Inactive') }}  </span>`
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
                            `<span class="badge rounded-pill badge-soft-danger" data-key="t-hot">{{ __('Incomplete') }}  </span>`
                        )
                    }
                }
            },


            // {
            //     name: 'Country',
            //     width: '100px'

            // },
            // {
            //     name: 'State',
            // },

            {
                name: `{{ __('Address') }}`,
            },


                        {
                name: `{{ __('Action') }}`,
                width: '90px',
                formatter: (cell, row) => {
                    console.log(row,"ooooooooooooooooooooooooooooo");
                    
                    return gridjs.html(`
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bx-dots-horizontal font-size-20 text-primary"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li class="dropdown-item">
                                    <a href="{{ route('institute.document', ':id') }}" class="text-decoration-none">
                                        {{ __('Document') }}
                                    </a>
                                </li>
                                <li class="dropdown-item" onclick='editInstitute(this, ${cell})'>{{ __('Edit') }}</li>
                                <li class="dropdown-item" style="cursor: pointer;" onclick='toggleStatus(${row['_cells'][0]['data']}, this)'>
                                ${row['_cells'][4]['data'] == 1 ? '{{ __('Inactive') }}' : '{{ __('Active') }}'}
                                </li>
                            </ul>
                        </div>
                    `.replace(':id', cell));
                }
            }

        ],
        search: true,
        sort: true,
        resizable: true,
        language: {
            pagination: {
                previous: `{{ __('Previous') }}`,
                next: `{{ __('Next') }}`,
            },
        },
        pagination: {
            enabled: true, // Enable pagination
            limit: 10, // Set the number of rows per page
        },
        server: {
            url: institutesURL,
            method: 'GET',
            then: (res) => {
                var data = res['data'];
                return data.map(inst => [inst.id, inst.name ? inst.name : "-", inst.email,inst.student_count, inst.status, inst
                    .address, inst.id
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




    function deleteRecord(e, id) {
        var mess = `{{ __('Do you really want to Block this Institute') }}`

        const result = window.confirm(mess);


        if (result) {
            var apiBase = `{{ url('/') }}`;
            apiBase += "/api/";

            var deleteUrl = `${apiBase}institutes/${id}`;
            $.ajax({
                url: deleteUrl, // The URL to send the DELETE request to
                type: 'DELETE', // HTTP method

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
    function toggleStatus(id, element) {
    const confirmationMessage = `{{ __('Are you sure you want to toggle the status of this institute?') }}`;
    if (!confirm(confirmationMessage)) {
        return;
    }

    const apiBase = `{{ url('/') }}/api/`;
    const url = `${apiBase}institutes/${id}/toggle-status`;

    $.ajax({
        url: url,
        type: 'PUT',
        success: function (res) {
            if (res.code === 200) {
                alert(res.message);

                // Update the dropdown text dynamically
                const dropdownItem = $(element);
                const currentText = dropdownItem.text().trim();

                if (currentText === '{{ __('Inactive') }}') {
                    dropdownItem.text('{{ __('Activate') }}');
                    // Update the status badge dynamically
                    $(element).closest('tr').find('.badge').removeClass('badge-soft-success').addClass('badge-soft-danger').text('{{ __('Inactive') }}');
                } else {
                    dropdownItem.text('{{ __('Inactive') }}');
                    // Update the status badge dynamically
                    $(element).closest('tr').find('.badge').removeClass('badge-soft-danger').addClass('badge-soft-success').text('{{ __('Active') }}');
                }
            } else {
                alert(res.message);
            }
        },
        error: function () {
            alert('{{ __('An error occurred while updating the status.') }}');
        }
    });
}
    function profilePage(e, id) {
        var url = `{{ route('profile_institute', ':id') }}`;
        url = url.replace(':id', id);
        window.location = url;
    }


    function fetchInstituteDetails(e, id) {
        var apiBase = `{{ url('/') }}`;
        apiBase += `/api/`;
        $('#viewDocBTN').trigger('click');

        $('#approvedBTN').attr('data-id', id);

        var url = `${apiBase}institutes/${id}`;

        $.get(url, (res) => {
            if (res['code'] == 200) {
                var data = res['data'];
                if (data.document == "" || data.document == undefined || data.document == null) {
                    str = `<h4> {{ __('No Document Found') }}... </h4>`
                } else {
                    var str = `<img src="{{ asset('storage/${data.document}') }}" alt=""
                            class="avatar-xl rounded-circle img-thumbnail" style="height:200px; width:300px">`;
                }

                $('#viewDocDiv').html(str);
                return
            } else if (res.code == 403) {
                alert(res.message);
            }

        })
    }

    function approveInst(e) {

        var id = $('#approvedBTN').attr('data-id');
        var status = $('#approvedBTN').attr('status');
        var updateURL = `${apiBase}institutes/${id}`

        var reason_id = $('#resonsSel').val();

        if (!reason_id) {
            alert(" Please Select the reason.")
            return;
        }


        var approved = 0;
        if (status == 1) {
            approved = 1;
        } else {
            approved = 0;

        }
        var obj = {
            "lang": "en",
            "approved": approved,
            "status": status,
            "reason_id":reason_id
        }

        $.ajax({
            url: updateURL,
            type: 'PUT',
            data: obj,
            success: function(res) {
                if (res.code == 200) {
                    $('#mdl').modal('hide');
                    $('#reasonsModal').modal('hide');
                    alert(res.message)
                }
            },
            error: function(xhr, status, error) {
                // Handle the error
            }
        });


    }

    function editInstitute( e , id ){
        var url = `{{ route('edit_institute', ["id"=>":id"]) }}`;

        url = url.replace(":id",id);
        window.location= url ; 
        return 
    }

    // Load Reasons 
    function loadReasons(e, status) {

        var apiBase = `{{ url('/') }}`;
        apiBase = apiBase + '/api/'
        var url = `${apiBase}appsettings/reasons`;
        $("#approvedBTN").attr('status', status);

        if (status == 3) {
            // change the type if rejected then load all the rejected reasons 
            status = 0;
        }
        var resobj = {
            type: status,
            lang: "en",
            page_id: 1
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

    
</script>
@endsection
