@extends('layouts.master')

@section('fullcontent')
    <div class="col-sm-12" id="content">
        @yield('title')

        @include('partials.errors')

        @yield('content')
    </div>
@endsection
