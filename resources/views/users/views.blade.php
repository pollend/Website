@extends('users.base')

@section('title')
    <h1>
        Recent views of {{ $user->getPresenter()->displayName() }}
    </h1>
@endsection

@section('content')
    @parent

    <div class="text-center">
        {{ $views->render() }}
    </div>
    <div class="row" id="list">
        @foreach($views as $key => $view)
            <div class="col-xs-6 col-sm-4">
                @include('assets.partials.thumbnail', ['asset' => $view->getViewable()])
            </div>
        @endforeach
    </div>
    <div class="text-center">
        {{ $views->render() }}
    </div>
@endsection