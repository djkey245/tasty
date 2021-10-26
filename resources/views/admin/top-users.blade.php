@extends('voyager::master')
@section('content')

    <div class="table-container">
        <div>
            <h3>Tоп юзера</h3>
            @include('admin.layout.top-users.score-table', ['headers' => ['Place', 'ID', 'Photo', 'Name', 'Points'], 'data' => $topUsersInTable])
        </div>
        <div>
            <h3>Боты</h3>
            @include('admin.layout.top-users.bot-table', ['headers' => ['Number','ID', 'Photo', 'Name', 'Points', 'Open Case'], 'data' => $botList])
        </div>
    </div>
@endsection

@section('css')
    <style>
        .table-container {
            display: flex;
            flex-direction: row;
            gap: 1rem;
            justify-content: stretch;
            padding: 1rem;
        }

        .table-container > * {
            flex-grow: 1;
        }
    </style>
@append
@section('javascript')
    <script src="{{asset('js/open-random-case.js')}}"></script>
@append
