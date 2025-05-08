@extends('layouts.vertical-master-layout')
@section('title')
    {{ __('Coupons') }}
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
            {{ __('Coupons') }}
        @endslot
        @slot('title')
            {{ __('Add Coupon') }}
        @endslot
    @endcomponent
@endsection
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ __('Generate Coupons') }} </h4>

                <button type="button" class="btn btn-primary btn-sm" id="sa-success" hidden>Click me</button>

            </div><!-- end card header -->
            <div class="card-body">
                <form id="AddFormSubmit" class="needs-validation" novalidate>


                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input" class="form-label">
                                    {{ __('Code') }} </label>
                                <input type="text" class="form-control" name="code" id="basicpill-firstname-input"
                                    placeholder="Ex :- GET100 " >
                                <div class="text-danger" id="name">

                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="choices-single-default" class="form-label font-size-13 text-muted">{{ __('Select Type') }} </label>
                                <div class="text-danger" id="country_id">

                                </div>
                                <select class="form-control" data-trigger name="type">
                                    <option value="">{{ __('Please Select Type') }}</option>
                                    <option value="1" > {{ __('Flat Discount') }}</option>
                                    <option value="0" >{{ __('In Percentage') }}</option>


                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input" class="form-label">
                                    {{ __('Amount/Percentage') }} </label>
                                <input type="text" class="form-control" name="amount" id="basicpill-firstname-input"
                                    placeholder="Percentage or Amount  " >
                                <div class="text-danger" id="name">

                                </div>

                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="choices-single-default" class="form-label font-size-13 text-muted">{{ __('Select Institute') }} </label>
                                <div class="text-danger" id="country_id">

                                </div>
                                <select class="form-control" data-trigger name="institute_id"
                                    onchange="loadCourses(this)">
                                    <option value="0" >{{ __('All Institutes') }}</option>

                                    @foreach ($institutes as $institute)
                                        <option value="{{ $institute->id }}" >{{ $institute->name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="choices-single-default" class="form-label font-size-13 text-muted">{{ __('Select Course') }} </label>
                                <div class="text-danger">

                                </div>
                                <select class="form-control" name="course_id" id="course_dd">
                                    <option value="0">{{ __('All Courses') }}</option>
                                    {{-- @foreach ($institutes as $institute)
                                        <option value="{{ $institute->id }}">{{ $institute->name  }}
                                        </option>
                                    @endforeach --}}

                                </select>
                            </div>
                        </div>

                        {{-- <div class="col-lg-6 p-1">
                            <label for="basicpill-phoneno-input" class="form-label">Publish </label>

                            <div class="square-switch">

                                <input type="checkbox" id="square-switch1" switch="none" checked />
                                <label for="square-switch1" data-on-label="Off" data-off-label="No"
                                    class="mb-0"></label>
                            </div>
                        </div><!-- end col --> --}}

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input" class="form-label">
                                    {{ __('Max User Limit') }} </label>
                                <input type="text" class="form-control" name="max_usage" id="basicpill-firstname-input"
                                    placeholder="{{ __('Max User Limit') }}" >
                                <div class="text-danger" id="max_usage">

                                </div>

                            </div>
                        </div>

                        <div class="col-lg-6 p-1">
                            <div class="mb-3">
                                <label class="form-label">{{ __('Start Date') }} </label>
                                <input type="text" class="form-control" id="start_date">
                            </div>
                        </div>
                        <div class="col-lg-6 p-1">
                            <div class="mb-3">
                                <label class="form-label">{{ __('End Date') }} </label>
                                <input type="text" class="form-control" id="end_date">
                            </div>
                        </div>

                    </div><!-- end row -->
                    <div class="row">
                        <div class="col-lg-2">

                            <button type="button" onclick="addData(this)" class="btn btn-primary btn-rounded">{{ __('Submit') }}
                            </button>
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
    flatpickr('#start_date', {
        enableTime: true,
        dateFormat: "m-d-Y H:i"
    });


    flatpickr('#end_date', {
        enableTime: true,
        dateFormat: "m-d-Y H:i"
    });


    var apiBase = `{{ url('/') }}`;

    apiBase += '/api/'

    function loadCourses(e) {
        var id = $(e).val()
        course_dd = document.getElementById('course_dd');



        $.ajax({
            url: `${apiBase}institutes/${id}/courses`, // Replace with your API endpoint URL
            type: 'GET',

            success: function(res) {
                var str = `    <option value="0">All Courses</option>`;
                var data = res.data

                data.map((val) => {

                    str = str + `<option value="${val['course_id']}"    > ${val['name']}</option>`
                })

                course_dd.innerHTML = str;

            }

        });

    }


    //Success Message
    document.getElementById("sa-success").addEventListener("click", function() {
        Swal.fire({
            title: 'Good job!',
            text: 'Data Added Successfully',
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#776acf',
            cancelButtonColor: "#f34e4e"
        })
    });

    function addData(e) {
        var formData = new FormData($("#AddFormSubmit")[0]); // Create a new FormData object

        var apiBase = `{{ url('/') }}`;
        apiBase += '/api/'


        var institute_id = $('select[name=institute_id]').val();
        var course_id = $('select[name=course_id]').val();
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        formData.append('institute_id', institute_id);
        formData.append('course_id', course_id);
        formData.append('start_date', start_date);
        formData.append('end_date', end_date);


        var URL= `${apiBase}coupons`

        $.ajax({
            url: URL, // Replace with your API endpoint URL
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(res) {
                console.log(res)
                if (res['code'] == 200) {
                    $("#AddFormSubmit")[0].reset()
                    $('#sa-success').trigger('click');
                    window.location=`{{ route('all_coupons',["lang"=>app()->getLocale()]) }}`
                    return 
                }

                if (res['code'] == 500) {
                    if (res.errors != undefined && res.errors) {
                        var [
                            [firstKey, firstValue]
                        ] = Object.entries(res.errors);
                        loader(firstValue)
                        alert(firstValue)

                    } else {
                        alert(res.message)
                        loader(res.message)

                    }

                }

            }

        });
    }

</script>
@endsection
