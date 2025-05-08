@extends('layouts.master')
@section('title')Starter Page @endsection
@section('content')
{{-- breadcrumbs  --}}
    @section('breadcrumb')
        @component('components.breadcrumb')
            @slot('li_1') Pages @endslot
            @slot('title') Starter Page @endslot
        @endcomponent
    @endsection
@endsection
@section('script')

<script src="{{ URL::asset('assets/js/app.js') }}"></script>

@endsection
