@extends('layouts.wide')

@section('title')
    <h1>
        Screenshots
    </h1>
@endsection

@section('content')
    <div class="alert alert-info">
        To upload screenshots, you need the <a href="https://parkitectnexus.com/assets/53ce78e941/screenshotr">Screenshotr</a> mod.
    </div>

    <div class="text-center">
        {{ $screenshots->render() }}
    </div>
    
    <div class="row">
        @foreach($screenshots as $screenshot)
            <div class="col-sm-6 col-md-3">
                <div class="thumbnail screenshot">
                    <a href="{{ $screenshot->getPresenter()->url }}" title="{{ $screenshot->title }}">
                        <img src="{{ $screenshot->getImage()->getPresenter()->source(263, 263) }}" alt="{{ $screenshot->title }}">
                    </a>
                    <div class="caption">
                        <a href="{{ $screenshot->getPresenter()->url }}" title="{{ $screenshot->title }}">
                            {{ \Illuminate\Support\Str::limit($screenshot->title, 30) }}
                        </a>
                        <br>
                        Shot by:
                        <a href="{{ $screenshot->getUser()->getPresenter()->url() }}" title="{{ $screenshot->getUser()->getPresenter()->displayName() }}">{{ $screenshot->getUser()->getPresenter()->displayName() }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="text-center">
        {{ $screenshots->render() }}
    </div>
@endsection