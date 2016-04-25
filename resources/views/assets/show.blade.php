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
                    <a href="{{ $asset->getUser()->getPresenter()->url }}"
                       title="{{ $asset->getUser()->getPresenter()->displayName }}">
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
                    {{ $asset->view_count }}
                </p>
            </div>
            <div class="col-xs-6 text-center" title="Downloads">
                <i class="fa fa-download icon-xl"></i>

                <p>
                    {{ $asset->download_count }}
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
                {{ $asset->like_count }}
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
            {!! $asset->getPresenter()->description !!}
        </div>
    </div>

    <?php
    $stats = $asset->getResource()->getStats();
    $i = 0;
    ?>
    <div class="row">
        <div class="col-sm-4">
            @foreach($asset->getResource()->getPresenter()->getStatGroups() as $groupName => $groupStats)
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>
                            {{ $groupName }}
                        </th>
                        <th>

                        </th>
                    </tr>
                    </thead>
                    @foreach($groupStats as $groupStat)
                        <tr>
                            <td>
                                {{ $stats[$groupStat]['title'] }}
                            </td>
                            <td>
                                {{ $stats[$groupStat]['value'] }}
                            </td>
                        </tr>
                    @endforeach
                </table>
                @if((++$i) % 2 == 0)
        </div>
        <div class="col-sm-4">
            @endif
            @endforeach
        </div>
    </div>

    <div id="comments">
        @if(Auth::check())
            <form method="post" action="{{ route('comments.store') }}">
                {{ csrf_field() }}

                <input type="hidden" name="asset_id" value="{{ $asset->id }}" />

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                    <textarea class="" name="body"></textarea>
                    </div>
                </div>
                <input type="submit" value="Post comment"/>
            </form>
        @endif

        @foreach($comments as $comment)
            <hr>
            <div class="comment">
                <div class="comment-header">
                    @can('update', $comment)
                        <div class="comment-buttons">
                            <a href="{{ route('comments.edit', [$comment->id]) }}" class="btn btn-primary">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <form method="post" action="{{ route('comments.destroy', [$comment->id]) }}">
                                {{ method_field('delete') }}
                                {{ csrf_field() }}

                                <button class="btn btn-primary">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    @endcan
                    <img src="{{ $comment->getUser()->getPresenter()->avatarUrl }}">

                    <a href="{{ $comment->getUser()->getPresenter()->url }}" title="{{ $comment->getUser()->username }}">
                        {{ $comment->getUser()->getPresenter()->displayName }}
                    </a>
                    <br>
                    {{ $comment->getPresenter()->timestamp }}
                </div>
                <div class="comment-body">
                    {!! $comment->getPresenter()->text !!}
                </div>
            </div>
        @endforeach
    </div>
@endsection
