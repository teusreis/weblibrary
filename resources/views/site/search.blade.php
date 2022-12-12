@extends('layouts.main')

@section('title', 'Search')

@section('content')
    <div class="container">
        <header class="my-4 d-flex justify-content-between">
            <h1 class="mb-0 h2 color-purple">Reviews</h1>

            <form
                method="get"
                action="{{ route('search') }}"
                class="input d-flex"
            >
                <input
                    type="text"
                    class="form-control search-input"
                    id="search"
                    name="search"
                    placeholder="Pesquisa"
                    value="{{ $search }}"
                />

                <button class="btn btn-sm main-btn serach-btn">
                    Pesquisar
                </button>

            </form>
        </header>

        <main class="row">
            @forelse ($posts as $post)
                <x-post.card
                    class="col-12 col-md-6 col-lg-4"
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
                <div class="col-12">
                    Nenhum post encontrado!
                </div>
            @endforelse

            <div class="col-12 py-4">
                {{ $posts->links() }}
            </div>
        </main>
    </div>
@endsection

@push('scripts')
    <script>
        function cropDescription() {

            const descriptions = document.querySelectorAll('.post-card-description');

            descriptions.forEach(p => {

                if (p.textContent.length > 250) {
                    p.innerText = p.textContent.slice(0, 250) + '...'
                }
            })

        }

        cropDescription();
    </script>
@endpush
