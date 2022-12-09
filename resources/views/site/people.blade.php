@extends('layouts.main')

@section('title', 'People')

@section('content')
    <div class="container">
        <header class="my-4 d-flex justify-content-between">
            <h1 class="mb-0 h2 color-purple">Usuários</h1>

            <form
                method="get"
                action="{{ route('people') }}"
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
            @forelse ($users as $user)
                <x-user.card
                    :user="$user"
                    :photo="$user->photo"
                    :username="$user->username"
                    :name="$user->name"
                    :email="$user->email"
                    class="col-12 col-md-6 col-lg-4 py-3"
                />
            @empty
                <div class="col-12">
                    <p>Nenhum usuário encontrado!</p>
                </div>
            @endforelse

            <div class="col-12 py-5">
                {{ $users->links() }}
            </div>
        </main>
    </div>
@endsection
