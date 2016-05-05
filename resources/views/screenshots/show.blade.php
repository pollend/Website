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
        <br>
        <form method="post" action="{{ $screenshot->getPresenter()->deleteUrl() }}" onsubmit="confirmDelete(this, 'Modular Parking Garage Pieces'); return false;">
            {{ csrf_field() }}
            {{ method_field('delete') }}

            <input type="submit" value="Delete screenshot" class="btn btn-warning btn-block">
        </form>
        @include('users.partials.profile', ['user' => $screenshot->getUser()])
        <hr>
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
@endsection

@section('content')
    <a href="{{ route('screenshots.random') }}" class="btn btn-primary btn-block">
        Random screenshot
    </a>

    <hr>

    <img src="{{ $screenshot->getImage()->getPresenter()->source() }}" style="max-width: 100%"/>
@endsection