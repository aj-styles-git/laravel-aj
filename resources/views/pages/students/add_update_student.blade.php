@extends('layouts.vertical-master-layout')
@section('title')
    {{ __('Add Student') }}
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
            {{ __('Students') }}
        @endslot
        @slot('title')
            {{ __('Add Student') }}
        @endslot
    @endcomponent
@endsection
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                {{ __('Add Student') }}
                <h4 class="card-title"> </h4>

                <button type="button" class="btn btn-primary btn-sm" id="sa-success" hidden>Click me</button>

            </div><!-- end card header -->
            <div class="card-body">
                <form id="AddFormSubmit" class="needs-validation" novalidate>


                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input" class="form-label">
                                    {{ __('Name') }}
                                </label>
                                <input type="text" class="form-control" name="name" id="basicpill-firstname-input"
                                    placeholder="Student  Name">
                                <div class="text-danger" id="name">

                                </div>

                            </div>
                        </div><!-- end col -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-lastname-input" class="form-label">
                                    {{ __('Email') }}
                                </label>
                                <input type="email" name="email" class="form-control" id="basicpill-lastname-input"
                                    placeholder="Email">
                                <div class="text-danger" id="email">

                                </div>
                            </div>
                        </div><!-- end col -->
                    </div><!-- end row -->

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-phoneno-input" class="form-label"> {{ __('Mobile') }} </label>
                                <input type="text" name="mobile" class="form-control" id="basicpill-phoneno-input"
                                    placeholder="Mobile ">
                                <div class="text-danger" id="mobile">

                                </div>
                            </div>
                        </div><!-- end col -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-phoneno-input" class="form-label"> {{ __('Address') }} </label>
                                <input type="text" class="form-control" name="address" id="basicpill-phoneno-input"
                                    placeholder="Address">
                                <div class="text-danger" id="address">

                                </div>
                            </div>
                        </div><!-- end col -->

                    </div><!-- end row -->

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-phoneno-input" class="form-label"> {{ __('Password') }} </label>
                                <input type="password" class="form-control" id="basicpill-phoneno-input"
                                    placeholder="Password " name="password">
                                <div class="text-danger" id="password">

                                </div>
                            </div>
                        </div><!-- end col -->

                        <!-- Birthday -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="birthday" class="form-label">{{ __('Birthday') }}</label>
                                <input type="date" class="form-control" id="birthday" name="birthday"
                                    value="{{ old('birthday', $student->birthday ?? '') }}">
                                <div class="text-danger" id="birthday-error"></div>
                            </div>
                        </div><!-- end col -->

                    </div><!-- end row -->


                    <!--  Gender -->
                    <div class="row">
                        <!-- Gender -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="gender" class="form-label">{{ __('Gender') }}</label>
                                <select class="form-control" id="gender" name="gender">
                                    <option value="">{{ __('Select Gender') }}</option>
                                    <option value="male" {{ old('gender', $student->gender ?? '') == 'male' ? 'selected' : '' }}>{{ __('Male') }}</option>
                                    <option value="female" {{ old('gender', $student->gender ?? '') == 'female' ? 'selected' : '' }}>{{ __('Female') }}</option>
                                    <option value="other" {{ old('gender', $student->gender ?? '') == 'other' ? 'selected' : '' }}>{{ __('Other') }}</option>
                                </select>
                                <div class="text-danger" id="gender-error"></div>
                            </div>
                        </div><!-- end col -->
                    </div><!-- end row -->

            </div>
            {{-- <div class="card-header">
                <h4 class="card-title"> {{ __('Location') }} </h4>
            </div><!-- end card header --> --}}
            {{-- <div class="card-body">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="choices-single-default" class="form-label font-size-13 text-muted">
                                        {{ __('Country') }} </label>
                                    <div class="text-danger" id="country_id">

                                    </div>
                                    <select class="form-control" data-trigger name="country_id"
                                        id="choices-single-default" onchange="loadStates(this)" >
                                        <option value="">Please Select Country </option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                           
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="choices-single-default"
                                        class="form-label font-size-13 text-muted">{{ __('State') }}</label>
                                    <div class="text-danger" id="state_id">

                                    </div>
                                    <select class="form-control"  id="statesSel" name="state_id" onchange="loadCitites(this)">

                                    
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="choices-single-default"
                                        class="form-label font-size-13 text-muted">{{ __('City') }} </label>
                                    <div class="text-danger" id="city_id">

                                    </div>
                                    <select class="form-control"  id="citiesSel"
                                        name="city_id">
                                        
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header justify-content-between d-flex align-items-center">
                                <h4 class="card-title">Location</h4>
                                
                            </div><!-- end card header -->
                            <div class="card-body">
                                <div id="gmaps-markers" class="gmaps"></div>
                            </div>
                        </div><!-- end card -->
                    </div>
                </div>
                
                </form><!-- end form -->
            </div> --}}

            <div class="row">
                <div class="col-lg-2">

                    <button type="button" onclick="addData(this)" class="btn btn-primary btn-rounded">Submit
                    </button>
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
<script src="{{ URL::asset('assets/js/pages/form-advanced.init.js') }}"></script>

<!-- Sweet Alerts js -->
<script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/form-validation.init.js') }}"></script>
<!-- google maps api -->
<script src="{{ URL::asset('https://maps.google.com/maps/api/js?key=AIzaSyD36g3uFucGR8zRji_QgoqsM0cYRNYFE7k') }}">
</script>
<!-- Gmaps file -->
<script src="{{ URL::asset('assets/libs/gmaps/gmaps.min.js') }}"></script>
<script>
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
        apiBase += '/api/';



        var country_id = $('select[name=country_id]').val();
        var city_id = $('select[name=city_id]').val();
        var state_id = $('select[name=state_id]').val();;
        formData.append('lang', 'en');
        formData.append('adminRequest', '1');
        formData.append('state_id', state_id);
        formData.append('country_id', country_id);
        formData.append('city_id', city_id);
        formData.append('longitude', '0');
        formData.append('latitude', '0');;

        $.ajax({
            url: `${apiBase}students`, // Replace with your API endpoint URL
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,

            success: function(res) {
                if (res['code'] == 200) {
                    $("#AddFormSubmit")[0].reset()
                    $('#sa-success').trigger('click');
                }

                if (res['code'] == 500) {
                    var errors = res['errors']
                    $(`.text-danger`).text('')
                    for (err in errors) {

                        $(`#${err}`).text(errors[err][0])
                    }

                }

            }

        });
    }


    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            alert(" Please enable location ")
        }
    }

    function showPosition(position) {

        // Markers
        var lat = position.coords.latitude
        var lng = position.coords.longitude
        window.lat_s = lat
        window.lng_s = lng
        var map;
        map = new GMaps({
            div: '#gmaps-markers',
            lat: lat,
            lng: lng
        });
        map.addMarker({
            lat: lat,
            lng: lng,
            title: 'Location',
            details: {
                database_id: 42,
                author: 'HPNeo'
            },

        });


    }

    getLocation();

    function loadStates(e) {
        var apiBase = `{{ url('/') }}`;
        apiBase += '/api/';
        var statesURL = `${apiBase}states`;
        var sel = $('#statesSel');
        console.log(sel[0])
        var str = ``;

        var obj = {
            "country_id": e.value
        }

        $.post(statesURL, obj, (res) => {

            if (res.code == 200) {
                console.log(res.data, " entering in the 200 ")
                res.data.map((val) => {

                    console.log(val)
                    str += `<option value="${val.id }"> ${val.name }</option>`

                })
            }
            console.log(str)
            sel[0].innerHTML = str
        })

    }

    function loadCitites(e) {
        var apiBase = `{{ url('/') }}`;
        apiBase += '/api/';
        var citiesURL = `${apiBase}cities`;
        var sel = $('#citiesSel');
        var str = ``;

        var obj = {
            "state_id": e.value
        }

        $.post(citiesURL, obj, (res) => {

            if (res.code == 200) {
                res.data.map((val) => {
                    console.log(val)
                    str += `<option value="${val.id }" > ${val.name }</option>`

                })
            }
            sel[0].innerHTML = str
        })

    }
</script>
@endsection
