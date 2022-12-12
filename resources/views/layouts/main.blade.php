<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >
    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >


    <title>@yield('title') - WebLibrary</title>

    <!-- Fonts -->
    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"
    >

    <!-- Styles -->
    <link
        rel="stylesheet"
        href="{{ asset('css/app.css') }}"
    >
    <link
        rel="stylesheet"
        href="{{ asset('css/global.css') }}"
    >
    @stack('styles')

    {{-- <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script> --}}

    {{-- <script src="{{ asset('js/bootstrap.min.js') }}" defer></script> --}}

</head>

<body class="font-sans antialiased bg-light">
    @if (session()->has('flag'))
        <x-alert :message="session('flag')" />
    @endif

    <x-layout.top-navbar />
    @yield('content')

    <x-layout.bottom-navbar />

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('scripts')
</body>

</html>
