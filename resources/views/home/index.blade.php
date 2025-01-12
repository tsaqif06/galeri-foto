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
                            <img src="{{ asset('storage/' . $photo->file_path) }}" class="card-img-top"
                                alt="{{ $photo->file_name }}">
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
                            <img src="{{ asset('storage/' . $photo->file_path) }}" class="card-img-top"
                                alt="{{ $photo->file_name }}">
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
                                        <img src="{{ asset('storage/' . $photo->file_path) }}" class="img-fluid mb-2"
                                            alt="{{ $photo->file_name }}">
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
