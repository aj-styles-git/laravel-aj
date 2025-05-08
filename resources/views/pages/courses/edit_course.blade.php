@extends('layouts.vertical-master-layout')
@section('title')
    @if (session('page_lang') === 'en')
        Edit Course
    @elseif (session('page_lang') === 'ar')
        تحرير الدورة
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
                Courses
            @elseif (session('page_lang') === 'ar')
                الدورات
            @endif
        @endslot
        @slot('title')
            @if (session('page_lang') === 'en')
                Edit Course
            @elseif (session('page_lang') === 'ar')
                تحرير الدورة
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
                                Edit Course
                            @elseif (session('page_lang') === 'ar')
                                تحرير الدورة
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
                                    placeholder="" value="{{ $course->name ?? "" }}">
                                <div class="text-danger" id="name">

                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input" class="form-label">

                                    @if (session('page_lang') === 'en')
                                        Title
                                    @elseif (session('page_lang') === 'ar')
                                        عنوان
                                    @endif
                                </label>
                                <input type="text" class="form-control" name="title" id="basicpill-firstname-input"
                                    placeholder="Title " value="{{ $course->title ?? "" }}">
                                <div class="text-danger" id="title">

                                </div>

                            </div>
                        </div>

                        {{-- <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="choices-single-default" class="form-label font-size-13 text-muted">
                                    @if (session('page_lang') === 'en')
                                        Institute
                                    @elseif (session('page_lang') === 'ar')
                                        معهد
                                    @endif
                                </label>
                                <div class="text-danger" id="institute_id">

                                </div>
                                <select class="form-control" data-trigger name="institute_id">

                                    @foreach ($institutes as $institute)
                                    
                                    <option value="{{ $institute->id }}"
                                        @if ($institute->institute_id == $institute->id) selected @endif>{{ $institute->name }}
                                    </option>

                                      
                                    @endforeach

                                </select>
                            </div>
                        </div> --}}
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="choices-single-default" class="form-label font-size-13 text-muted">
                                    @if (session('page_lang') === 'en')
                                        Category
                                    @elseif (session('page_lang') === 'ar')
                                        فئة
                                    @endif
                                </label>
                                <div class="text-danger" id="institute_id">

                                </div>
                                <select class="form-control" data-trigger name="category_id">

                                    @foreach ($categories as $category)
                                        @if (session('page_lang') === 'en' && $category->name_en != null)
                                            <option value="{{ $category->id  }}"  @if ($course ) @if ($course->category_id == $category->id) selected  @endif @endif> {{ $category->name_en }} </option>
                                        @endif
                                        @if (session('page_lang') === 'ar' && $category->name_ar != null)
                                            <option value="{{ $category->id }}" @if($course) @if ($course->category_id == $category->id) selected  @endif @endif> {{ $category->name_ar }} </option>
                                        @endif


                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="choices-single-default" class="form-label font-size-13 text-muted">
                                    @if (session('page_lang') === 'en')
                                        Mode
                                    @elseif (session('page_lang') === 'ar')
                                        وضع
                                    @endif
                                </label>
                                <div class="text-danger" id="course_type">

                                </div>
                                <select class="form-control" data-trigger name="course_type"
                                    onchange="modeChanged(this)">
                                    <option value="0">
                                        @if (session('page_lang') === 'en')
                                            Offline
                                        @elseif (session('page_lang') === 'ar')
                                            غير متصل على الانترنت
                                        @endif
                                    </option>
                                    <option value="1" selected>
                                        @if (session('page_lang') === 'en')
                                            Online
                                        @elseif (session('page_lang') === 'ar')
                                            متصل
                                        @endif
                                    </option>



                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 " id="seatsDiv">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input" class="form-label">

                                    @if (session('page_lang') === 'en')
                                        Seats
                                    @elseif (session('page_lang') === 'ar')
                                        مقاعد
                                    @endif
                                </label>
                                <input type="text" class="form-control" name="seats" id="basicpill-firstname-input"
                                    placeholder="Title " value="{{ $course->seats ?? 0 }}">
                                <div class="text-danger" id="seats">

                                </div>

                            </div>
                        </div>



                        <div class="col-lg-6 ">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input" class="form-label">

                                    @if (session('page_lang') === 'en')
                                        Course Link
                                    @elseif (session('page_lang') === 'ar')
                                        رابط الدورة
                                    @endif
                                </label>
                                <input type="text" class="form-control" name="course_link"
                                    id="basicpill-firstname-input"
                                    placeholder="@if (session('page_lang') === 'en') Course Link  @elseif (session('page_lang') === 'ar')  رابط الدورة @endif"
                                    value="{{ $course->course_link ?? "" }}">
                                <div class="text-danger" id="course_link">

                                </div>

                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input" class="form-label">

                                    @if (session('page_lang') === 'en')
                                        Price
                                    @elseif (session('page_lang') === 'ar')
                                        سعر
                                    @endif
                                </label>
                                <input type="text" class="form-control" name="price"
                                    id="basicpill-firstname-input"
                                    placeholder="@if (session('page_lang') === 'en') Price @elseif (session('page_lang') === 'ar') سعر @endif "
                                    value="{{ $course->price ?? "" }}">
                                <div class="text-danger" id="price">

                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="basicpill-firstname-input" class="form-label">

                                    @if (session('page_lang') === 'en')
                                        Sale Price
                                    @elseif (session('page_lang') === 'ar')
                                        سعر البيع
                                    @endif
                                </label>
                                <input type="text" class="form-control" name="sale_price"
                                    id="basicpill-firstname-input"
                                    placeholder="@if (session('page_lang') === 'en') Sale Price  @elseif (session('page_lang') === 'ar')   سعر البيع @endif "
                                    value="{{ $course->sale_price ?? 0 }}">
                                <div class="text-danger" id="price">

                                </div>

                            </div>
                        </div>




                        <div class="col-lg-6 p-1">

                            <div class="mb-3">
                                <label class="form-label">
                                    @if (session('page_lang') === 'en')
                                        Start Date
                                    @elseif (session('page_lang') === 'ar')
                                        تاريخ البدء
                                    @endif
                                </label>
                                <input type="text" class="form-control" id="start_date"
                                    value="{{ $course->start_date ?? "" }}">
                            </div>
                        </div>
                        <div class="col-lg-6 p-1">

                            <div class="mb-3">
                                <label class="form-label">
                                    @if (session('page_lang') === 'en')
                                        End Date
                                    @elseif (session('page_lang') === 'ar')
                                        تاريخ الانتهاء
                                    @endif

                                </label>
                                <input type="text" class="form-control" id="end_date"
                                    value="{{ $course->end_date ?? "" }}">
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-lg-2">

                                <button type="button" onclick="addData(this)" class="btn btn-primary btn-rounded">
                                    @if (session('page_lang') === 'en')
                                        Submit
                                    @elseif (session('page_lang') === 'ar')
                                        يُقدِّم
                                    @endif
                                </button>
                            </div>

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
<script src="{{ URL::asset('assets/js/pages/form-advanced.init.js') }}"></script>

<!-- Sweet Alerts js -->
<script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/form-validation.init.js') }}"></script>

<script>
    $('#seatsDiv').hide();


    flatpickr('#start_date', {
        enableTime: true,
        dateFormat: "Y-m-d H:i"
    });


    flatpickr('#end_date', {
        enableTime: true,
        dateFormat: "Y-m-d H:i"
    });





    function addData(e) {
        var formData = new FormData($("#AddFormSubmit")[0]); // Create a new FormData object

        var apiBase = `{{ url('/') }}`;
        apiBase += "/api/";

        var windowurl = window.location.href;
        windowurl = windowurl.split('?');
        var parts = windowurl[0].split('/');
        var id = parts[parts.length - 1];


        var updateURL = `${apiBase}courses/${id}`;

        var lang = `{{ session('page_lang') }}`;

        console.log(lang , " This is the lang man ")
        var course_type = $('select[name=course_type]').val();
        var category_id = $('select[name=category_id]').val();
        var start_date = $('#start_date').val();;
        var end_date = $('#end_date').val();;
        formData.append('lang', lang);
        formData.append('course_type', course_type);
        formData.append('start_date', start_date);
        formData.append('category_id', category_id);
        formData.append('end_date', end_date);
        formData.append('_method', 'PUT');


        $.ajax({
            url: updateURL, // Replace with your API endpoint URL
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,

            success: function(res) {
                console.log(res)
                if (res['code'] == 200) {
                    alert(res.message)
                    $("#AddFormSubmit")[0].reset()
                    window.location = `{{ route('all_courses', ['lang' => app()->getLocale()]) }}`;
                    return;

                }

                if (res['code'] == 500) {
                    alert(res.message)
                    var errors = res['errors']
                    $(`.text-danger`).text('')
                    for (err in errors) {

                        $(`#${err}`).text(errors[err][0])
                    }

                }

            }

        });
    }

    function modeChanged(e) {
        var mode = e.value;
        console.log(mode, "mode ")
        if (mode == 0) {
            $('#seatsDiv').css('display', 'block !important');
            $('#seatsDiv').show();
        } else {

            $('#seatsDiv').css('display', 'none !important');
            $('#seatsDiv').hide();


        }
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
</script>
@endsection
