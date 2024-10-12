@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Admin') }}

                    <ul class="menu" style="margin-top: 5px; margin-bottom: 5px;">
                        <li class="menu_items" style="font-size: initial; font-weight: normal;"><a class="menu_links" href="/admin-menu" onclick="event.preventDefault()">{{Auth::user()->name}}</a>
                            <ul class="dropdown_menu" style="top: 75px;">
                                <li class="dropdown_menu_items" style="height: 27px;"><a class="dropdown_menu_links" href="{{route('adminChangeEmail')}}">Change Email</a></li>
                                <li class="dropdown_menu_items"><a class="dropdown_menu_links" href="{{route('adminChangePassword')}}">Change Password</a></li>
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
                        <li class="menu_items"><a class="menu_links" href="{{route('adminHome')}}">Home</a></li>
                        <li class="menu_items"><a class="menu_links" href="/supervisor-menu" onclick="event.preventDefault()">Supervisor</a>
                            <ul class="dropdown_menu">
                                <li class="dropdown_menu_items"><a class="dropdown_menu_links" href="{{route('addASupervisor')}}">Add a Supervisor</a></li>
                                <li class="dropdown_menu_items"><a class="dropdown_menu_links" href="{{route('manageSupervisors')}}">Manage Supervisors</a></li>
                            </ul>
                        </li>
                        <li class="menu_items"><a class="menu_links" href="{{route('adminManageTodos')}}">Manage Tasks</a></li>
                    </ul>

                    <hr>
                    
                    <div class="add_a_supervisor">
                        <h4 class="header">Change Email</h4>

                        <form method="POST" action="{{ route('adminUpdateEmail') }}">
                            @csrf
                            @method('patch')

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Current Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
			document.getElementById('password').type = 'text'
		}
		else if(checkBox.checked === false){
			document.getElementById('password').type = 'password'
		}
    }
</script>
@endsection
