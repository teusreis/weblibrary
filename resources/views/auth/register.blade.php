@extends('layouts.guest')

@section('title', 'Register')

@section('content')
    <div class="card-body">
        <!-- Validation Errors -->
        <x-auth-validation-errors
            class="mb-4"
            :errors="$errors"
        />

        <form
            method="POST"
            id="register-form"
            action="{{ route('register') }}"
        >
            @csrf

            <!-- Name -->
            <h1 class="form-title">REGISTRAR-SE</h1>

            <div class="form-group">
                <div class="input">
                    <label
                        class="form-label email-sign-up"
                        for="email"
                    >
                        E-mail
                    </label>

                    <input
                        type="email"
                        class="form-control signin-input"
                        id="email-sign-up"
                        name="email"
                        required
                    />
                </div>
                <div class="input">
                    <label
                        class="form-label"
                        for="name"
                        id="name"
                    >
                        Nome completo
                    </label>
                    <input
                        type="text"
                        class="form-control signin-input"
                        id="name-sign-up"
                        name="name"
                        required
                    />
                </div>
                <div class="input">
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
                        id="username-sign-up"
                        name="username"
                    />
                </div>
                <div class="input">
                    <label
                        class="form-label password-sign-up"
                        for="password"
                    >
                        Senha
                    </label>
                    <input
                        type="password"
                        class="form-control signin-input"
                        id="password-sign-up"
                        name="password"
                        required
                    />
                </div>
                <div class="input">
                    <label
                        class="form-label"
                        for="password_confirmation"
                        id="password_confirmation"
                    >
                        Confirmar senha
                    </label>
                    <input
                        type="password"
                        class="form-control signin-input"
                        id="password_confirmation-sign-up"
                        name="password_confirmation"
                        required
                    />
                </div>
                <div class="input">
                    <button
                        class="btn form-btn"
                        {{-- id="btn-sign-up" --}}
                    >
                        Enviar
                    </button>
                </div>
                <div class="input">
                    <a
                        href="{{ route('login') }}"
                        class="text-decoration-none text-dark fw-bolder"
                    >
                        Já tenho conta
                    </a>
                </div>
            </div>
        </form>
    </div>
@endsection
