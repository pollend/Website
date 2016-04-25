@extends('layouts.wide')

@section('title')
    <h1>
        {{ $page->title }}
    </h1>
@endsection

@section('content')
    {!! $page->getPresenter()->getContent() !!}
@endsection