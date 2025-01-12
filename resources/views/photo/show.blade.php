@extends('layout.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ $photo->file_path }}" class="img-fluid" alt="{{ $photo->file_name }}">
            </div>
            <div class="col-md-6">
                <h2>{{ $photo->file_name }}</h2>
                <p>Uploaded by: {{ $photo->user->name }}</p>
                <p>Price: {{ $photo->price > 0 ? 'Rp. ' . $photo->price : 'Free' }}</p>
                <p>Views: {{ $photo->views }}</p>
                <a href="#" class="btn btn-primary">Download</a>
            </div>
        </div>
    </div>
@endsection
