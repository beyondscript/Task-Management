<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <meta property="og:image" content="{{ asset('icons/facebookimage.png') }}">

    <link rel="icon" type="image/png" href="{{asset('icons/favicon.png')}}">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/sass/app.scss', 'resources/js/app.js', 'resources/js/supervisors.js', 'resources/js/assignorTodos.js', 'resources/js/todos.js', 'resources/js/todoReports.js', 'resources/js/assignorTodoReports.js', 'resources/js/assigneeTodoReports.js', 'resources/js/assigneeTodos.js'])
</head>
<body id="body">
    <div id="app">
        <div class="header">
            <h2 class="header_head">
                @if(Request::segment(1) == 'verify-email')
                    <a class="navbar-brand" href="{{ route('redirectToWelcome') }}">
                @else
                    <a class="navbar-brand" href="{{ url('/') }}">
                @endif
                    <img class="logo" src="{{asset('icons/logo.webp')}}">
                    {{ config('app.name') }}
                </a>
            </h2>
            <p class="header_paragraph">Easily manage all your tasks from one place</p>
        </div>
        <main class="py-4" style="min-height: calc(100vh - 170px); display: flex; align-items: center; justify-content: center; padding-top: 15px !important; padding-bottom: 15px !important;">
            @yield('content')
        </main>
        <div class="footer">
            <h2 class="header_head">Easily manage all your tasks from one place</h2>
            <p class="header_paragraph">&copy;{{ now()->year }} all rights reserved | {{config('app.name')}}</p>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>

    @yield('scripts')

    <script>
        @if(Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch(type){
                case 'info':
                    toastr.info("{{ Session::get('message') }}")
                break;
                case 'warning':
                    toastr.warning("{{ Session::get('message') }}")
                break;
                case 'success':
                    toastr.success("{{ Session::get('message') }}")
                break;
                case 'error':
                    toastr.error("{{ Session::get('message') }}")
                break;
            }
        @endif
    </script>
</body>
</html>
