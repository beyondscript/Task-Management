@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Supervisor Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul class="menu">
                        <li class="menu_items"><a class="menu_links" href="{{route('supervisorHome')}}">Home</a></li>
                        <li class="menu_items"><a class="menu_links" href="/todo-menu" onclick="event.preventDefault()">Todo</a>
                            <ul class="dropdown_menu">
                                <li class="dropdown_menu_items"><a class="dropdown_menu_links" href="{{route('addATodo')}}">Add a Todo</a></li>
                                <li class="dropdown_menu_items"><a class="dropdown_menu_links" href="{{route('manageTodos')}}">Manage Todos</a></li>
                            </ul>
                        </li>
                    </ul>

                    <hr>

                    <div class="manage_supervisors">
                        <h4 class="header">Todo Reports</h4>
                        <div id="assignorTodoReports">
                            <assignortodoreports />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
