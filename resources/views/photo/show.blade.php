@extends('layout.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ $photo->file_path }}" class="img-fluid" alt="{{ $photo->file_name }}">
            </div>
            <div class="col-md-6">
                <h2>{{ $photo->file_name }}</h2>
                <p>Uploaded by: <a
                        href="{{ route('profile.show', ['username' => $photo->user->username]) }}">{{ $photo->user->name }}</a>
                </p>
                <p>Price: {{ $photo->price > 0 ? 'Rp. ' . $photo->price : 'Free' }}</p>
                <p>Views: {{ $photo->views }}</p>

                <!-- Like Button -->
                <button id="like-btn" data-photo-id="{{ $photo->id_photo }}"
                    class="btn {{ $isLiked ? 'btn-danger' : 'btn-outline-danger' }}">
                    ❤️ Like (<span id="like-count">{{ $photo->likes->count() }}</span>)
                </button>

                <!-- Save to Album Button -->
                <button id="save-btn" data-photo-id="{{ $photo->id_photo }}"
                    class="btn {{ $isSaved ? 'btn-success' : 'btn-outline-success' }}">
                    📂 Save
                </button>


                <!-- Share Button -->
                <button id="share-btn" class="btn btn-outline-primary">
                    🔗 Share
                </button>

                <!-- Comments Section -->
                <div id="comments">
                    @foreach ($photo->comments as $comment)
                        <div class="comment" id="comment-{{ $comment->id }}">
                            <strong>{{ $comment->user->name }}:</strong>
                            <p>{{ $comment->comment }}</p>
                        </div>
                    @endforeach
                </div>

                <!-- Add Comment -->
                @auth
                    <form id="comment-form" class="mt-3">
                        @csrf
                        <textarea id="comment-text" class="form-control" placeholder="Write a comment..."></textarea>
                        <button type="submit" class="btn btn-primary mt-2">Comment</button>
                    </form>
                @else
                    <p><a href="{{ route('login') }}">Login</a> to comment.</p>
                @endauth
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Like Photo
            $('#like-btn').on('click', function() {
                let button = $(this);
                let photoId = button.data('photo-id');
                button.toggleClass('btn-danger btn-outline-danger');
                $.ajax({
                    url: `/photos/${photoId}/like`, // Menggunakan endpoint dinamis
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#like-count').text(response.likes_count);
                    },
                    error: function(xhr) {
                        window.location.href = '{{ route('login') }}';
                    }
                });
            });

            // Save Photo
            $('#save-btn').on('click', function() {
                let button = $(this);
                let photoId = button.data('photo-id');
                button.toggleClass('btn-success btn-outline-success');
                $.ajax({
                    url: `/photos/${photoId}/favorite`, // Endpoint dinamis
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {},
                    error: function(xhr) {
                        window.location.href = '{{ route('login') }}';
                    }
                });
            });

            // Comment Photo
            $('#comment-form').on('submit', function(e) {
                e.preventDefault();
                let commentText = $('#comment-text').val();
                if (commentText.trim() === '') {
                    alert('Comment cannot be empty.');
                    return;
                }

                let photoId = '{{ $photo->id_photo }}'; // Ambil ID foto dari server-side
                $.ajax({
                    url: `/photos/${photoId}/comments`,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        comment: commentText
                    },
                    success: function(response) {
                        const commentResponse = response.comment
                        // Tambahkan komentar baru ke dalam daftar
                        $('#comments').append(
                            `<div class="comment" id="comment-${commentResponse.id}">
                    <strong>${commentResponse.user_name}:</strong>
                    <p>${commentResponse.comment}</p>
                </div>`
                        );
                        $('#comment-text').val(''); // Kosongkan textarea
                    },
                    error: function(xhr) {
                        window.location.href = '{{ route('login') }}';
                    }
                });
            });

            // Share Photo
            $('#share-btn').on('click', function() {
                let shareUrl = '{{ route('photo.show', $photo->id_photo) }}';
                navigator.clipboard.writeText(shareUrl).then(function() {
                    alert('Photo link has been copied to clipboard!');
                }).catch(function() {
                    alert('Failed to copy link. Please try again.');
                });
            });
        });
    </script>
@endpush
