@extends('layout.app')

@push('styles')
    <style>
        .spinner-border {
            margin-left: 5px;
            vertical-align: middle;
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <!-- User Info -->
        <div class="profile-header">
            <div class="row">
                <div class="col-md-2">
                    <!-- Profile Picture -->
                    <img src="{{ $user->profile_picture ?? asset('images/default-profile.png') }}" class="img-thumbnail"
                        alt="{{ $user->name }}">
                </div>
                <div class="col-md-10">
                    <h1>{{ $user->name }}</h1>
                    <p>{{ $user->description }}</p>
                    <div>
                        <span id="followers-count"><strong>{{ $user->followers->count() }}</strong></span> Followers
                        <span><strong>{{ $user->followings->count() }}</strong> Following</span>
                    </div>

                    <!-- Follow/Unfollow Button -->
                    @auth
                        @if (auth()->id() !== $user->id_user)
                            <button id="follow-btn"
                                class="btn {{ auth()->user()->followings->contains($user->id_user)? 'btn-danger': 'btn-primary' }}"
                                data-username="{{ $user->username }}"
                                data-action="{{ auth()->user()->followings->contains($user->id_user)? 'unfollow': 'follow' }}">
                                <span
                                    class="btn-text">{{ auth()->user()->followings->contains($user->id_user)? 'Unfollow': 'Follow' }}</span>
                                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            </button>
                        @endif
                    @else
                        <!-- Redirect to login -->
                        <a href="{{ route('login') }}" class="btn btn-primary">Follow</a>
                    @endauth
                </div>
            </div>

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
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#follow-btn').on('click', function() {
                let button = $(this);
                let username = button.data('username');
                let action = button.data('action');
                let url = action === 'follow' ? `/follow/${username}` : `/unfollow/${username}`;
                let method = action === 'follow' ? 'POST' : 'POST';

                // Dapatkan elemen teks dan spinner
                let btnText = button.find('.btn-text');
                let spinner = button.find('.spinner-border');

                // Tampilkan spinner dan sembunyikan teks tombol
                btnText.addClass('d-none');
                spinner.removeClass('d-none');

                $.ajax({
                    url: url,
                    method: method,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            // Update button state
                            button.data('action', action === 'follow' ? 'unfollow' : 'follow');
                            button.toggleClass('btn-primary btn-danger');
                            btnText.text(action === 'follow' ? 'Unfollow' : 'Follow');

                            // Update followers count
                            $('#followers-count').html(
                                `<strong>${response.followers_count}</strong>`
                            );
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 401) {
                            window.location.href = '{{ route('login') }}';
                        }
                    },
                    complete: function() {
                        // Sembunyikan spinner dan tampilkan teks tombol kembali
                        spinner.addClass('d-none');
                        btnText.removeClass('d-none');
                    }
                });
            });
        });
    </script>
@endpush
