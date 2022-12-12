@extends('layouts.main')

@section('title', 'edit profile')

@section('content')
    <main class="container my-4">
        <header class="d-flex justify-content-between align-items-center">
            <h1 class="form-title">Editar perfil</h1>

            <form
                action="{{ route('profile.delete-photo', $profile->username) }}"
                method="post"
            >
                @csrf
                @method('DELETE')

                <button class="btn btn-danger text-white">
                    Deletar foto
                </button>
            </form>
        </header>

        <form
            action="{{ route('profile.update', $profile->username) }}"
            method="post"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            <div class="form-group row">
                <div class="input col-12 col-md-6">
                    <label
                        class="form-label"
                        for="name"
                        id="name"
                    >
                        Nome
                    </label>
                    <input
                        type="text"
                        class="form-control signin-input"
                        id="name"
                        name="name"
                        value="{{ old('name') ?? auth()->user()->name }}"
                    />

                    @error('name')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="input col-12 col-md-6">
                    <label
                        class="form-label"
                        for="photo"
                        id="photo"
                    >
                        Foto
                    </label>
                    <input
                        type="file"
                        class="form-control signin-input"
                        id="photo"
                        name="photo"
                    />

                    @error('photo')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="input col-12">
                    <label
                        class="form-label"
                        for="username"
                        id="username"
                    >
                        Nome de usuário
                    </label>
                    <input
                        type="text"
                        class="form-control signin-input"
                        id="username"
                        name="username"
                        value="{{ old('username') ?? $profile->username }}"
                    />

                    @error('username')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="input col-12">
                    <label
                        class="form-label"
                        for="description"
                        id="description"
                    >
                        Descrição
                    </label>
                    <input
                        type="text"
                        class="form-control signin-input"
                        id="description"
                        name="description"
                        value="{{ old('description') ?? $profile->description }}"
                    />

                    @error('description')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="input col-12 col-md-6">
                    <label
                        class="form-label"
                        for="instagram"
                        id="instagram"
                    >
                        instagram
                    </label>
                    <input
                        type="text"
                        class="form-control signin-input"
                        id="instagram"
                        name="instagram"
                        value="{{ old('instagram') ?? $profile->instagram }}"
                    />

                    @error('instagram')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="input col-12 col-md-6">
                    <label
                        class="form-label"
                        for="facebook"
                        id="facebook"
                    >
                        Facebook
                    </label>
                    <input
                        type="text"
                        class="form-control signin-input"
                        id="facebook"
                        name="facebook"
                        value="{{ old('facebook') ?? $profile->facebook }}"
                    />

                    @error('facebook')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="input col-12 col-md-6">
                    <label
                        class="form-label"
                        for="youtube"
                        id="youtube"
                    >
                        Youtube
                    </label>
                    <input
                        type="text"
                        class="form-control signin-input"
                        id="youtube"
                        name="youtube"
                        value="{{ old('youtube') ?? $profile->youtube }}"
                    />

                    @error('youtube')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="input col-12 col-md-6">
                    <label
                        class="form-label"
                        for="twitter"
                        id="twitter"
                    >
                        Twitter
                    </label>
                    <input
                        type="text"
                        class="form-control signin-input"
                        id="twitter"
                        name="twitter"
                        value="{{ old('twitter') ?? $profile->twitter }}"
                    />

                    @error('twitter')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div
                    class="input d-flex justify-content-end align-items-center"
                    style="gap: 1.5rem"
                >
                    <a href="{{ route('profile.show', $profile->username) }}">Cancelar</a>

                    <button
                        class="btn btn-primary main-btn"
                        type="submit"
                    >
                        Salvar
                    </button>
                </div>
            </div>
        </form>
    </main>
@endsection
