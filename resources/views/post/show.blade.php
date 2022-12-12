@extends('layouts.main')

@section('title', $post->title)

@section('content')
    <main
        class="container py-4"
        style="max-width: 750px"
    >
        <header class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="color-purple">{{ $post->title }}</h1>

            <div class="d-flex">
                <form
                    action="{{ route('post.like', $post->id) }}"
                    method="post"
                    class="me-2"
                >
                    @csrf
                    <button class="border-0 m-0 p-0">
                        <x-icons.heart
                            :isLiked="$post->isLikedByUser"
                            class="submit-icon"
                        />

                        {{ $post->likes_count }}
                    </button>
                </form>

                <form
                    action="{{ route('post.save', $post->id) }}"
                    method="post"
                >
                    @csrf
                    <button class="border-0 m-0 p-0">
                        <x-icons.bookmark :isSaved="$post->isSavedByUser" />
                    </button>
                </form>

            </div>
        </header>

        <div class="mb-4">
            <img
                src="{{ asset('storage/' . $post->cover) }}"
                width="100%"
            >
        </div>

        <p class="text-muted">
            {{ $post->description }}
        </p>

        <p class="text-justify">
            {{ $post->body }}
        </p>

        <footer class="d-flex justify-content-between py-4 align-items-center">
            <x-user.card
                :user="$post->user"
                :photo="$post->user->profile->photo"
                :username="$post->user->profile->username"
                :name="$post->user->name"
                :email="$post->user->email"
            />

            <div class="d-flex flex-column justify-content-center">
                <p class="mb-0">
                    Publicação: {{ $post->published_date }}
                </p>
            </div>
        </footer>
    </main>

    <div
        class="container mb-5"
        style="max-width: 750px"
    >
        <h1 class="color-purple border-b">Comentarios</h1>

        <form
            action="{{ route('comment.store') }}"
            method="post"
        >
            @csrf
            <div class="input">
                <label
                    class="form-label"
                    for="message"
                    id="message"
                >
                    Fazer um comentario
                </label>

                <textarea
                    name="message"
                    class="form-control text-area-form"
                    rows="2"
                >{{ old('message') }}</textarea>

                <input
                    type="hidden"
                    name="post_id"
                    value="{{ $post->id }}"
                >

                @error('message')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror

                <div class="input d-flex justify-content-end align-items-center py-2">
                    <button
                        class="btn btn-primary main-btn"
                        type="submit"
                    >
                        Salvar
                    </button>
                </div>
            </div>
        </form>

        <div>
            @forelse ($comments as $comment)
                <div class="mb-2">
                    <x-comment.card
                        :message="$comment->message"
                        :user="$comment->user"
                        :photo="$comment->user->profile->photo"
                        :username="$comment->user->profile->username"
                        :name="$comment->user->name"
                        :email="$comment->user->email"
                    />
                </div>
            @empty
                <div>Nenhum comentario encontrado!</div>
            @endforelse

            <div class="pt-2 mb-5">
                {{ $comments->links() }}
            </div>
        </div>
    </div>

@endsection
