@extends('layouts.master')
@section('title')Notifications @endsection
@section('css')

<!-- alertifyjs Css -->
<link href="{{ URL::asset('assets/libs/alertifyjs/alertifyjs.min.css') }}" rel="stylesheet">

<!-- alertifyjs default themes  Css -->
<link href="{{ URL::asset('assets/libs/alertifyjs/default.min.css') }}" rel="stylesheet">

@endsection
@section('content')
{{-- breadcrumbs  --}}
    @section('breadcrumb')
        @component('components.breadcrumb')
            @slot('li_1') Extended UI @endslot
            @slot('title') Notifications @endslot
        @endcomponent
    @endsection
<div class="row">

    <div class="col-xl-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Default Notifications</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <tbody>
                            <tr>
                                <td>Default alert</td>
                                <td class="text-end"><a href="javascript: void(0);" id="alert-message" class="btn btn-primary btn-sm">Click me</a></td>
                            </tr>
                            <tr>
                                <td>Success alert</td>
                                <td class="text-end"><a href="javascript: void(0);" id="alert-success" class="btn btn-primary btn-sm">Click me</a></td>
                            </tr>
                            <tr>
                                <td>Error alert</td>
                                <td class="text-end"><a href="javascript: void(0);" id="alert-error" class="btn btn-primary btn-sm">Click me</a></td>
                            </tr>
                            <tr>
                                <td>Warning alert</td>
                                <td class="text-end"><a href="javascript: void(0);" id="alert-warning" class="btn btn-primary btn-sm">Click me</a></td>
                            </tr>
                        </tbody><!-- end tbody -->
                    </table><!-- end table -->
                </div><!-- end table responsive -->
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->

    <div class="col-xl-6">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Default Dialogs</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <tbody>
                            <tr>
                                <td>Alert</td>
                                <td class="text-end"><a href="javascript: void(0);" id="alert" class="btn btn-primary btn-sm">Click me</a></td>
                            </tr>
                            <tr>
                                <td>Confirm</td>
                                <td class="text-end"><a href="javascript: void(0);" id="alert-confirm" class="btn btn-primary btn-sm">Click me</a></td>
                            </tr>
                            <tr>
                                <td>Prompt</td>
                                <td class="text-end"><a href="javascript: void(0);" id="alert-prompt" class="btn btn-primary btn-sm">Click me</a></td>
                            </tr>
                        </tbody><!-- end tbody -->
                    </table><!-- end table -->
                </div><!-- end table responsive -->
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->

@endsection
@section('script')

<!-- alertifyjs js -->
<script src="{{ URL::asset('assets/libs/alertifyjs/alertifyjs.min.js') }}"></script>
<!-- notification init -->
<script src="{{ URL::asset('assets/js/pages/notification.init.js') }}"></script>
<script src="{{ URL::asset('assets/js/app.js') }}"></script>

@endsection
