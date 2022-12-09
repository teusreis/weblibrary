@extends('layouts.guest')

@section('title', 'Login')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
@endpush


@section('content')
    <div class="card-body">
        <!-- Session Status -->
        <x-auth-session-status class="mb-3" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-3" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="container">
                <div class="form-sign-in">
                    <h1 class="form-title">Login</h1>

                    <div class="form-group">
                        <div class="input">
                            <label class="form-label" for="email" id="email">E-mail</label>
                            <input type="email" class="form-control signin-input" id="email-sign-in" name="email"
                                required />
                        </div>
                        <div class="input">
                            <label class="form-label" for="password" id="password">Senha</label>
                            <input type="password" class="form-control signin-input" id="password-sign-in" name="password"
                                required />
                        </div>
                        <div class="input">
                            <button class="btn form-btn" id="btn-sign-in">
                                Login
                            </button>
                        </div>

                        <div class="d-flex justify-content-end text-weight-bold">
                            {{-- <a href="{{ route('password.request') }}">Recuperar senha</a> --}}
                            <a href="{{ route('register') }}">Registrar-se</a>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
