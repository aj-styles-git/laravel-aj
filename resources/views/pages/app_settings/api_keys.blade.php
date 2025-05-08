@extends('layouts.vertical-master-layout')
@section('title')
    {{ __('API Keys') }}
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
            {{ __('API Keys') }}
        @endslot
        @slot('title')
            {{ __('Keys') }}
        @endslot
    @endcomponent
@endsection
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ __('API Keys') }} </h4>

                <button type="button" class="btn btn-primary btn-sm" id="sa-success" hidden>Click me</button>

            </div><!-- end card header -->
            <div class="card-body">
                <form id="AddFormSubmit" class="needs-validation" novalidate>


                    <div class="row">

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input" class="form-label">
                                    {{ __('Google Map Key') }} </label>
                                <input type="text" class="form-control" name="amount" id="google_map_key"
                                    placeholder="Google Map Key">

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input" class="form-label">
                                    {{ __('Unifonic Key') }} </label>
                                <input type="text" class="form-control" name="amount" id="unifonic"
                                    placeholder="Unifonic Key">

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
    function loadSettings() {

        var apiBase = `{{ url('/') }}`;
        apiBase += '/api/'
        var settingsURL = `${apiBase}settings`;

        var obj = {
            "google_map_key": "",
            "unifonic": ""
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
        var google_map_key = $('#google_map_key').val();
        var unifonic = $('#unifonic').val();
        var obj = {
            google_map_key,
            unifonic
        }


        $.post(url, obj, (res) => {

            alert(res.message);

        })

    }
</script>
@endsection
