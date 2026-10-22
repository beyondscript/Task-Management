@extends('layouts.app')

@section('page_design', 'modern_page workspace_page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Staff') }}

                    <ul class="menu" style="margin-top: 5px; margin-bottom: 5px;">
                        <li class="menu_items" style="font-size: initial; font-weight: normal;"><a class="menu_links" href="/stuff-menu" onclick="event.preventDefault()">{{Auth::user()->name}}</a>
                            <ul class="dropdown_menu" style="top: 75px;">
                                <li @class(['dropdown_menu_items', 'active' => request()->routeIs('changeEmail')]) style="height: 27px;"><a class="dropdown_menu_links" href="{{route('changeEmail')}}" @if(request()->routeIs('changeEmail')) aria-current="page" @endif>Change Email</a></li>
                                <li @class(['dropdown_menu_items', 'active' => request()->routeIs('changePassword')])><a class="dropdown_menu_links" href="{{route('changePassword')}}" @if(request()->routeIs('changePassword')) aria-current="page" @endif>Change Password</a></li>
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
                        <li @class(['menu_items', 'active' => request()->routeIs('home')])><a class="menu_links" href="{{route('home')}}" @if(request()->routeIs('home')) aria-current="page" @endif>Home</a></li>
                        <li @class(['menu_items', 'active' => request()->routeIs('assignedTodos')])><a class="menu_links" href="{{route('assignedTodos')}}" @if(request()->routeIs('assignedTodos')) aria-current="page" @endif>Assigned Tasks</a></li>
                    </ul>

                    <hr>

                    <div class="manage_supervisors">
                        <h4 class="header">Task Reports</h4>
                        <div id="assigneeTodoReports">
                            <assigneetodoreports>
                                @include('layouts.loading', ['label' => 'Loading reports…'])
                            </assigneetodoreports>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
