@extends('layouts.vertical-master-layout')
@section('title')
    Coupons
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
            {{ __('Commission') }}
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
                <h4 class="card-title">{{ __('Commission') }} </h4>

                <button type="button" class="btn btn-primary btn-sm" id="sa-success" hidden>Click me</button>

            </div><!-- end card header -->
            <div class="card-body">
                <form id="AddFormSubmit" class="needs-validation" novalidate>


                    <div class="row">

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="choices-single-default" class="form-label font-size-13 text-muted">Select
                                    Type </label>
                                <div class="text-danger" id="country_id">

                                </div>
                                <select class="form-control" data-trigger id="global_commission_type">
                                    <option value="" disabled>{{ __('Please Select Type') }}</option>
                                    <option value="flat">{{ __('Flat') }} </option>
                                    <option value="percentage"> {{ __('Percentage') }}</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input" class="form-label">
                                    {{ __('Amount/Percentage') }} </label>
                                <input type="text" class="form-control" name="amount"
                                    placeholder="Percentage or Amount  " id="global_commission">
                                <div class="text-danger" id="name">

                                </div>

                            </div>
                        </div>


                    </div>
                    <div class="row">
                        <div class="col-lg-2">

                            <button type="button" onclick="updateSettings(this)"
                                class="btn btn-primary btn-rounded">{{ __('Submit') }} </button>
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
    function loadSettings() {

        var apiBase = `{{ url('/') }}`;
        apiBase += '/api/'
        var settingsURL = `${apiBase}settings`;

        var obj = {
            "global_commission_type": "",
            "global_commission": ""
        }

        $.post(settingsURL, obj, (res) => {

            if (res.code == 200) {

                var data = res.data
                data.map((val) => {
                    var id = val['label'];
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
        var global_commission = $('#global_commission').val();
        var global_commission_type = $('#global_commission_type').val();
        var obj = {
            global_commission,
            global_commission_type
        }


        $.post(url, obj, (res) => {

            $("#AddFormSubmit").get(0).reset();

            alert(res.message);


        })

    }
</script>
@endsection
