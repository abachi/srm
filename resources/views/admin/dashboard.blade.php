@extends('layout.base')

@section('content')
    <div id="admin-app">
        <router-view />
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
@endsection