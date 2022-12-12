<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private CommentService $service;

    public function __construct()
    {
        $this->service = new CommentService();
    }

    public function store(StoreCommentRequest $request)
    {
        $this->service->save($request->validated());

        return back()->with('flag', 'Comentario salvo com sucesso!');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        return back()->with('flag', 'Comentario deletado com sucesso!');
    }
}
