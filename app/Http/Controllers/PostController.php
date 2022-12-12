<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\Profile;
use App\Services\CommentService;
use App\Services\PostService;
use Illuminate\Http\Request;
use Image;

class PostController extends Controller
{
    private PostService $service;

    public function __construct()
    {
        $this->service = new PostService();
    }

    public function index(Request $request)
    {
        $posts = $this->service
            ->paginated($request->query(), ['user.profile']);

        return view('site.search', [
            'posts' => $posts,
            'search' => $request->query('search', '')
        ]);
    }

    public function timeline()
    {
        return view('site.index', [
            'posts' => $this->service->timeline()
        ]);
    }

    public function show(int $post)
    {
        $post = $this->service->findById($post);

        $comments = (new CommentService)->getCommentsByPostId($post->id, ['user.profile']);

        return view('post.show', [
            'post' => $post,
            'comments' => $comments
        ]);
    }

    public function create()
    {
        return view('post.create', [
            'profile' => Profile::where('user_id', auth()->id())->first(['username'])
        ]);
    }

    public function store(StorePostRequest $request)
    {
        $this->service->save($request->validated(), $request);

        return redirect()
            ->route('profile.show', [
                'profile' => auth()->user()->profile->username
            ])
            ->with('flag', 'Review criada com sucesso!');
    }

    public function like(Post $post)
    {
        $resul = $post->likes()->toggle(auth()->id());

        if (count($resul['attached']) > 0) {
            $message = 'Review curtida com sucesso!';
        } else {
            $message = 'Curtida removida com sucesso!';
        }

        return back()->with('flag', $message);
    }

    public function save(Post $post)
    {
        $resul = $post->saves()->toggle(auth()->id());

        if (count($resul['attached']) > 0) {
            $message = 'Review salva com sucesso!';
        } else {
            $message = 'Review removida das salvas!';
        }

        return back()->with('flag', $message);
    }
}
