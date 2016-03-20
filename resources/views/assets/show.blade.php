@extends('layouts.columns')

@section('title')
    <h1>
        {{ $asset->name }}
    </h1>
@endsection

@section('sidebar')
    <div class="user-profile v-margin">
        <div class="avatar">
            <img src="https://www.gravatar.com/avatar/dece92269306c1b79fbd0a1c639bffcf?s=128&amp;d=https%3A%2F%2Fparkitectnexus.com%2Fimg%2Favatar-default.png">
        </div>

        <div class="user-detail">
            <div class="username">
                <h2>
                    <a href="{{ $asset->user->presenter()->url }}" title="{{ $asset->user->presenter()->displayName }}">
                        {{ $asset->user->presenter()->displayName }}
                    </a>
                </h2>
                @if($asset->user->presenter()->hasFlair)
                    <span class="label label-primary">
                        {{ $asset->user->flair }}
                    </span>
                @endif
            </div>

            <p class="user-statistics">
                {{ $asset->user->presenter()->uploadCount }} Uploads
                <br>
                {{ $asset->user->presenter()->postCount }} Posts
                <br>
                {{ $asset->user->presenter()->likeCount }} Likes
            </p>
        </div>

        <hr>

        <div class="row">
            <div class="col-xs-6 text-center border-right" title="Views">
                <i class="fa fa-eye icon-xl"></i>
                <p>
                    {{ $asset->views }}
                </p>
            </div>
            <div class="col-xs-6 text-center" title="Downloads">
                <i class="fa fa-download icon-xl"></i>
                <p>
                    {{ $asset->downloads }}
                </p>
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-xs-6 text-center" title="Views">
            <i class="fa fa-heart icon-xl"></i>
        </div>
        <div class="col-xs-6 text-center" title="Downloads">
            <b>
                {{ $asset->likes }}
            </b>
            <p>
                People like this
            </p>
        </div>
    </div>

    <hr>

    <div id="download-section" class="text-center">
        @if($asset->presenter()->downloadable)
            <a href="{{ $asset->presenter()->downloadUrl }}" class="btn btn-primary btn-block">
                Download
            </a>
        @endif

        <a href="#" class="btn btn-primary btn-block">
            Install with ParkitectNexus Client
        </a>

        <a href="#">
            Download client
        </a>
    </div>

    <h2>
        Tags
    </h2>
    <ul>
        @foreach($asset->tags as $tag)
            <li>
                {{ $tag->tag }}
            </li>
        @endforeach
    </ul>
@endsection

@section('content')
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            @foreach($asset->album->images as $key => $image)
                <div class="item @if($key == 0) active @endif">
                    <img src="{{ $image->presenter()->source }}"/>
                </div>
            @endforeach
        </div>

        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>


    <div class="row">
    </div>
    @foreach($asset->album->images as $key => $image)
        <div class="col-sm-2">
            <img data-target="#carousel-example-generic" data-slide-to="{{ $key }}" width="100%"
                 src="{{ $image->presenter()->source }}"/>
        </div>
    @endforeach

    <div class="row">
        <div class="col-sm-12">
            {{ $asset->description }}
        </div>
    </div>

    <div class="well">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>

                    </th>
                    <th>
                        Value
                    </th>
                </tr>
            </thead>
            @foreach($asset->getStats() as $stat)
                <tr>
                    <td>
                        {{ $stat['title'] }}
                    </td>
                    <td>
                        {{ $stat['value'] }}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="row">
        <div class="col-sm-12">
            @foreach($asset->comments as $comment)
                <hr>
                <div class="row">
                    <div class="col-sm-2">
                        {{ $comment->user->presenter()->displayName }}
                        <br>
                        {{ $comment->presenter()->timestamp }}
                    </div>
                    <div class="col-sm-10">
                        {{ $comment->body }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
