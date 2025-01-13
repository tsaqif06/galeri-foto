@extends('layout.app')

@section('content')
    <div class="container">
        <h1>{{ $user->name }}</h1>

        <h3>Photos</h3>
        <div class="row">
            @foreach ($photos as $photo)
                <div class="col-md-4">
                    <a href="{{ route('photo.show', $photo->slug) }}">
                        <div class="card mb-4">
                            <img src="{{ $photo->file_path }}" class="img-fluid" alt="{{ $photo->file_name }}">
                            <div class="card-body">
                                <a
                                    href="{{ route('profile.show', ['username' => $photo->user->username]) }}">{{ $photo->user->name }}</a>
                                <p>{{ $photo->visibility == 'public' ? 'Public' : 'Private' }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <h3>Albums</h3>
        <div class="row">
            @foreach ($albums as $album)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">{{ $album->name }}</h5>
                            <p>{{ $album->visibility == 'public' ? 'Public' : 'Private' }}</p>
                            <p>Created by: <a
                                    href="{{ route('profile.show', ['username' => $album->user->username]) }}">{{ $album->user->name }}</a>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
