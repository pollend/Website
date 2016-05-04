@extends('layouts.wide')

@section('title')
    <h1>
        {{ $page->title }}
    </h1>
@endsection

@section('content')
    @yield('download')
    {!! \PN\Social\MarkdownParser::parse($page->content) !!}

    <div class="row">
        <div class="col-sm-6">
            <img src="/img/client-screenshot-1.png" width="100%">
        </div>
        <div class="col-sm-6">
            <img src="/img/client-screenshot-2.png" width="100%">
        </div>
    </div>
@endsection
