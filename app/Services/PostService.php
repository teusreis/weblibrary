<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Image;

class PostService
{
    public function paginated(array $query = [], array $with = [], int $countPaginate = 10)
    {
        return $this->baseSearch($query, $with)
            ->paginate($countPaginate);
    }

    public function timeline(array $query = [], array $with = [], int $countPaginate = 10)
    {
        return $this->baseSearch()
            ->timeline()
            ->orderBy('posts.created_at', 'desc')
            ->paginate($countPaginate);
    }

    public function findById(int $id, array $with = []): Post
    {
        return $this->baseSearch(with: $with)
            ->where('id', $id)
            ->first();
    }

    public function save(array $data, Request $request)
    {
        $data['cover'] = $request->file('cover')->store('public/covers');
        $data['user_id'] = auth()->id();

        Image::make(storage_path('app/' . $data['cover']))
            ->resize(500, 300)
            ->save();

        $data['cover'] = str_replace('public/', '', $data['cover']);

        return Post::create($data);
    }

    public function update(int $id)
    {
        # code...
    }

    private function baseSearch(array $query = [], array $with = []): Builder
    {
        return Post::query()
            ->with($with)
            ->when(
                isset($query['search']),
                fn ($q) => $q->where('title', 'like', "%{$query['search']}%")
                    ->orWhere('description', 'like', "%{$query['search']}%")
                    ->orWhere('body', 'like', "%{$query['search']}%")
            )
            ->when(isset($query['user_id']), fn ($q) => $q->where('user_id', $query['user_id']))
            ->isLikedByUser(auth()->id())
            ->isSavedByUser(auth()->id())
            ->orderBy('created_at', 'desc');
    }
}
