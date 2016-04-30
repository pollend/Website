@extends('users.base')

@section('title')
    <h1>
        Profile of {{ $user->getPresenter()->displayName() }}
    </h1>
@endsection

@section('content')
    @parent

    @include('assets.partials.thumbnail-list')
@endsection