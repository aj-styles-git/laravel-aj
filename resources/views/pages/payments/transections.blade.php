@extends('layouts.vertical-master-layout')
@section('title')
    {{ __('Orders') }}
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    {{-- breadcrumbs  --}}
@section('breadcrumb')
    @component('components.breadcrumb')
        @slot('li_1')
            {{ __('Orders') }}
        @endslot
        @slot('title')
            {{ __('All Orders') }}
        @endslot
    @endcomponent
@endsection

@section('pagecontentinfo')
    <div class="col">
        <div class="mt-md-0 py-3 px-4 mx-2">
            <p class="text-white-50 mb-2 text-truncate">{{ __('Total Amount') }} </p>
            <h3 class="text-white mb-0"> ${{ $transections->sum('amount') }}</h3>
        </div>
    </div>


    <div class="col">
        <div class="mt-md-0 py-3 px-4 mx-2">
            <p class="text-white-50 mb-2 text-truncate">{{ __('Commission') }} </p>
            <h3 class="text-white mb-0">$ {{ $transections->sum('commission_amount') }}</h3>
        </div>
    </div>
@endsection

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">{{ __('All Orders') }} </h4>
            </div>
            <div class="card-body">
                <div id="Table"></div>
            </div>
        </div>
    </div>

</div>

<button type="button" class="btn btn-info d-none  " data-bs-toggle="modal" id="orderDetailBTN"
    data-bs-target=".bs-example-modal-xl">Extra large modal</button>

<!--  Extra Large modal example -->
<div class="modal fade bs-example-modal-xl " tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">{{ __('Invoice') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="orderDetailsDiv">

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


<script>

    var apiBase = `{{ url('/') }}`;
    apiBase = apiBase + '/api/'

    var success = `{{ __('Success') }}`;
    var failed = `{{ __('Failed') }}`;

    const grid = new gridjs.Grid({
        columns: [{
                name: `{{ __('Order ID') }}`

            },
            {
                name: `{{ __('Transaction ID') }}`,


            },
            {
                name: `{{ __('Course name') }}`,
            },
            {
                name: `{{ __('Status') }}`,
                formatter: (cell, row) => {
                    console.log(cell, " cell val ")
                    if (cell) {
                        return gridjs.html(
                            `<span class="badge rounded-pill badge-soft-success" data-key="t-hot">${success} </span>`
                        )
                    } else {
                        return gridjs.html(
                            `<span class="badge rounded-pill badge-soft-danger" data-key="t-hot">${failed}  </span>`
                        )


                    }
                }
            },

            {
                name: `{{ __('Amount') }}`,
            },
            {
                name: `{{ __('View') }}`,
                sort: false,
                formatter: (cell, row) => {
                    return gridjs.html(
                        ` <div class="col-xl-3 col-lg-4 col-sm-6 text-center " style="cursor:pointer" onclick="fetchOrderDetails(this,${cell})"  >
                        <i class="uil-eye"></i> 
                    </div>`
                    )
                }

            },

            {
                name: `{{ __('Date') }}`,
            },

        ],
        search: true,
        sort: true,
        resizable: true,
        pagination: {
            enabled: true, // Enable pagination
            limit: 10, // Set the number of rows per page
        },
        server: {
            url: `${apiBase}orders`,
            method: 'GET',
            then: (data) => {
                console.log(data, "this is the respinse")
                data = data['data'];
                //   data = JSON.parse(data);
                return data.map(inst => [inst.id, inst.transection_id, inst.course.name, inst.status, inst
                    .amount, inst.id, inst.created_at
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


    grid.render(document.getElementById('Table'));




    function deleteRecord(e, id) {

        const result = window.confirm("Do you really want to delete this Item...");

        if (result) {
            $(e).closest('tr').remove();
            var token = `{{ env('API_AUTH_TOKEN') }}`;
            var apiBase = `{{ env('API_BASE_URL') }}`;

            $.ajax({
                url: `${apiBase}institutes/${id}`, // The URL to send the DELETE request to
                type: 'DELETE', // HTTP method
                headers: {
                    'Authorization': `Bearer ${token}`,
                },
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

    function fetchOrderDetails(e, orderId) {
        $("#orderDetailBTN").trigger("click");
        var url = `${apiBase}orders/${orderId}`;
        $.get(url, (res) => {
            if (res['code'] == 200) {

                var data = res['data']['order_details'];
                var other_details = res['data'];
                console.log(data)
                console.log(other_details)
                var str = `
                <div class="card-body">
                        <div class="invoice-title">
                            <h4 class="float-end font-size-15">{{ __('Invoice') }}:- #DW_${data['transection_id']} <span class="badge ${data['status']==1? `bg-success` : `bg-danger` } font-size-12 ms-2"> ${data['status']==1? `{{ __('Paid') }}` : `{{ __('Failed') }}` } </span></h4>
                            <div class="mb-4">
                                <img src="{{ URL::asset('assets/images/dawrat_logo.png') }}" alt="logo" height="28" />
                            </div>
                            <div class="text-muted">
                        <p class="mb-1">${other_details.address}</p>
                        <p class="mb-1"><i class="uil uil-envelope-alt me-1"></i> ${other_details.email}</p>
                        <p><i class="uil uil-phone me-1"></i>${other_details.phone}</p>
                    </div>
                    
                        </div>
        
                        <hr class="my-4">
        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="text-muted">
                                    <div class="text-muted">
                                <h5 class="font-size-16 mb-3">Billed To:</h5>
                                <h5 class="font-size-15 mb-2">${data.student.name}</h5>
                                <p class="mb-1">${data.student.address}</p>
                                <p class="mb-1">${data.student.email}</p>
                                <p>${data.student.mobile}</p>
                        </div>
                                    
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-sm-6">
                                <div class="text-muted text-sm-end">
                                   
                                    <div class="mt-4">
                                        <h5 class="font-size-15 mb-1">{{ __('Date') }}:</h5>
                                        <p>${data.created_at }</p>
                                    </div>
                                    <div class="mt-4">
                                        <h5 class="font-size-15 mb-1">{{ __('Order ID') }}:</h5>
                                        <p>#${data.id}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
        
                        <div class="py-2">
                            <h5 class="font-size-15">{{ __('Order Summary') }} </h5>
        
                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap table-centered mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 70px;">{{ __('No') }}</th>
                                            <th>{{ __('Product Name') }} </th>
                                            <th>{{ __('Price') }}</th>
                                            <th>{{ __('Quantity') }} </th>
                                            <th class="text-end" style="width: 120px;">{{ __('Total') }} </th>
                                        </tr>
                                    </thead><!-- end thead -->
                                    <tbody>
                                        <tr>
                                            <th scope="row">01</th>
                                            <td>
                                                <div>
                                                    <h5 class="text-truncate font-size-14 mb-1">${data.course.name }</h5>
                                                    <p class="text-muted mb-0">${data.institute.name }</p>
                                                </div>
                                            </td>
                                            <td>$${data.amount }</td>
                                            <td>1</td>
                                            <td class="text-end">$${data.amount }</td>
                                        </tr>
                                       
                                        <tr>
                                            <th scope="row" colspan="4" class="text-end">{{ __('Sub Total') }} </th>
                                            <td class="text-end">$ ${data.amount } </td>
                                        </tr>
                                        <!-- end tr -->
                                        <tr>
                                            <th scope="row" colspan="4" class="border-0 text-end">
                                                {{ __('Discount') }}  :</th>
                                            <td class="border-0 text-end">- $${data.discount } </td>
                                        </tr>
                                       
                                        <tr>
                                            <th scope="row" colspan="4" class="border-0 text-end">
                                                {{ __('Tax') }}</th>
                                            <td class="border-0 text-end">$0</td>
                                        </tr>
                                        <!-- end tr -->
                                        <tr>
                                            <th scope="row" colspan="4" class="border-0 text-end">{{ __('Total') }}</th>
                                            <td class="border-0 text-end">
                                                <h4 class="m-0 fw-semibold">$${data.amount - data.discount }</h4>
                                            </td>
                                        </tr>
                                        <!-- end tr -->
                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div><!-- end table responsive -->
                            <div class="d-print-none mt-4">
                                <div class="float-end">
                                    <a href="javascript:window.print()" class="btn btn-success me-1"><i class="fa fa-print"></i></a>
                                    {{-- <a href="#" class="btn btn-primary w-md">Send</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                  `;
                $('#orderDetailsDiv').html(str);


            } else {

            }

        })
    }

    function profilePage(e, id) {
        var url = `{{ route('profile_institute', ':id') }}`;
        url = url.replace(':id', id);
        window.location = url;
    }
</script>
@endsection
