@extends('layouts.vertical-master-layout')
@section('title')
    {{ __('Students') }}
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    {{-- breadcrumbs  --}}
@section('breadcrumb')
    @component('components.breadcrumb')
        @slot('li_1')
            {{ __('Students') }}
        @endslot
        @slot('title')
            {{ __('All Students') }}
        @endslot
    @endcomponent
@endsection

@section('pagecontentinfo')
    <div class="col">
        <div class="mt-md-0 py-3 px-4 mx-2">
            <p class="text-white-50 mb-2 text-truncate">{{ __('Total Students') }} </p>
            <h3 class="text-white mb-0"> {{ $students->count() }}</h3>
        </div>
    </div>

    <div class="col">
        <div class="mt-md-0 py-3 px-4 mx-2">
            <p class="text-white-50 mb-2 text-truncate">{{ __('Verified') }} </p>
            <h3 class="text-white mb-0"> {{ $students->where('mobileVerified', 1)->where('emailVerified', 1)->count() }}
            </h3>
        </div>
    </div>

    <div class="col">
        <div class="mt-md-0 py-3 px-4 mx-2">
            <p class="text-white-50 mb-2 text-truncate">{{ __('Blocked') }} </p>
            <h3 class="text-white mb-0"> {{ $students->where('status', 0)->count() }}</h3>
        </div>
    </div>
@endsection

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">{{ __('All Students') }} </h4>
            </div>
            <div class="card-body">
                <div id="Table"></div>
            </div>
        </div>
    </div>

</div>
@endsection
@section('script')
<!-- gridjs js -->
<script src="{{ URL::asset('assets/libs/gridjs/gridjs.min.js') }}"></script>
{{-- <script src="{{ URL::asset('assets/js/pages/gridjs.init.js') }}"></script> --}}
<script src="{{ URL::asset('assets/js/app.js') }}"></script>


<script>
    var apiBase = `{{ url('/') }}`;
    apiBase += '/api/';
    var studentsUrl = `${apiBase}students`;

    const grid = new gridjs.Grid({
        columns: [

            {

                name: `{{ __('ID') }}`,
                hidden: true
            }, {
                name: `{{ __('Name') }}`,
            },
            {
                name: `{{ __('Email') }}`,
            },
            {
                name: `{{ __('Mobile') }}`,
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


            {
                name: `{{ __('Address') }}`,
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
                                            <li class=" cp dropdown-item " onclick="redirectPage(this,'${cell}')"  >{{ __('View') }} </li>
                                            <li class=" cp dropdown-item " onclick="redirectEditPage(this,'${cell}')" >{{ __('Edit') }} </li>
                                            <li class="cp dropdown-item" onclick="deleteRecord(this, '${cell}')" >{{ __('Block') }} </li>
                                            
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
        search: true, // Enable search functionality
        sort: true,
        resizable: true,
        pagination: {
            enabled: true, // Enable pagination
            limit: 10, // Set the number of rows per page
        },
        server: {
            url: studentsUrl,
            method: 'GET',
            then: (data) => {
                return data.map(inst => [inst.id, inst.name, inst.email, inst.mobile, inst
                    .status, inst.address, inst.id
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

        const result = window.confirm(`{{ __("Do you really want to delete.") }}`);

        if (result) {
            var apiBase = `{{ url('/') }}`;
            apiBase += '/api/'

            $.ajax({
                url: `${apiBase}students/${id}`, // The URL to send the DELETE request to
                type: 'DELETE', // HTTP method

                success: function(result) {
                    console.log('Data deleted successfully');
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

    function redirectPage(e, id) {
        var url = `{{ route('student_profile', ['student_id' => ':student_id']) }}`;
        url = url.replace(':student_id', id);
        window.location = url;
        return;
    }

    function redirectEditPage(e, id) {
        var url = `{{ route('student_edit', ['student_id' => ':student_id']) }}`;
        url = url.replace(':student_id', id);
        window.location = url;
        return;
    }
</script>
@endsection
