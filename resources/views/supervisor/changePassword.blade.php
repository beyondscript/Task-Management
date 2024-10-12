@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Supervisor') }}

                    <ul class="menu" style="margin-top: 5px; margin-bottom: 5px;">
                        <li class="menu_items" style="font-size: initial; font-weight: normal;"><a class="menu_links" href="/supervisor-menu" onclick="event.preventDefault()">{{Auth::user()->name}}</a>
                            <ul class="dropdown_menu" style="top: 75px;">
                                <li class="dropdown_menu_items" style="height: 27px;"><a class="dropdown_menu_links" href="{{route('supervisorChangeEmail')}}">Change Email</a></li>
                                <li class="dropdown_menu_items"><a class="dropdown_menu_links" href="{{route('supervisorChangePassword')}}">Change Password</a></li>
                                <li class="dropdown_menu_items">
                                    <button class="dropdown_menu_links" style="border: unset; padding: 0;" type="button" onclick="document.getElementById('logout-form').submit();">
                                        Logout
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                          @csrf
                                        </form>
                                    </button>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul class="menu">
                        <li class="menu_items"><a class="menu_links" href="{{route('supervisorHome')}}">Home</a></li>
                        <li class="menu_items"><a class="menu_links" href="/todo-menu" onclick="event.preventDefault()">Tasks</a>
                            <ul class="dropdown_menu">
                                <li class="dropdown_menu_items"><a class="dropdown_menu_links" href="{{route('addATodo')}}">Add a Task</a></li>
                                <li class="dropdown_menu_items"><a class="dropdown_menu_links" href="{{route('manageTodos')}}">Manage Tasks</a></li>
                            </ul>
                        </li>
                    </ul>

                    <hr>
                    
                    <div class="add_a_supervisor">
                        <h4 class="header">Change Password</h4>

                        <form method="POST" action="{{ route('supervisorUpdatePassword') }}">
                            @csrf
                            @method('patch')

                            <div class="row mb-3">
                                <label for="current_password" class="col-md-4 col-form-label text-md-end">{{ __('Current Password') }}</label>

                                <div class="col-md-6">
                                    <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" autocomplete="current_password">

                                    @error('current_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" style="margin-top: 4px;" type="checkbox" name="show-password" id="show-password" onclick="showPassword()">

                                        <label class="form-check-label" for="show-password">
                                            Show Password
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Change') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function showPassword() {
        checkBox = document.getElementById('show-password')
        if(checkBox.checked === true){
            document.getElementById('current_password').type = 'text'
            document.getElementById('password').type = 'text'
            document.getElementById('password-confirm').type = 'text'
        }
        else if(checkBox.checked === false){
            document.getElementById('current_password').type = 'password'
            document.getElementById('password').type = 'password'
            document.getElementById('password-confirm').type = 'password'
        }
    }
</script>
@endsection
