@extends('layouts.vertical-master-layout')
@section('title')Pricing Table @endsection
@section('content')
{{-- breadcrumbs  --}}
    @section('breadcrumb')
        @component('components.breadcrumb')
            @slot('li_1') Pricing @endslot
            @slot('title') Pricing Table @endslot
        @endcomponent
    @endsection
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="table-responsive text-center">
                <table class="table table-bordered mb-0 table-centered align-middle">

                    <tbody>
                        <tr>
                            <td></td>
                            <td style="width: 20%;">
                                <div class="py-3">
                                    <h5 class="font-size-16">Starter</h5>
                                    <p class="text-muted mb-4">Neque porro quisquam est</p>
                                    <h2><sup><small>$</small></sup> 9.99 / <span class="font-size-13 text-muted">Per month</span></h2>
                                    <div class="mt-4">
                                        <a href="#" class="btn btn-primary btn-sm">Get started</a>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 20%;">

                                <div class="py-3">
                                    <h5 class="font-size-16">Professional</h5>
                                    <p class="text-muted mb-4">Et quidem rerum facilis est</p>
                                    <h2><sup><small>$</small></sup> 29.99 / <span class="font-size-13 text-muted">Per month</span></h2>
                                    <div class="mt-4">
                                        <a href="#" class="btn btn-primary btn-sm">Get started</a>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 20%;" class="position-relative overflow-hidden">
                                <div class="ribbon bg-success">40% off Sale</div>
                                <div class="py-3">
                                    <h5 class="font-size-16">Enterprise</h5>
                                    <p class="text-muted mb-4">Quis autem vel eum iure</p>
                                    <h2><sup><small>$</small></sup> 59.00 / <span class="font-size-13 text-muted">Per month</span></h2>
                                    <div class="mt-4">
                                        <a href="#" class="btn btn-primary btn-sm">Get started</a>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 20%;">
                                <div class="py-3">
                                    <h5 class="font-size-16">Unlimited</h5>
                                    <p class="text-muted mb-4">Sed ut perspiciatis unde</p>
                                    <h2><sup><small>$</small></sup> 79.00 / <span class="font-size-13 text-muted">Per month</span></h2>
                                    <div class="mt-4">
                                        <a href="#" class="btn btn-primary btn-sm">Get started</a>
                                    </div>
                                </div>
                            </td>
                        </tr><!-- end tr -->
                        <tr>
                            <th scope="row">Users</th>
                            <td>1</td>
                            <td>3</td>
                            <td>5</td>
                            <td>7</td>
                        </tr>
                        <tr>
                            <th scope="row">Storage</th>
                            <td>1 GB</td>
                            <td>10 GB</td>
                            <td>20 GB</td>
                            <td>40 GB</td>
                        </tr>
                        <tr>
                            <th scope="row">Domain</th>
                            <td>
                                <div>
                                    <i class="uil uil-times-circle text-danger font-size-20"></i>
                                </div>
                            </td>
                            <td>1</td>
                            <td>2</td>
                            <td>4</td>
                        </tr><!-- end tr -->
                        <tr>
                            <th scope="row">Support</th>
                            <td>
                                <div>
                                    <i class="uil uil-times-circle text-danger font-size-20"></i>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <i class="uil uil-check-circle text-success font-size-20"></i>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <i class="uil uil-check-circle text-success font-size-20"></i>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <i class="uil uil-check-circle text-success font-size-20"></i>
                                </div>
                            </td>
                        </tr><!-- end tr -->
                        <tr>
                            <th scope="row">Update</th>
                            <td>
                                <div>
                                    <i class="uil uil-times-circle text-danger font-size-20"></i>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <i class="uil uil-times-circle text-danger font-size-20"></i>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <i class="uil uil-check-circle text-success font-size-20"></i>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <i class="uil uil-check-circle text-success font-size-20"></i>
                                </div>
                            </td>
                        </tr><!-- end tr -->
                    </tbody><!-- end tbody -->
                </table><!-- end table -->
            </div><!-- end table responsive -->
        </div><!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->

@endsection
@section('script')

<script src="{{ URL::asset('assets/js/app.js') }}"></script>

@endsection
