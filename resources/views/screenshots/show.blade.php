@extends('layouts.columns')

@section('title')
    <h1>
        {{ $screenshot->title }}
    </h1>
@endsection

@section('sidebar')
        <a href="{{ $screenshot->getPresenter()->editUrl() }}" class="btn btn-info btn-block" title="Update {{ $screenshot->title }}">
            Update screenshot
        </a>
        <form method="post" action="{{ $screenshot->getPresenter()->deleteUrl() }}" onsubmit="confirmDelete(this, 'Modular Parking Garage Pieces'); return false;">
            {{ csrf_field() }}
            {{ method_field('delete') }}

            <input type="submit" value="Delete screenshot" class="btn btn-warning btn-block">
        </form>
        <div class="user-profile v-margin">
            <div class="avatar">
                <img src="{{ $screenshot->getUser()->getPresenter()->avatarUrl() }}">
            </div>
            <div class="user-detail">
                <div class="username">
                    <h2>
                        <a href="{{ $screenshot->getUser()->getPresenter()->url() }}" title="{{ $screenshot->getUser()->getPresenter()->displayName() }}">
                            {{ $screenshot->getUser()->getPresenter()->displayName() }}
                        </a>
                    </h2>
                    <span class="user-flair">
                    {{ $screenshot->getUser()->rank }}
                    </span>
                </div>
                <p class="user-statistics">
                    {{ $screenshot->getUser()->asset_count }} Uploads
                    <br>
                    {{ $screenshot->getUser()->post_count }}  Posts
                    <br>
                    {{ $screenshot->getUser()->like_count }}  Likes
                </p>
            </div>
        </div>

        <div class="row like"
             likes="{{ $screenshot->like_count }}"
             type="screenshot"
             id="{{ $screenshot->id }}"
             @if(\Auth::check())
             liked="{{ var_export(\Auth::user()->liked($screenshot), true) }}"
                @endif>
            @{{ message }}
            <div class="col-xs-6 text-center" title="Views">
                <i class="fa icon-xl" v-bind:class="{ 'fa-heart': isLiked(), 'fa-heart-o': !isLiked() }" v-on:click="toggleLike"></i>
            </div>
            <div class="col-xs-6 text-center" title="Downloads">
                <b>
                    @{{ likes }}
                </b>

                <p v-if="likes == 1">
                    Person like this
                </p>
                <p v-if="likes != 1">
                    People like this
                </p>
            </div>
        </div>
        <br>
        <input type="text" class="form-control" value="{{ url($screenshot->getImage()->getPresenter()->source()) }}" readonly>
        <hr>
        <div class="v-margin">
            <script async="" src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

            <ins class="adsbygoogle" style="display:block;" data-ad-client="ca-pub-2512015227578629" data-ad-slot="4653116427" data-ad-format="auto"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
@endsection

@section('content')
    <a href="{{ route('screenshots.random') }}" class="btn btn-primary btn-block">
        Random screenshot
    </a>

    <hr>

    <img src="{{ $screenshot->getImage()->getPresenter()->source() }}" />
@endsection