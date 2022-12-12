@extends('layouts.main')

@section('title', $profile->username)

@section('content')
    <div class="container my-5">
        <header class="row mb-5">
            <div class="col-4">
                @if (isset($profile->photo))
                    <img
                        class="rounded-circle d-block mx-auto profile-img"
                        src="{{ asset('storage/' . $profile->photo) }}"
                        alt=""
                    >
                @else
                    <img
                        class="rounded-circle d-block mx-auto profile-img"
                        src="{{ asset('imgs/avatar.png') }}"
                        alt=""
                    >
                @endif

            </div>

            <div class="col-8">
                <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center py-2">
                    <h2 class="fw-bolder me-4">
                        {{ $profile->username }}
                    </h2>

                    @if ($profile->user_id === auth()->id())
                        <div class="d-flex gap-2">
                            <a
                                href="{{ route('profile.edit', $profile->username) }}"
                                class="btn btn-primary main-btn btn-sm"
                            >
                                editar
                            </a>
                            <a
                                href="{{ route('post.create') }}"
                                class="btn btn-primary main-btn btn-sm"
                            >
                                + Novo post
                            </a>
                        </div>
                    @else
                        <form
                            action="{{ route('profile.follow', $profile->username) }}"
                            method="post"
                        >
                            @csrf
                            <button class="btn btn-primary main-btn btn-sm">
                                @if ($profile->user->isFollowingUser(auth()->id()))
                                    Deseguir
                                @else
                                    Seguir
                                @endif
                            </button>
                        </form>
                    @endif

                </div>

                <p class="my-3 d-block">
                    {{ $profile->description ?? '---' }}
                </p>

                <div
                    class="mt-3 d-none d-md-flex"
                    style="gap: 2rem"
                >

                    @isset($profile->facebook)
                        <a
                            class="text-dark text-decoration-none"
                            href="https://www.facebook.com/{{ $profile->facebook }}"
                            target="_blank"
                        >
                            <x-icons.facebook />
                        </a>
                    @endisset

                    @isset($profile->instagram)
                        <a
                            class="text-dark text-decoration-none"
                            href="https://instagram.com/{{ $profile->instagram }}"
                            target="_blank"
                        >
                            <x-icons.instagram />
                        </a>
                    @endisset

                    @isset($profile->youtube)
                        <a
                            class="text-dark text-decoration-none"
                            href="https://www.youtube.com/c/{{ $profile->youtube }}"
                            target="_blank"
                        >
                            <x-icons.youtube />
                        </a>
                    @endisset

                    @isset($profile->twitter)
                        <a
                            class="text-dark text-decoration-none"
                            href="https://twitter.com/{{ $profile->twitter }}"
                            target="_blank"
                        >
                            <x-icons.twitter />
                        </a>
                    @endisset

                </div>
            </div>

            <div class="col-12 d-block d-md-none">
                <div
                    class="d-flex mt-3"
                    style="gap: 2rem"
                >

                    @isset($profile->facebook)
                        <a
                            class="text-dark text-decoration-none"
                            href="https://www.facebook.com/{{ $profile->facebook }}"
                            target="_blank"
                        >
                            <x-icons.facebook />
                        </a>
                    @endisset

                    @isset($profile->instagram)
                        <a
                            class="text-dark text-decoration-none"
                            href="https://instagram.com/{{ $profile->instagram }}"
                            target="_blank"
                        >
                            <x-icons.instagram />
                        </a>
                    @endisset

                    @isset($profile->youtube)
                        <a
                            class="text-dark text-decoration-none"
                            href="https://www.youtube.com/c/{{ $profile->youtube }}"
                            target="_blank"
                        >
                            <x-icons.youtube />
                        </a>
                    @endisset

                    @isset($profile->twitter)
                        <a
                            class="text-dark text-decoration-none"
                            href="https://twitter.com/{{ $profile->twitter }}"
                            target="_blank"
                        >
                            <x-icons.twitter />
                        </a>
                    @endisset

                </div>
            </div>
        </header>

        <main class="row my-4">
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
                    Nenhum post criado!
                </div>
            @endforelse

            <div class="col-12">
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
