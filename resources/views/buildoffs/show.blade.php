@extends('layouts.wide')

@section('title')
    <h1>
        @if(!$buildOff->isOpen())
            [Closed]
        @endif
        {{ $buildOff->name }}
    </h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            {!! $buildOff->getPresenter()->getDescription !!}
        </div>
    </div>

    @if($buildOff->isOpen() && $buildOff->canVote())
        Ends in {{ $buildOff->getPresenter()->getFuzzyEnd() }}
    @elseif($buildOff->isOpen() && !$buildOff->canVote())
        Voting starts in {{ $buildOff->getPresenter()->getFuzzyVotingStart() }}
    @elseif(!$buildOff->isOpen() && $buildOff->canVote())
        Ended {{ $buildOff->getPresenter()->getFuzzyEnd() }}

    @elseif(!$buildOff->isOpen() && !$buildOff->canVote())
        Opens in {{ $buildOff->getPresenter()->getFuzzyStart() }}
    @endif

    @if(!$buildOff->isOpen() && $buildOff->canVote())
        <p>
            Out of
            <strong>{{ $buildOff->getRanks()->count() }}</strong>
            contestants,
            <strong>
                <a href="https://parkitectnexus.com/assets/3bba39453d/the-enigma">
                    {{ $buildOff->getWinner()->getAsset()->name }}
                </a>
            </strong> made by
            <strong><a href="https://parkitectnexus.com/user/lord-gonchar">
                    {{ $buildOff->getWinner()->getAsset()->getUser()->getPresenter()->displayName() }}
                </a>
            </strong>
            has won the competition! Congratulations!
        </p>
    @endif
    <hr>

    <div class="row" id="list">
        @foreach($assets as  $i => $asset)
            <div class="col-sm-4 col-md-3">
                @include('assets.partials.thumbnail', ['asset', $asset, 'showLikes' => !$buildOff->isOpen()])
            </div>
        @endforeach
    </div>
@endsection