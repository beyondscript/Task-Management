@extends('layouts.app')

@section('page_design', 'modern_page workspace_page')

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
                                <li @class(['dropdown_menu_items', 'active' => request()->routeIs('adminChangeEmail')]) style="height: 27px;"><a class="dropdown_menu_links" href="{{route('adminChangeEmail')}}" @if(request()->routeIs('adminChangeEmail')) aria-current="page" @endif>Change Email</a></li>
                                <li @class(['dropdown_menu_items', 'active' => request()->routeIs('adminChangePassword')])><a class="dropdown_menu_links" href="{{route('adminChangePassword')}}" @if(request()->routeIs('adminChangePassword')) aria-current="page" @endif>Change Password</a></li>
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
                        <li @class(['menu_items', 'active' => request()->routeIs('adminHome')])><a class="menu_links" href="{{route('adminHome')}}" @if(request()->routeIs('adminHome')) aria-current="page" @endif>Home</a></li>
                        <li class="menu_items"><a class="menu_links" href="/supervisor-menu" onclick="event.preventDefault()">Supervisor</a>
                            <ul class="dropdown_menu">
                                <li @class(['dropdown_menu_items', 'active' => request()->routeIs('addASupervisor')])><a class="dropdown_menu_links" href="{{route('addASupervisor')}}" @if(request()->routeIs('addASupervisor')) aria-current="page" @endif>Add a Supervisor</a></li>
                                <li @class(['dropdown_menu_items', 'active' => request()->routeIs('manageSupervisors')])><a class="dropdown_menu_links" href="{{route('manageSupervisors')}}" @if(request()->routeIs('manageSupervisors')) aria-current="page" @endif>Manage Supervisors</a></li>
                            </ul>
                        </li>
                        <li @class(['menu_items', 'active' => request()->routeIs('adminManageTodos')])><a class="menu_links" href="{{route('adminManageTodos')}}" @if(request()->routeIs('adminManageTodos')) aria-current="page" @endif>Manage Tasks</a></li>
                    </ul>

                    <hr>
                    
                    <div class="manage_supervisors">
                        <h4 class="header">Manage Supervisors</h4>
                        <div id="supervisors" class="data_table_frame">
                            <supervisors>
                                @include('layouts.loading', ['label' => 'Loading table…'])
                            </supervisors>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
