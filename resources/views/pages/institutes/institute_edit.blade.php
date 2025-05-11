@extends('layouts.vertical-master-layout')
@section('title')
    @if (session('page_lang') === 'en')
        Edit Institute
    @elseif (session('page_lang') === 'ar')
        تحرير المعهد
    @endif
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
            @if (session('page_lang') === 'en')
                Institute
            @elseif (session('page_lang') === 'ar')
                معهد
            @endif
        @endslot
        @slot('title')
            @if (session('page_lang') === 'en')
                Edit Institute
            @elseif (session('page_lang') === 'ar')
                تحرير المعهد
            @endif
        @endslot
    @endcomponent
@endsection
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">

                <div class="row">
                    <div class="col-md-10">
                        <h4 class="card-title">
                            @if (session('page_lang') === 'en')
                                Add Institute
                            @elseif (session('page_lang') === 'ar')
                                أضف المعهد
                            @endif

                        </h4>


                    </div>
                    <div class="col-md-2 float-right ">

                        <form action="{{ route('change_page_language') }}" method="POST">
                            @csrf
                            <select name="page_lang" onchange="this.form.submit()">
                                <option value="en" {{ session('page_lang') === 'en' ? 'selected' : '' }}>English
                                </option>
                                <option value="ar" {{ session('page_lang') === 'ar' ? 'selected' : '' }}>Arabic
                                </option>
                                <!-- Add more language options as needed -->
                            </select>
                        </form>

                    </div>
                </div>



            </div><!-- end card header -->
            <div class="card-body">
                <form id="AddFormSubmit" class="needs-validation" novalidate>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input" class="form-label">
                                    @if (session('page_lang') === 'en')
                                        Name
                                    @elseif (session('page_lang') === 'ar')
                                        الاسم
                                    @endif
                                </label>
                                <input type="text" class="form-control" name="name" id="basicpill-firstname-input"
                                    placeholder="{{ __('Name') }}"
                                    value="@if (session('page_lang') === 'en') {{ $institute->name_en }} @elseif (session('page_lang') === 'ar') {{ $institute->name_ar }} @endif">
                                <div class="text-danger" id="name">

                                </div>

                            </div>
                        </div><!-- end col -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-lastname-input" class="form-label">

                                    @if (session('page_lang') === 'en')
                                        Email
                                    @elseif (session('page_lang') === 'ar')
                                        بريد إلكتروني
                                    @endif
                                </label>
                                <input type="email" name="email" class="form-control" id="basicpill-lastname-input"
                                    placeholder="{{ __('Email') }}" value="{{ $institute->email }}">
                                <div class="text-danger" id="email">

                                </div>
                            </div>
                        </div><!-- end col -->
                    </div><!-- end row -->

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-phoneno-input" class="form-label">
                                    @if (session('page_lang') === 'en')
                                        Mobile
                                    @elseif (session('page_lang') === 'ar')
                                        متحرك
                                    @endif

                                </label>
                                <input type="text" name="mobile" class="form-control" id="basicpill-phoneno-input"
                                    placeholder="{{ __('Mobile') }}" value="{{ $institute->mobile }}">
                                <div class="text-danger" id="mobile">

                                </div>
                            </div>
                        </div><!-- end col -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-phoneno-input" class="form-label">
                                    @if (session('page_lang') === 'en')
                                        Address
                                    @elseif (session('page_lang') === 'ar')
                                        عنوان
                                    @endif

                                </label>
                                <input type="text" class="form-control" name="address" id="basicpill-phoneno-input"
                                    placeholder="{{ __('Address') }}" value="{{ $institute->address }}">
                                <div class="text-danger" id="address">

                                </div>
                            </div>
                        </div><!-- end col -->

                    </div><!-- end row -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input" class="form-label">
                                    @if (session('page_lang') === 'en')
                                        Commission
                                    @elseif (session('page_lang') === 'ar')
                                    عمولة
                                    @endif
                                </label>
                                <input type="number" class="form-control" name="admin_commission" id="basicpill-firstname-input"
                                    placeholder="{{ __('Commission') }}"
                                    value="{{ $institute->admin_commission }}">
                                <div class="text-danger" id="name">

                                </div>

                            </div>
                        </div><!-- end col -->
                    </div>


<div class="row">
    <div class="col-lg-6">
        <div class="mb-3">
            <label for="verification-document" class="form-label fw-semibold">
                @if (session('page_lang') === 'en')
                    Upload Verification Document
                @elseif (session('page_lang') === 'ar')
                    تحميل مستند التحقق
                @endif
            </label>

            <!-- File input -->
            <input type="file" class="form-control" name="document" id="verification-document" 
                   accept=".pdf, .doc, .docx, .jpg, .jpeg, .png">
            <div class="text-danger mt-1" id="verification_document_error"></div>

            <!-- Document Preview Area -->
            <div class="mt-3" id="document-preview">
                @if(!empty($institute->document))
                    @php
                        $ext = pathinfo($institute->document, PATHINFO_EXTENSION);
                    @endphp
                    @if(in_array(strtolower($ext), ['jpg', 'jpeg', 'png']))
                        <img src="{{ asset('storage/' . $institute->document) }}" 
                             alt="Uploaded Document" class="img-thumbnail" style="max-height: 150px;">
                    @else
                        <a href="{{ asset('storage/' . $institute->document) }}" 
                           target="_blank" class="btn btn-outline-primary btn-sm">
                            View Document
                        </a>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>

            </div>
            <div class="card-header">
                <h4 class="card-title">
                    @if (session('page_lang') === 'en')
                        Location
                    @elseif (session('page_lang') === 'ar')
                        موقع
                    @endif
                </h4>
            </div><!-- end card header -->
            <div class="card-body">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="choices-single-default" class="form-label font-size-13 text-muted">
                                        @if (session('page_lang') === 'en')
                                            Country
                                        @elseif (session('page_lang') === 'ar')
                                            دولة
                                        @endif
                                    </label>
                                    <div class="text-danger" id="country_id">

                                    </div>
                                    <select class="form-control" data-trigger name="country_id"
                                        id="choices-single-default" onchange="loadStates(this)">
                                        <option value="">{{ __('Please Select Country') }}</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}"
                                                @if ($institute->country_id == $country->id) selected @endif>{{ $country->name }}
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
                                    <select class="form-control" id="statesSel" name="state_id"
                                        onchange="loadCitites(this)">
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}"
                                                @if ($institute->state_id == $state->id) selected @endif>{{ $state->name }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                           {{-- <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="choices-single-default"
                                        class="form-label font-size-13 text-muted">{{ __('City') }} </label>
                                    <div class="text-danger" id="city_id">

                                    </div>
                                    <select class="form-control" id="citiesSel" name="city_id">
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}"
                                                @if ($institute->city_id == $city->id) selected @endif>{{ $city->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header justify-content-between d-flex align-items-center">

                                <h4 class="card-title">
                                    @if (session('page_lang') === 'en')
                                        Location
                                    @elseif (session('page_lang') === 'ar')
                                        موقع
                                    @endif

                            </div>
                            <div class="card-body">
                                <div id="gmaps-markers" class="gmaps"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2">

                        <button type="button" onclick="updateData(this)" class="btn btn-primary btn-rounded">
                            @if (session('page_lang') === 'en')
                                Submit
                            @elseif (session('page_lang') === 'ar')
                                يُقدِّم
                            @endif
                        </button>
                    </div>




                </div>
                </form><!-- end form -->
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
<script src="{{ URL::asset('https://maps.google.com/maps/api/js?key=AIzaSyCtSAR45TFgZjOs4nBFFZnII-6mMHLfSYI') }}">
</script>
<!-- Gmaps file -->
<script src="{{ URL::asset('assets/libs/gmaps/gmaps.min.js') }}"></script>

<script>
    //Success Message
    var lat_s = 0;
    var lng_s = 0;


    function updateData(e) {

        var windowurl = window.location.href;
        windowurl = windowurl.split('?');
        var parts = windowurl[0].split('/');
        var inst_id = parts[parts.length - 1];




        var formData = new FormData($("#AddFormSubmit")[0]);
        var apiBase = `{{ url('/') }}`;
        apiBase += '/api/';


        var updateURL = `${apiBase}institutes/${inst_id}`


        var country_id = $('select[name=country_id]').val();
        var city_id = $('select[name=city_id]').val();
        var state_id = $('select[name=state_id]').val();;
        var page_lang = `{{ session('page_lang') }}`
        formData.append('lang', page_lang);
        formData.append('adminRequest', 1);
        formData.append('state_id', state_id);
        formData.append('country_id', country_id);
        formData.append('city_id', city_id);
        formData.append('longitute', window.lat_s);
        formData.append('latitute', window.lng_s);
        formData.append('_method', 'PUT');

           // Append the uploaded file to FormData
           var verificationDocument = $('#verification-document')[0].files[0];

            if (verificationDocument) {
                formData.append('document', verificationDocument);
            }

            console.log(formData,"formDataformDataformDataformData");
            

        $.ajax({
            url: updateURL,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,

            success: function(res) {
                console.log(res)
                if (res['code'] == 200) {
                    alert(res.message);
                    window.location = `{{ route('all_institutes', ['lang' => app()->getLocale()]) }}`;
                    return;
                } else {
                    alert(res.message);
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

    function loadStates(e, id) {

        console.log("caling fun", id)
        var apiBase = `{{ url('/') }}`;
        apiBase += '/api/';
        var statesURL = `${apiBase}states`;
        var value = "";
        if (id != undefined) {

            value = id
        } else {
            value = e.value

        }
        var sel = $('#statesSel');
        console.log(sel[0])
        var str = ``;

        var obj = {
            "country_id": value
        }


        console.log(obj, " This is obj man   ")

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


    document.getElementById('verification-document').addEventListener('change', function (event) {
    const preview = document.getElementById('document-preview');
    const file = event.target.files[0];
    preview.innerHTML = ''; // Clear current preview

    if (file) {
        const fileType = file.type;

        if (fileType.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'img-thumbnail';
                img.style.maxHeight = '150px';
                preview.appendChild(img);
            };
            reader.readAsDataURL(file);
        } else {
            const fileInfo = document.createElement('div');
            fileInfo.innerHTML = `<span class="text-secondary"><strong>Selected File:</strong> ${file.name}</span>`;
            preview.appendChild(fileInfo);
        }
    }
});
</script>
@endsection
