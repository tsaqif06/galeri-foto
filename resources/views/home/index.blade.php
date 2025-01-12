@extends('layout.app')

@section('content')
    <div class="row mt-4">
        <!-- Foto Terbaru -->
        <section class="col-12">
            <h2>Foto Terbaru</h2>
            <div class="row">
                @foreach ($recentPhotos as $photo)
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <a href="{{ route('photo.show', $photo->slug) }}">
                                <div class="position-relative">
                                    <img src="{{ $photo->file_path }}" class="img-fluid mb-2" alt="{{ $photo->file_name }}">
                                    {{--  <img src="{{ asset('storage/' . $photo->file_path) }}" class="img-fluid mb-2"
                                        alt="{{ $photo->file_name }}">  --}}
                                    @if ($photo->price > 0)
                                        <span class="position-absolute top-0 start-0 bg-warning text-dark px-2 py-1"
                                            style="border-radius: 0 0 4px 0;">
                                            <i class="fas fa-crown"></i> Premium
                                        </span>
                                    @endif
                                </div>
                            </a>
                            <div class="card-body">
                                <p class="card-text">Rp. {{ $photo->price }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Foto Terlaris -->
        <section class="col-12 mt-5">
            <h2>Foto Terlaris</h2>
            <div class="row">
                @foreach ($popularPhotos as $photo)
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <a href="{{ route('photo.show', $photo->id_photo) }}">
                                <div class="position-relative">
                                    <img src="{{ $photo->file_path }}" class="img-fluid mb-2" alt="{{ $photo->file_name }}">
                                    {{--  <img src="{{ asset('storage/' . $photo->file_path) }}" class="img-fluid mb-2"
                                alt="{{ $photo->file_name }}">  --}}
                                    @if ($photo->price > 0)
                                        <span class="position-absolute top-0 start-0 bg-warning text-dark px-2 py-1"
                                            style="border-radius: 0 0 4px 0;">
                                            <i class="fas fa-crown"></i> Premium
                                        </span>
                                    @endif
                                </div>
                            </a>
                            <div class="card-body">
                                <p class="card-text">Rp. {{ $photo->price }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Kategori Foto -->
        <section class="col-12 mt-5">
            <h2>Kategori Foto</h2>
            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">{{ $category->name }}</h5>
                                <div class="category-photos">
                                    @foreach ($category->photos as $photo)
                                        <img src="{{ $photo->file_path }}" class="img-fluid mb-2"
                                            alt="{{ $photo->file_name }}">
                                        {{--  <img src="{{ asset('storage/' . $photo->file_path) }}" class="img-fluid mb-2"
                                        alt="{{ $photo->file_name }}">  --}}
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection
