@extends('layouts.columns')

@section('sidebar')
    @include('users.partials.profile')

    <p>
        <b>Registered</b>

        {{ $user->getPresenter()->registrationDate() }}
    </p>

    <br>

    @if($user->hasTwitter())
        <p>
            <b>Twitter</b>
            <a href="{{ $user->getPresenter()->twitterUrl() }}">
                &#64;{{ $user->twitter }}
            </a>
        </p>
    @endif
    @if($user->hasTwitch())
        <p>
            <b>Twitch</b>
            <a href="{{ $user->getPresenter()->twitchUrl() }}">
                {{ $user->twitch }}
            </a>
        </p>
    @endif
    @if($user->hasSteam())
        <p>
            <b>Steam</b>
            <a href="{{ $user->getPresenter()->steamUrl() }}">
                profile
            </a>
        </p>
    @endif

    <br>

    @if($user->hasPaypal())
        <p>
            <b>Paypal</b>
            <a href="{{ $user->getPresenter()->paypalUrl() }}">
                {{ $user->paypal }}
            </a>
        </p>
    @endif
    @if($user->hasBitcoin())
        <p>
            <b>Bitcoin</b>
            <a href="{{ $user->getPresenter()->bitcoinUrl() }}">
                {{ str_limit($user->bitcoin, 10, '...') }}
            </a>
        </p>
    @endif
@endsection

@section('content')
    @include('users.partials.tabs')
    <br>
@endsection