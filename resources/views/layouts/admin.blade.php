<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no"
    >
    <title>@yield('title', 'Dashboard') | Laravel</title>
    {{-- Font Awesome --}}
    <link
        href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}"
        rel="stylesheet"
        type="text/css"
    >
    {{-- Google Font Nunito --}}
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet"
    >
    {{-- SB Admin 2 --}}
    <link
        href="{{ asset('css/sb-admin-2.min.css') }}"
        rel="stylesheet"
    >
    {{-- CSS atau script tambahan dari halaman anak --}}
    @stack('addon-script-head')
</head>

<body id="page-top">

    {{-- Page Wrapper --}}
    <div id="wrapper">

        {{-- Sidebar --}}
        @include('layouts.components.sidebar')

        {{-- Content Wrapper --}}
        <div
            id="content-wrapper"
            class="d-flex flex-column"
        >

            {{-- Main Content --}}
            <div id="content">

                {{-- Topbar --}}
                @include('layouts.components.topbar')

                {{-- Isi halaman --}}
                @yield('content')

            </div>
            {{-- End of Main Content --}}

            {{-- Footer --}}
            @include('layouts.components.footer')

        </div>
        {{-- End of Content Wrapper --}}

    </div>
    {{-- End of Page Wrapper --}}

    {{-- Scroll to Top Button --}}
    <a
        class="scroll-to-top rounded"
        href="#page-top"
    >
        <i class="fas fa-angle-up"></i>
    </a>

    {{-- JQuery --}}
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

    {{-- Bootstrap --}}
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    {{-- JQuery Easing --}}
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    {{-- SB Admin 2 --}}
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    {{-- Script tambahan dari halaman anak --}}
    @stack('addon-script-footer')

</body>

</html>
