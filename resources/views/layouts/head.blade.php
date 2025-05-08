@yield('css')
<!-- plugin css -->
<link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
<!-- swiper css -->
<link href="{{ URL::asset('assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Bootstrap Css -->
<link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{ URL::asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

{{-- Tostify Css  --}}
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">



{{-- Added by Nikhil  --}}
{{-- <link href="{{ URL::asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" /> --}}

{{-- Edited by Nikhil  --}}
@if (session('layout_dir') === 'ltr')
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
@elseif(session('layout_dir') === 'rtl')
    <link href="{{ URL::asset('assets/css/app.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/css/bootstrap.rtl.css') }}" rel="stylesheet" type="text/css" />
@else
    <link href="{{ URL::asset('assets/css/app.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/css/bootstrap.rtl.css') }}" rel="stylesheet" type="text/css" />
@endif




<link href="{{ asset('assets/css/custom.css') }}" id="app-style" rel="stylesheet" type="text/css" />


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery.min.js"></script>


{{-- Tositify js  --}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<script>
    function loader(title = "") {
        Toastify({
            text: title,
            duration: 3000,
            destination: "https://github.com/apvarun/toastify-js",
            newWindow: true,
            close: true,
            gravity: "bottom", // `top` or `bottom`
            position: "right", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "#2C2626",
            },
            onClick: function() {} // Callback after click
        }).showToast();


    }
</script>
{{-- @yield('css') --}}
