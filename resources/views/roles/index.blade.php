@extends('layouts.master')
@section('title')Create Role @endsection
@section('content')

{{-- breadcrumbs  --}}
@section('breadcrumb')
@component('components.breadcrumb')
@slot('li_1') Role @endslot
@slot('title') Role Create @endslot
@endcomponent
@endsection
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<div class="pull-right">
    {{-- @can('role-create') --}}
    <a class="btn btn-success" href="{{ route('create-roles') }}"> Create New Role</a>
    {{-- @endcan --}}
</div>
<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Name</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($roles as $key => $role)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $role->name }}</td>
        <td>
            <a class="btn btn-info" href="">Show</a>
            @can('role-edit')
            <a class="btn btn-primary" href="">Edit</a>
            @endcan
            @can('role-delete')
            {{-- {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!} --}}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
            @endcan
        </td>
    </tr>
    @endforeach
</table>


{!! $roles->render() !!}


@endsection
@section('script')

<script src="{{ URL::asset('assets/js/app.js') }}"></script>

@endsection
