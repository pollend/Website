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
                    <a href="{{ $asset->getUser()->getPresenter()->url }}" title="{{ $asset->getUser()->getPresenter()->displayName }}">
                        {{ $asset->getUser()->getPresenter()->displayName }}
                    </a>
                </h2>
                @if($asset->getUser()->getPresenter()->hasFlair)
                    <span class="label label-primary">
                        {{ $asset->getUser()->flair }}
                    </span>
                @endif
            </div>

            <p class="user-statistics">
                {{ $asset->getUser()->getPresenter()->uploadCount }} Uploads
                <br>
                {{ $asset->getUser()->getPresenter()->postCount }} Posts
                <br>
                {{ $asset->getUser()->getPresenter()->likeCount }} Likes
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
        @if($asset->getPresenter()->downloadable)
            <a href="{{ $asset->getPresenter()->downloadUrl }}" class="btn btn-primary btn-block">
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
    @include('assets.partials.slider', ['asset' => $asset])

    <hr>

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
            @foreach($asset->getResource()->getStats() as $stat)
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

    <div id="comments">
        @foreach($asset->getComments() as $comment)
            <hr>
            <div class="comment">
                <div class="comment-header">
                    <div class="comment-buttons">
                    </div>
                    <img src="{{ $comment->getUser()->getPresenter()->avatarUrl }}">
                    <a href="https://parkitectnexus.com/user/Topkek" title="Topkek">
                        {{ $comment->getUser()->getPresenter()->displayName }}
                    </a>
                    <br>
                    {{ $comment->getPresenter()->timestamp }}
                </div>
                <div class="comment-body" id="comment-07c047b074">
                    {{ $comment->body }}
                </div>
            </div>
        @endforeach
    </div>
@endsection
