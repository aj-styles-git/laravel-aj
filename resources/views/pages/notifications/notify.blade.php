@extends('layouts.vertical-master-layout')
@section('title')
    {{ __('Push Notifications') }}
@endsection
@section('css')
    <!-- plugin css -->

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
            {{ __('Push Notifications ') }}
        @endslot
        @slot('title')
            {{ __('Notifications') }}
        @endslot
    @endcomponent
@endsection
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ __('Notifications') }} </h4>

                <button type="button" class="btn btn-primary btn-sm" id="sa-success" hidden>Click me</button>

            </div><!-- end card header -->
            <div class="card-body">
                <form id="AddFormSubmit">


                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="choices-single-default"
                                    class="form-label font-size-13 text-muted">{{ __('Type') }}</label>
                                <div class="text-danger" id="country_id">

                                </div> 
                                <select class="form-control" data-trigger name="type"
                                    id="type" >
                                    <option value="" disabled>{{ __('Please Select Type') }} </option>
                                    <option value="1" selected> Institute</option>
                                    <option value="2" > Students </option>
                                    <option value="3"> Both </option>

                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">

                        </div>

                        <div class="row mt-4">
                            <div class="col-lg-6 ">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input" class="form-label">
                                        {{ __(' Title(English)') }} </label>
                                    <input type="text" class="form-control" name="title_en" id="address"
                                        placeholder="Title">

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input" class="form-label">
                                        {{ __('Message (English)') }} </label>
                                    <input type="text" class="form-control" name="message_en" id="address"
                                        placeholder="Message">

                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input" class="form-label">
                                        {{ __('Title(Arabic)') }} </label>
                                    <input type="text" class="form-control" name="title_ar" id="address"
                                        placeholder="Title">

                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input" class="form-label">
                                        {{ __('Message (Arabic)') }} </label>
                                    <input type="text" class="form-control" name="message_ar" id="address"
                                        placeholder="Message">

                                </div>
                            </div>
                        </div>



                    </div>
                    <div class="row">
                        <div class="col-lg-2">

                            <button type="button" onclick="sendPushNotifications(this)"
                                class="btn btn-primary btn-rounded">{{ __('Send') }} </button>
                        </div>

                    </div>


            </div>

        </div>
    </div><!-- end col -->
</div><!-- end row -->

@endsection

@section('script')
<script src="{{ URL::asset('assets/js/app.js') }}"></script>











<script>
    var apiBase = `{{ url('/') }}`;

    apiBase += '/api/'

    var sendPushURL = `${apiBase}send_push_notifications`;


    function sendPushNotifications(e) {

        e.disabled=true; 

        var type = $('#type').val();
        var title_en = $('input[name=title_en]').val();
        var title_ar= $('input[name=title_ar]').val();
        var message_en = $('input[name=message_en]').val();
        var message_ar = $('input[name=message_ar]').val();

        let obj = {
            type,
            title_en,
            title_ar,
            message_ar,
            message_en

        };
    
        $.post(sendPushURL,obj , (res) => {
            if(res.code==200){
                alert(res.message)
                $("#AddFormSubmit")[0].reset();
                e.disabled=false; 

            }else{
                alert(res.message)
                e.disabled=false; 

            }
        })

    }
</script>
@endsection
