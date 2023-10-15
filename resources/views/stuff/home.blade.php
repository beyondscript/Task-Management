@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul class="menu">
                        <li class="menu_items"><a class="menu_links" href="{{route('home')}}">Home</a></li>
                        <li class="menu_items"><a class="menu_links" href="{{route('assignedTodos')}}">Assigned Todos</a></li>
                    </ul>

                    <hr>

                    <div class="manage_supervisors">
                        <h4 class="header">Todo Reports</h4>
                        <div id="assigneeTodoReports">
                            <assigneetodoreports />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
