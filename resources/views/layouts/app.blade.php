<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/x-icon" href="{{asset('icons/favicon.webp')}}">

    <title>{{ config('app.name', 'Laravel') }}</title>

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
        <nav id="navbar" class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div id="navbar_container" class="container">
                @if(Request::segment(2) == 'verify')
                    <a class="navbar-brand" href="{{ route('redirectToWelcome') }}">
                @else
                    <a class="navbar-brand" href="{{ url('/') }}">
                @endif
                    <img class="logo" src="{{asset('icons/favicon.webp')}}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @if(Auth::user()->type == 'admin')
                                        <a class="dropdown-item" href="{{route('adminChangeEmail')}}">Change Email</a>
                                        <a class="dropdown-item" href="{{route('adminChangePassword')}}">Change Password</a>
                                    @elseif(Auth::user()->type == 'supervisor')
                                        <a class="dropdown-item" href="{{route('supervisorChangeEmail')}}">Change Email</a>
                                        <a class="dropdown-item" href="{{route('supervisorChangePassword')}}">Change Password</a>
                                    @elseif(Auth::user()->type == 'stuff')
                                        <a class="dropdown-item" href="{{route('changeEmail')}}">Change Email</a>
                                        <a class="dropdown-item" href="{{route('changePassword')}}">Change Password</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('customLogout') }}"
                                       onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                                       {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('customLogout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
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
