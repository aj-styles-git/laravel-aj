@extends('layouts.vertical-master-layout')
@section('title')
   {{ __(' Withdraw Requests') }}
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    {{-- breadcrumbs  --}}
@section('breadcrumb')
    @component('components.breadcrumb')
        @slot('li_1')
            {{ __('Withdraw Requests') }}
        @endslot
        @slot('title')
            {{ __('Requests') }}
        @endslot
    @endcomponent
@endsection

@section('pagecontentinfo')
    <div class="col">
        <div class="mt-md-0 py-3 px-4 mx-2">
            <p class="text-white-50 mb-2 text-truncate">{{ __('Pending') }} </p>
            <h3 class="text-white mb-0">{{ $approvals->count() }}</h3>
        </div>
    </div>
@endsection

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">{{ __('Withdraw Requests') }} </h4>
            </div>
            <div class="card-body">
                <div id="Table"></div>
            </div>
        </div>
    </div>

</div>
{{-- MODAL mm  --}}
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none   " id="reasonMDL" data-toggle="modal" data-target="#exampleModal">
    Reasons
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Reasons') }} </h5>
                <button type="button" class="close modal-close " data-dismiss="modal" aria-label="Close">
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

                                <select class="form-control" data-trigger name="reason" id="resonsSel"
                                     required >
                                    <option value="">{{ __('Select Reason') }} </option>                    
                                </select>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("Close") }}</button>
                <button type="button" class="btn btn-primary" id="changeReqStatusBTN" onclick="changeRequestStatus(this)">{{ __("Save") }}</button>
            </div>
        </div>
    </div>
</div>


@endsection
@section('script')
<!-- gridjs js -->
<script src="{{ URL::asset('assets/libs/gridjs/gridjs.min.js') }}"></script>
{{-- <script src="{{ URL::asset('assets/js/pages/gridjs.init.js') }}"></script> --}}

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script src="{{ URL::asset('assets/js/app.js') }}"></script>



<script>
    var apiBase = `{{ url('/') }}`;
    apiBase = apiBase + '/api/'
    console.log(apiBase, " APi base ")
    const grid = new gridjs.Grid({
        columns: [
            // {
            //     name: `{{ __('Request ID') }}`
            // },
            {
                name: `{{ __('Institute Name') }}`,


            },

            {
                name: `{{ __('Status') }}`,
                formatter: (cell, row) => {
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
                name: `{{ __('Amonut') }}`,
            },

            {
                name: `{{ __('Requested Days') }}`,
            },
            {
                name: `{{ __('Request Days') }}` // <-- new field for days since request
            },
            {
                name: `{{ __('Action') }}`,
                formatter: (cell, row) => {
                    return gridjs.html(`       <button type="button"
                            class="btn btn-primary btn-sm btn-rounded" onclick='loadReasons(this, 1, ${cell} )'>{{ __('Approve') }}  </button>
                            <button type="button" 
                            class="btn btn-danger btn-sm btn-rounded" onclick='loadReasons(this, 2 , ${cell} )'>{{ __('Reject') }}   </button>
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
            url: `${apiBase}payments/institutes/withdraw-requests`,
            method: 'GET',
            then: (data) => {
    data = data['data'];
    return data.map(inst => {
        const createdDate = new Date(inst.created_at);
        const today = new Date();
        const timeDiff = Math.abs(today - createdDate);
        const diffDays = Math.floor(timeDiff / (1000 * 3600 * 24));

        return [
            inst.institute.name,
            inst.status,
            inst.amount,
            inst.created_at,
            diffDays + ' days', // Add this here for the new column
            inst.id
        ];
    });
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


    grid.render(document.getElementById('Table'));



    function loadReasons( e, status, id ){
        
        var apiBase = `{{ url('/') }}`;
        apiBase = apiBase + '/api/'
        var url = `${apiBase}appsettings/reasons`;
        
        $("#changeReqStatusBTN").attr('status',status);
        $("#changeReqStatusBTN").attr('data-id',id);

        // Load the rejected resasons 
        if(status==2){
            status=0;
        }

        var resobj = {
            type: status,
            lang: "en",
            page_id:2
        }
        
       

        $.post(url, resobj, (res) => {
            console.log(res, " This is loadreasons ")
            if (res['code'] == 200) {
                var data=res.data
                var str = ``;
                $('#reasonMDL').trigger('click')
                data.map((val)=>{

                    str+=`   <option value="${val.id}">${val.message}</option> `
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

    function changeRequestStatus(e) {


        console.log("change stata ")
        var status= $("#changeReqStatusBTN").attr('status');
        var id= $("#changeReqStatusBTN").attr('data-id');

        var reason_id = $('#resonsSel').val();

        if(!reason_id){
            alert(" Please Select the reason.")
            return ;
        }
  
        if (status == 1) {

            var msg = "Do you want to approve this request"
             


        } else if (status == 2) {
            var msg = "Do you want to reject this request"
             

        } else {
            return
        }

        const result = window.confirm(msg);

        var obj = {
            "id": id,
            "status": status,
            "reason_id":reason_id,
            "transaction_id": "89547893457894357"
        }

        console.log("Oj", obj)

        if (result) {
            var apiBase = `{{ url('/') }}`;
            apiBase = apiBase + '/api';

            var url = `${apiBase}/payments/institutes/withdraw-requests`;

            $.post(url, obj, (res) => {
                console.log(res , " Change sta res ")
                if (res['code'] == 200) {
                    $('.modal-close').trigger('click');
                    $(e).closest('tr').remove();
                    alert(res['message']);

                 
                } else {
                    alert(res['message']);

                }
            })


        }

    }

    function profilePage(e, id) {
        var url = `{{ route('profile_institute', ':id') }}`;
        url = url.replace(':id', id);
        window.location = url;
    }
</script>
@endsection
