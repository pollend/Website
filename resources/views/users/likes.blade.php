@extends('users.base')

@section('title')
    <h1>
        Likes of {{ $user->getPresenter()->displayName() }}
    </h1>
@endsection

@section('content')
    @parent

    <div class="text-center">
        {{ $likes->render() }}
    </div>
    <div class="row" id="list">
        @foreach($likes as $key => $like)
            @if($like->getLikeable() != null)
                <div class="col-xs-6 col-sm-4">
                    @include('assets.partials.thumbnail', ['asset' => $like->getLikeable(), 'showLikes' => !$like->getLikeable()->inBuildOff()])
                </div>
            @endif
        @endforeach
    </div>
    <div class="text-center">
        {{ $likes->render() }}
    </div>
@endsection
