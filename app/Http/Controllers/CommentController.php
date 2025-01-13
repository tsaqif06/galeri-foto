<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\Comment;

class CommentController extends Controller
{
    public function addComment(Request $request, $photoId)
    {
        // Validasi input
        $request->validate([
            'comment' => 'required|string|max:500',
        ]);

        $user = auth()->user();
        $photo = Photo::findOrFail($photoId);

        // Buat komentar baru
        $comment = Comment::create([
            'user_id' => $user->id_user,
            'photo_id' => $photoId,
            'comment' => $request->comment,
        ]);

        $commentResponse = [
            'id' => $comment->id_comment,
            'user_name' => $user->name,
            'comment' => $comment->comment,
        ];

        return response()->json([
            'message' => 'Comment added',
            'comment' => $commentResponse,
        ], 201);
    }


    public function updateComment(Request $request, $commentId)
    {
        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        $comment = Comment::findOrFail($commentId);

        // Pastikan user yang mengedit adalah pemilik komentar
        if ($comment->user_id != auth()->user()->id_user) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $comment->update(['content' => $request->content]);

        return response()->json(['message' => 'Comment updated', 'comment' => $comment], 200);
    }

    public function deleteComment($commentId)
    {
        $comment = Comment::findOrFail($commentId);

        // Pastikan user yang menghapus adalah pemilik komentar
        if ($comment->user_id != auth()->user()->id_user) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $comment->delete();

        return response()->json(['message' => 'Comment deleted'], 200);
    }
}
