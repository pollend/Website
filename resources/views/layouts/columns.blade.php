@extends('layouts.master')

@section('fullcontent')
    <div class="col-lg-3 col-sm-12" id="sidebar">
        @yield('sidebar')
    </div>

    <div class="col-lg-9 col-sm-12" id="content">
        <div class="row">
            <div class="col-sm-12" id="title">
                @yield('title')
            </div>
        </div>
        @include('partials.errors')

        @yield('content')
    </div>
@endsection
