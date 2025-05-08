@extends('layouts.vertical-master-layout')
@section('title')
    {{ __('Admin') }}
@endsection
@section('css')
    <!-- plugin css -->

    <!-- One of the following themes -->
    <link href="{{ URL::asset('assets/libs/@simonwep/@simonwep.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/libs/@simonwep/@simonwep.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/libs/@simonwep/@simonwep.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    {{-- breadcrumbs  --}}
@section('breadcrumb')
    @component('components.breadcrumb')
        @slot('li_1')
            {{ __('Admin') }}
        @endslot
        @slot('title')
            {{ __('Admin') }}
        @endslot
    @endcomponent
@endsection
<div class="row">


    <div class="col-md-12">
        <button id="addBTN" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
            style="width:78px; float:right">
            Add
        </button>
    </div>

    <div class="col-lg-12 mt-4">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">{{ __('Admins') }} </h4>
            </div>
            <div class="card-body">
                <div id="Table"></div>
            </div>
        </div>
    </div>





    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document" style="min-width: 800px ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Create Admin') }}</h5>
                    <button type="button" class="close close_mdl" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <form id="AddFormSubmit">


                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="choices-single-default"
                                            class="form-label font-size-13 text-muted">{{ __('Admin Level') }}</label>
                                        <div class="text-danger" id="country_id">

                                        </div>
                                        <select class="form-control" data-trigger name="admin_level" id="admin_level">
                                            <option value="" disabled>{{ __('Please Select Type') }} </option>
                                            <option value="2" selected> Simple </option>
                                            <option value="1"> Super Admin</option>


                                        </select>
                                    </div>
                                </div>


                                <div class="col-lg-6 ">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input" class="form-label">
                                            {{ __('Name') }} </label>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="{{ __('Name') }}" autocomplete="false">

                                    </div>
                                </div>
                                <div class="col-lg-6 email_div">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input" class="form-label">
                                            {{ __('Email') }} </label>
                                        <input type="email" class="form-control" name="email"
                                            placeholder="{{ __('Email') }}" autocomplete="false">

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input" class="form-label">
                                            {{ __('Password') }} </label>
                                        <input type="text" class="form-control" name="password" id="password"
                                            placeholder="{{ __('Password') }}">

                                    </div>
                                </div>

                            </div>

                        </form>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="button" onclick="addAdmin(this)" class="btn btn-primary" id="saveBTN">
                        {{ __('Save') }}
                        <button type="button" id="updateBTN" onclick="updateAdmin(this)" class="btn btn-primary">
                            {{ __('Update') }}
                        </button>
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-12">

    </div><!-- end col -->
</div><!-- end row -->

@endsection

@section('script')
<script src="{{ URL::asset('assets/js/app.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

<script src="{{ URL::asset('assets/libs/gridjs/gridjs.min.js') }}"></script>


<script>
    $('#updateBTN').hide();

    var apiBase = `{{ url('/') }}`;

    apiBase += '/api/'

    var adminsURL = `${apiBase}appsettings/admin`;
    var updateAdminURL = `${apiBase}appsettings/admin`;

    const grid = new gridjs.Grid({
        columns: [{
                name: "ID ",
                hidden: true
            },
            {
                name: 'Name',
              

            },
            {
                name: 'Email',
            },
            {
                name: 'Level',
                width: '100px',
                formatter: (cell, row) => {
                    if (cell == 1) {
                        return gridjs.html(
                            `<span class="badge rounded-pill badge-soft-success" data-key="t-hot">{{ __('Super') }} </span>`
                        )
                    } else if (cell == 2) {
                        return gridjs.html(
                            `<span class="badge rounded-pill badge-soft-danger" data-key="t-hot">{{ __('Simple ') }}  </span>`
                        )


                    }
                }
            },
            {
                name: 'Status',
                width: '100px',
                formatter: (cell, row) => {
                    if (cell == 1) {
                        return gridjs.html(
                            `<span class="badge rounded-pill badge-soft-success" data-key="t-hot">{{ __('Active') }} </span>`
                        )
                    } else if (cell == 0) {
                        return gridjs.html(
                            `<span class="badge rounded-pill badge-soft-danger" data-key="t-hot">{{ __('Blocked') }}  </span>`
                        )


                    }
                }
            },


            {
                name: 'Action',
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
                                            <li class=" cp dropdown-item "  onclick='edit(this, ${cell})' >Edit </li>
                                            <li class="cp dropdown-item" onclick='blockAdmin(this, ${cell})'>Block </li>
                                            
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
            url: adminsURL,
            method: 'GET',
            then: (res) => {
                var data = res['data'];
                return data.map(inst => [inst.id, inst.name ? inst.name : "Guest", inst.email, inst
                    .admin_level, inst.status, inst.id
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




    function addAdmin(e) {

        e.disabled = true;

        var admin_level = $('#admin_level').val();
        var name = $('input[name=name]').val();
        var email = $('input[name=email]').val();
        var password = $('input[name=password]').val();
        $('#saveBTN').show();


        let obj = {
            admin_level,
            name,
            password,
            email

        };

        console.log(obj)

        $.post(adminsURL, obj, (res) => {
            if (res.code == 200) {
                console.log(res)
                $('.close_mdl').trigger('click');
                alert(res.message)
                $("#AddFormSubmit")[0].reset();
                e.disabled = false;

            } else {
                alert(res.message)
                e.disabled = false;

            }
        })

    }

    function blockAdmin(e, id) {


        var url = `${updateAdminURL}/${id}`
        var obj = {
            "status": 0
        }

        $.post(url, obj, (res) => {
            if (res.code == 200) {
                alert(res.message)

            } else {
                alert(res.message)

            }
        })

    }

    function updateAdmin(e, id) {

        e.disabled = true;

        var admin_level = $('#admin_level').val();
        var name = $('input[name=name]').val();
        var password = $('input[name=password]').val();

        let obj = {
            admin_level,
            name
        };

        if (password != undefined && password != "") {
            obj['password'] = password
        }


        console.log(obj)
        var id = $('#updateBTN').attr('data-id');

        var url = `${updateAdminURL}/${id}`



        console.log(obj)

        $.post(url, obj, (res) => {
            if (res.code == 200) {
                console.log(res)
                $('.close_mdl').trigger('click');
                alert(res.message)
                $("#AddFormSubmit")[0].reset();
                e.disabled = false;

            } else {
                alert(res.message)
                e.disabled = false;

            }
        })

    }

    function edit(e, id) {

        var url = `${adminsURL}/${id}`;

        $('#updateBTN').attr('data-id', id);

        $.get(url, (res) => {
            if (res.code == 200) {
                $("#addBTN").trigger('click');
                $('#saveBTN').hide();
                $('#updateBTN').show();

                var admin = res.data;
                var admin_level = $('#admin_level').val(admin.admin_level);
                var name = $('input[name=name]').val(admin.name);
                var email = $('.email_div').hide();
            } else {
                alert(res.message)

            }
        })

    }
</script>
@endsection
