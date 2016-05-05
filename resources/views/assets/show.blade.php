@extends('layouts.columns')

@section('pagetitle')
    {{ $asset->name }} - ParkitectNexus
@endsection

@section('title')
    <h1>
        {{ $asset->name }}
    </h1>
@endsection

@section('sidebar')
    @can('update', $asset)
        <a href="{{ route('assets.manage.update', [$asset->identifier]) }}" class="btn btn-primary btn-block">
            Update
        </a>
    @endcan
    @include('users.partials.profile', ['user' => $asset->getUser()])
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

    <hr>

    <div class="row like"
         likes="{{ $asset->like_count }}"
         type="asset"
         id="{{ $asset->id }}"
         @if(\Auth::check())
         liked="{{ var_export(\Auth::user()->liked($asset), true) }}"
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

    <hr>

    <div id="download-section" class="text-center">
        @if($asset->getPresenter()->canBeDownloaded())
            <a href="{{ $asset->getPresenter()->downloadUrl() }}" class="btn btn-primary btn-block">
                Download
            </a>
        @endif

        @if($asset->getPresenter()->canBeInstalled())
            <a href="{{ $asset->getPresenter()->installUrl() }}" class="btn btn-primary btn-block">
                Install with ParkitectNexus Client
            </a>

            <a href="{{ route('client.download') }}">
                Download client
            </a>
        @endif
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
    @if(count($stats) > 0)
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
    @endif

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
