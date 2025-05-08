@extends('layouts.vertical-master-layout')
@section('title')
    {{ __('Personal Information') }}
@endsection
@section('css')
    <!-- plugin css -->
    <link href="{{ URL::asset('assets/libs/choices.js/choices.js.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">

    <!-- One of the following themes -->
    <link href="{{ URL::asset('assets/libs/@simonwep/@simonwep.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/libs/@simonwep/@simonwep.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/libs/@simonwep/@simonwep.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    {{-- breadcrumbs  --}}
@section('breadcrumb')
    @component('components.breadcrumb')
        @slot('li_1')
            {{ __('Personal Details ') }}
        @endslot
        @slot('title')
            {{ __('Details') }}
        @endslot
    @endcomponent
@endsection
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ __('Personal Information') }} </h4>

                <button type="button" class="btn btn-primary btn-sm" id="sa-success" hidden>Click me</button>

            </div><!-- end card header -->
            <div class="card-body">
                <form id="AddFormSubmit" class="needs-validation" novalidate>


                    <div class="row">

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input" class="form-label">
                                    {{ __('Address') }} </label>
                                <input type="text" class="form-control" name="amount" id="address"
                                    placeholder="Address">

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input" class="form-label">
                                    {{ __('Tax Percentage') }} </label>
                                <input type="text" class="form-control" name="amount" id="tax_percentage"
                                    placeholder="Address">

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3 d-flex flex-column ">

                                <label for="basicpill-firstname-input" class="form-label">
                                    {{ __('Institute Approval') }} </label>
                                <input type="checkbox" id="institute_approval" switch="none" checked />
                                <label for="institute_approval" data-on-label="Yes" data-off-label="No"
                                    class="mb-0"></label>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3 d-flex flex-column ">

                                <label for="basicpill-firstname-input" class="form-label">
                                    {{ __('Course Approval') }} </label>
                                <input type="checkbox" id="course_approval" switch="none" checked />
                                <label for="course_approval" data-on-label="Yes" data-off-label="No"
                                    class="mb-0"></label>

                            </div>
                        </div>


                    </div>
                    <div class="row">
                        <div class="col-lg-2">

                            <button type="button" onclick="updateSettings(this)"
                                class="btn btn-primary btn-rounded">{{ __('Update') }} </button>
                        </div>

                    </div>


            </div>

        </div>
    </div><!-- end col -->
</div><!-- end row -->

@endsection

@section('script')
<script src="{{ URL::asset('assets/js/app.js') }}"></script>
<!-- plugins -->
<script src="{{ URL::asset('assets/libs/choices.js/choices.js.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>

<!-- Modern colorpicker bundle -->
<script src="{{ URL::asset('assets/libs/@simonwep/@simonwep.min.js') }}"></script>

<!-- init js -->
{{-- <script src="{{ URL::asset('assets/js/pages/form-advanced.init.js') }}"></script> --}}

<!-- Sweet Alerts js -->
<script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/form-validation.init.js') }}"></script>


<script>


    function markSwith(id, value) {
        if (value == "enabled") {
            $(`#${id}`).prop("checked", true);
        } else {
            $(`#${id}`).prop("checked", false);

        }
    }

    function loadSettings() {

        var apiBase = `{{ url('/') }}`;
        apiBase += '/api/'
        var settingsURL = `${apiBase}settings`;

        var obj = {
            "address": "",
            "institute_approval": "",
            "course_approval": "",
            "tax_percentage": ""
        }

        $.post(settingsURL, obj, (res) => {

            if (res.code == 200) {

                var data = res.data
                data.map((val) => {
                    var id = val['label'];
                    if (id == "institute_approval" || id=="course_approval") {
                        markSwith(id, val['value']);
                    }

                    $(`#${id}`).val(val['value']);
                })

            } else {
                alert(res.message)
            }



        })

    }

    loadSettings();

    function updateSettings(e) {


        var apiBase = `{{ url('/') }}`;

        apiBase = apiBase + '/api/';

        var url = `${apiBase}settings/update`;
        var address = $('#address').val();
        var tax_percentage = $('#tax_percentage').val();
        
        var instCheck = $('#institute_approval').prop('checked');
        var institute_approval= instCheck ? "enabled": "disabled";


            
        var courseCheck = $('#course_approval').prop('checked');
        var course_approval= courseCheck ? "enabled": "disabled";

        var obj = {
            address,
            tax_percentage,
            institute_approval,
            course_approval
        }


        console.log(" Uodate iobh ddf ")
        console.log(obj)

        $.post(url, obj, (res) => {

            alert(res.message);

        })

    }
</script>
@endsection
