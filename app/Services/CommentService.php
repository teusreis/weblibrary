<?php

namespace App\Services;

use App\Models\Comment;

class CommentService
{
    public function save(array $data)
    {
        $data['user_id'] = auth()->id();

        return Comment::create($data);
    }

    public function delete(int $id)
    {
        return Comment::find($id)->delete();
    }

    public function getCommentsByPostId(int $postId, array $with = [])
    {
        return Comment::query()
            ->where('post_id', $postId)
            ->with($with)
            ->orderBy('created_at', 'desc')
            ->paginate(5);
    }
}
