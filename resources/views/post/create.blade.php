@extends('layouts.main')

@section('content')
    <main class="container my-4">

        <form
            action="{{ route('post.store') }}"
            method="post"
            enctype="multipart/form-data"
        >
            @csrf

            <div class="form-group row">
                <div class="input col-12 col-md-6">
                    <label
                        class="form-label"
                        for="title"
                        id="title"
                    >
                        Titulo
                    </label>
                    <input
                        type="text"
                        class="form-control signin-input"
                        id="title"
                        name="title"
                        value="{{ old('title') }}"
                    />

                    @error('title')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="input col-12 col-md-6">
                    <label
                        class="form-label"
                        for="cover"
                        id="cover"
                    >
                        Imagem
                    </label>
                    <input
                        type="file"
                        class="form-control file-input-form"
                        id="cover"
                        name="cover"
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
                        value="{{ old('description') }}"
                    />

                    @error('description')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="input col-12">
                    <label
                        class="form-label"
                        for="body"
                        id="body"
                    >
                        Review
                    </label>
                    <textarea
                        name="body"
                        class="form-control text-area-form"
                        rows="20"
                    >{{ old('body') }}</textarea>

                    @error('description')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div
                    class="input d-flex justify-content-end align-items-center"
                    style="gap: 1.5rem"
                >
                    <a href="{{ route('profile.show', ['profile' => $profile->username]) }}">Cancelar</a>

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

{{-- @push('scripts')
    <script>
        CKEDITOR.replace('editor1');
    </script>
@endpush --}}
