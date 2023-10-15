@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Admin Dashboard') }}</div>

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
                        <li class="menu_items"><a class="menu_links" href="{{route('adminManageTodos')}}">Manage Todos</a></li>
                    </ul>

                    <hr>
                    
                    <div class="manage_supervisors">
                        <h4 class="header">Manage Todos</h4>
                        <div id="todos">
                            <todos />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
