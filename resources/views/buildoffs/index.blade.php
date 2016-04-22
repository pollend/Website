@extends('layouts.wide')

@section('title')
    <h1>
        {{ $buildOffPage->title }}
    </h1>
@endsection

@section('content')
    {!! $buildOffPage->getPresenter()->getContent() !!}

    @foreach($buildOffs as $buildOff)
        @include('buildoffs.partials.buildoff', ['buildOff' => $buildOff])
    @endforeach
@endsection