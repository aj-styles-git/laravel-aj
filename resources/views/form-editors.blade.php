@extends('layouts.master')
@section('title')Editor @endsection
@section('css')

<!-- quill css -->
<link href="{{ URL::asset('assets/libs/quill/quill.min.css') }}" rel="stylesheet">

@endsection
@section('content')
{{-- breadcrumbs  --}}
    @section('breadcrumb')
        @component('components.breadcrumb')
            @slot('li_1') Forms @endslot
            @slot('title') Editor @endslot
        @endcomponent
    @endsection
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">Ckeditor Classic Editor</h4>
            </div><!-- end card header -->
            <div class="card-body">
                <div id="ckeditor-classic"></div>
            </div><!-- end cardbody -->
        </div><!-- end card -->
    </div><!-- end col-->
</div><!-- end row -->

<div class="row">
    <div class="col-lg-12">
        <div class="justify-content-between d-flex align-items-center mt-4 mb-3">
            <h5 class="mb-0 pb-1 text-decoration-underline">Quilljs Editor</h5>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Snow Editor</h4>
            </div>
            <div class="card-body">

                <div id="snow-editor" style="height: 300px;">
                    <h3><span class="ql-size-large">Hello World!</span></h3>
                    <p><br></p>
                    <h3>This is an simple editable area.</h3>
                    <p><br></p>
                    <ul>
                        <li>
                            Select a text to reveal the toolbar.
                        </li>
                        <li>
                            Edit rich document on-the-fly, so elastic!
                        </li>
                    </ul>
                    <p><br></p>
                    <p>
                        End of simple area
                    </p>

                </div> <!-- end Snow-editor-->
            </div> <!-- end card-body-->
        </div> <!-- end card-->

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Bubble Editor</h4>
            </div>
            <div class="card-body">

                <div id="bubble-editor" style="height: 300px;">
                    <h3><span class="ql-size-large">Hello World!</span></h3>
                    <p><br></p>
                    <h3>This is an simple editable area.</h3>
                    <p><br></p>
                    <ul>
                        <li>
                            Select a text to reveal the toolbar.
                        </li>
                        <li>
                            Edit rich document on-the-fly, so elastic!
                        </li>
                    </ul>
                    <p><br></p>
                    <p>
                        End of simple area
                    </p>
                </div> <!-- end Snow-editor-->
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div><!-- end col -->
</div>
<!-- end row -->

@endsection
@section('script')

<!-- ckeditor -->
<script src="{{ URL::asset('assets/libs/@ckeditor/@ckeditor.min.js') }}"></script>
<!-- quill js -->
<script src="{{ URL::asset('assets/libs/quill/quill.min.js') }}"></script>
<!-- init js -->
<script src="{{ URL::asset('assets/js/pages/form-editor.init.js') }}"></script>

<script src="{{ URL::asset('assets/js/app.js') }}"></script>

@endsection
