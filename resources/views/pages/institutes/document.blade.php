@extends('layouts.vertical-master-layout')

@section('title', __('Document'))

@section('content')
<div class="container mt-4">
    <h3>{{ __('Document for Institute: ') }} {{ $institute->name }}</h3>
 
    <div class="mt-4">
        @if ($institute->document)
            <h5>{{ __('Current Document:') }}</h5>
            @if (in_array(pathinfo($institute->document, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                <img src="{{ asset( $institute->document) }}" alt="Document" class="avatar-xl rounded-circle img-thumbnail" style="height:200px; width:300px">
            @elseif (pathinfo($institute->document, PATHINFO_EXTENSION) === 'pdf')
                <a href="{{ asset( $institute->document) }}" target="_blank">{{ __('Open PDF') }}</a>
            @else
                <p>{{ __('Unsupported file format.') }}</p>
            @endif
        @else
            <p>{{ __('No document uploaded yet.') }}</p>
        @endif
    </div>

    <div class="mt-4">
        <h5>{{ __('Upload New Document:') }}</h5>
        <form action="{{ route('institute.uploadDocument', $institute->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <input type="file" name="document" class="form-control" accept=".pdf,.jpg,.jpeg,.png" required>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('Upload') }}</button>
        </form>
    </div>
</div>
@endsection