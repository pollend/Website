@extends('users.base')

@section('title')
    <h1>
        Recent downloads of {{ $user->getPresenter()->displayName() }}
    </h1>
@endsection

@section('content')
    @parent

    <div class="text-center">
        {{ $downloads->render() }}
    </div>
    <div class="row" id="list">
        @foreach($downloads as $key => $download)
            <div class="col-xs-6 col-sm-4">
                @include('assets.partials.thumbnail', ['asset' => $download->getDownloadable()])
            </div>
        @endforeach
    </div>
    <div class="text-center">
        {{ $downloads->render() }}
    </div>
@endsection