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
                    
                    <div class="manage_supervisors">
                        <h4 class="header">Manage Tasks</h4>
                        <div id="assignorTodos">
                            <assignorTodos />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
