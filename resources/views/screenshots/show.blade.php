@extends('layouts.columns')

@section('pagetitle')
    {{ $screenshot->title }} - ParkitectNexus
@endsection

@section('title')
    <h1>
        {{ $screenshot->title }}
    </h1>
@endsection

@section('sidebar')
    @can('update', $screenshot)
        <a href="{{ $screenshot->getPresenter()->editUrl() }}" class="btn btn-info btn-block" title="Update {{ $screenshot->title }}">
            Update screenshot
        </a>
    @endcan
    @can('delete', $screenshot)
        <br>
        <form method="post" action="{{ $screenshot->getPresenter()->deleteUrl() }}" onsubmit="confirmDelete(this, 'Modular Parking Garage Pieces'); return false;">
            {{ csrf_field() }}
            {{ method_field('delete') }}

            <input type="submit" value="Delete screenshot" class="btn btn-warning btn-block">
        </form>
    @endcan
    @include('users.partials.profile', ['user' => $screenshot->getUser()])
    <hr>
    <like likes="{{ $screenshot->like_count }}"
         type="screenshot"
         id="{{ $screenshot->id }}"
         @if(\Auth::check())
         liked="{{ var_export(\Auth::user()->liked($screenshot), true) }}"
            @endif>
    </like>
    <script type="text/html" id="like-template">
        <div class="row">
            @{{ message }}
            <div class="col-xs-6 text-center" title="Views">
                <i class="fa icon-xl" v-bind:class="{ 'fa-heart': isLiked(), 'fa-heart-o': !isLiked() }" @if(\Auth::check()) v-on:click="toggleLike" @endif></i>
            </div>
            <div class="col-xs-6 text-center" title="Downloads">
                <b>
                    @{{ likes }}
                </b>
                <br>
                <span v-if="likes == 1">
                    Person like this
                </span>
                <span v-if="likes != 1">
                    People like this
                </span>
            </div>
        </div>
    </script>
    <br>
    <input type="text" class="form-control" value="{{ url($screenshot->getImage()->getPresenter()->source()) }}" readonly>

    <hr>

    <div class="v-margin">
        {!! Ads::show('sidebar') !!}
    </div>
@endsection

@section('content')
    <a href="{{ route('screenshots.random') }}" class="btn btn-primary btn-block">
        Random screenshot
    </a>

    <hr>

    <img src="{{ $screenshot->getImage()->getPresenter()->source() }}" style="max-width: 100%"/>
@endsection