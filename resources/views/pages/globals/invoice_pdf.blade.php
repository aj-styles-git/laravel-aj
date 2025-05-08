<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- swiper css -->
    <link href="{{ URL::asset('assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ URL::asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />



</head>

<body>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="invoice-title">
                        <h4 class="float-end font-size-15">Invoice #DW_{{ $order_details['transection_id'] }} <span
                                class="badge bg-success font-size-12 ms-2">Paid</span></h4>
                        <div class="mb-4">
                            <img src="{{ URL::asset('assets/images/dawrat_logo.png') }}" alt="logo" height="28" />
                        </div>
                        <div class="text-muted">
                            <p class="mb-1">{{ $address }}</p>
                            <p class="mb-1"><i class="uil uil-envelope-alt me-1"></i> {{ $email }}</p>
                            <p><i class="uil uil-phone me-1"></i> {{ $phone }}</p>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="text-muted">
                                <h5 class="font-size-16 mb-3">Billed To:</h5>
                                <h5 class="font-size-15 mb-2">{{ $order_details['student']['name'] }}</h5>
                                <p class="mb-1">{{ $order_details['student']['address'] }}</p>
                                <p class="mb-1">{{ $order_details['student']['email'] }}</p>
                                <p>{{ $order_details['student']['phone'] }}</p>
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-sm-6">
                            <div class="text-muted text-sm-end">
                                
                                <div class="mt-4">
                                    <h5 class="font-size-15 mb-1">Invoice Date:</h5>
                                    <p>{{  $order_details['created_at']}} </p>
                                </div>
                                <div class="mt-4">
                                    <h5 class="font-size-15 mb-1">Order No:</h5>
                                    <p>#{{  $order_details['id']}} </p>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="py-2">
                        <h5 class="font-size-15">Order Summary</h5>

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
                                                <h5 class="text-truncate font-size-14 mb-1">{{ $order_details['course']['name'] }}</h5>
                                                <p class="text-muted mb-0"> {{ $order_details['institute']['name'] }} </p>
                                            </div>
                                        </td>
                                        <td> ${{ $order_details['amount'] }}  </td>
                                        <td>1</td>
                                        <td class="text-end">${{ $order_details['amount'] }} </td>
                                    </tr>
                                   
                                    <tr>
                                        <th scope="row" colspan="4" class="text-end">{{ __('Sub Total') }} </th>
                                        <td class="text-end">${{ $order_details['amount'] }}  </td>
                                    </tr>
                                    <!-- end tr -->
                                    <tr>
                                        <th scope="row" colspan="4" class="border-0 text-end">
                                            {{ __('Discount') }}  :</th>
                                        <td class="border-0 text-end">-${{ $order_details['discount'] }}  </td>
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
                                            <h4 class="m-0 fw-semibold">${{ $order_details['amount'] - $order_details['discount'] }} </h4>
                                        </td>
                                    </tr>
                                    <!-- end tr -->
                                </tbody><!-- end tbody -->
                            </table><!-- end table -->
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
