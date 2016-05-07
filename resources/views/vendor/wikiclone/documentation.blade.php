@extends('layouts.columns')

{{-- 5 variables are passed to this view, $title, $fileName, $content, $sidebar and $footer --}}

@section('page-title'){{ $title }} - Modding Wiki @endsection

@section('title')
    <h1>
    {{ $title }}
    <small>
    <a class="btn btn-link"
    href="{{ \Ikkentim\WikiClone\GitHubUrls::getWikiEditURL(config('wikiclone.repository'), $fileName) }}">
    <i class="fa fa-github"></i> Edit this page on GitHub
    </a>
    </small>
    </h1>
    <hr>
@endsection

@section('sidebar')
    {!! $sidebar !!}
@endsection

@section('additional-footer')
    <div class="row">
        <div class="col-sm-12">
            {!! $footer !!}
        </div>
    </div>
@endsection

@section('content')
    <h1 id="wiki-title">
        {{ $title }}
        <small>
            <a class="btn btn-link"
               href="{{ \Ikkentim\WikiClone\GitHubUrls::getWikiEditURL(config('wikiclone.repository'), $fileName) }}">
                <i class="fa fa-github"></i> Edit this page on GitHub
            </a>
        </small>
    </h1>
    <hr>
    <div id="wiki-content">
        {!! $content !!}
    </div>
@endsection

@push('js')
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.5/highlight.min.js"></script>
    <script>
        hljs.initHighlightingOnLoad();
    </script>
@endpush

@push('css')
    <link rel="stylesheet" href="{{ elixir('css/wiki.css') }}"/>
@endpush
