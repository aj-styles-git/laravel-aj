@extends('layouts.master')
@section('title')Video @endsection
@section('content')

{{-- breadcrumbs  --}}
@section('breadcrumb')
@component('components.breadcrumb')
@slot('li_1') UI Elements @endslot
@slot('title') Video @endslot
@endcomponent
@endsection
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<div class="pull-right">
    {{-- @can('role-create') --}}
    <a class="btn btn-success" href="{{ route('roles') }}"> Create New Role</a>
    {{-- @endcan --}}
    {{-- @can('role-show') --}}
    <a class="btn btn-success" href="roles"> Show Role</a>
    {{-- @endcan --}}
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Sr.No</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $id = 1;
        ?>
        @foreach($user as $key => $data)
        <tr>
            <th scope="row">{{$id++}}</th>
            <td>{{$data->name}}</td>
            <td>{{$data->email}}</td>
            <td>
                
                {{-- @foreach($role as $v) --}}
                <label class="label label-success">{{$role->name}},</label>
                {{-- @endforeach --}}
        
            </td>
            <td>
                <a class="btn btn-info" href="{{ route('users-edit',$data->id) }}">edit</a>
                <a class="btn btn-info" href="{{ route('delete-user',$data->id) }}">delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button> --}}

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('register') }}" class="mt-4 pt-2">

                    @csrf

                    <div class="form-floating form-floating-custom mb-3">
                        <input type="text" id="input-username" placeholder="Enter User Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$data->name}}" required autocomplete="name" autofocus>
                        <label for="input-username">{{ __('Name') }}</label>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div class="form-floating-icon">
                            <i class="uil uil-users-alt"></i>
                        </div>
                    </div>


                    <div class="form-floating form-floating-custom mb-3">
                        <input type="email" id="input-email" placeholder="Enter Email" required="" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$data->email}}" required autocomplete="email">
                        <div class="invalid-feedback">
                            Please Enter Email
                        </div>
                        <label for="input-email">{{ __('Email Address') }}</label>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div class="form-floating-icon">
                            <i class="uil uil-envelope-alt"></i>
                        </div>
                    </div>

                    <div class="mb-3">
                      <select class="form-control" name="role" id="role">
                        <option>New Delhi</option>
                      </select>
                    </div>

                </form><!-- end form -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')

<script src="{{ URL::asset('assets/js/app.js') }}"></script>

@endsection
