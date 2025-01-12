@extends('layout.app')

@section('content')
    <div class="container mt-4">
        <h1>Profil {{ $user->name }}</h1>
        <p>Email: {{ $user->email }}</p>
        <p>Role: {{ $user->role->name }}</p>

        <h2>Foto Unggahan</h2>
        <div class="row">
            @foreach ($user->photos as $photo)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="{{ $photo->file_path }}" class="img-fluid" alt="{{ $photo->file_name }}">
                        <div class="card-body">
                            @if ($photo->price > 0)
                                <span class="badge bg-warning text-dark">Rp {{ $photo->price }}</span>
                            @else
                                <span class="badge bg-success">Gratis</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
