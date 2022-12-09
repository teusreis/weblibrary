@extends('layouts.main')

@section('content')
    <div class="container py-5 timeline-container">

        <main class="row">
            @forelse ($posts as $post)
                <x-post.card
                    class="col-12"
                    :id="$post->id"
                    :cover="$post->cover"
                    :title="$post->title"
                    :publishedDate="$post->publishedDate"
                    :description="$post->description"
                    :user="$post->user"
                    :isLikedByUser="$post->isLikedByUser"
                    :isSavedByUser="$post->isSavedByUser"
                />
            @empty
                <div class="col-12">Nenhuma review encontrada!</div>
            @endforelse

            <div class="col-12 py-4">
                {{ $posts->links() }}
            </div>
        </main>
    </div>
@endsection
