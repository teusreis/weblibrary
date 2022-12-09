<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function index()
    {
        return view('site.Index');
    }

    public function saves()
    {
        $posts = Post::query()
            ->whereIn('id', [DB::raw('select s.post_id from saves as s where s.user_id = ' . auth()->id())])
            ->isLikedByUser(auth()->id())
            ->isSavedByUser(auth()->id())
            ->paginate(10);

        return view('site.saves', [
            'posts' => $posts
        ]);
    }

    public function people(Request $request)
    {
        $users = User::query()
            ->joinProfile()
            ->when(isset($request->search), function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                    ->orWhere('username', 'like', "%{$request->search}%")
                    ->orWhere('email', 'like', "%{$request->search}%")
                    ->orWhere('description', 'like', "%{$request->search}%");
            })
            ->orderBy('name')
            ->paginate(10);

        // dd($users);

        return view('site.people', [
            'users' => $users,
            'search' => $request->query('search', '')
        ]);
    }

    public function search(Request $request)
    {
        $posts = Post::query()
            ->with(['user.profile'])
            ->when(
                isset($request->search),
                fn ($q) => $q->where('title', 'like', "%{$request->search}%")
                    ->orWhere('description', 'like', "%{$request->search}%")
                    ->orWhere('body', 'like', "%{$request->search}%")
            )
            ->isLikedByUser(auth()->id())
            ->isSavedByUser(auth()->id())
            ->paginate(10);

        return view('site.search', [
            'posts' => $posts,
            'search' => $request->query('search', '')
        ]);
    }
}
