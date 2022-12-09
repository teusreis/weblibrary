@extends('layouts.main')

@section('title', 'saves')

@section('content')
    <div class="container">
        <h1 class="my-4 h3 color-purple">Reviews salvas</h1>

        <main class="row">

            @forelse ($posts as $post)
                <x-post.card
                    class="col-12 col-md-6 col-lg-4"
                    :id="$post->id"
                    :cover="$post->cover"
                    :title="$post->title"
                    :description="$post->description"
                    :isLikedByUser="$post->isLikedByUser"
                    :isSavedByUser="$post->isSavedByUser"
                />
            @empty
                <div class="text-center">
                    Nenhuma review salva!
                </div>
            @endforelse

            <div class="col-12">
                {{ $posts->links() }}
            </div>
        </main>

    </div>
@endsection
