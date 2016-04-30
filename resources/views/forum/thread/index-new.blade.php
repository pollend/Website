@extends ('forum.master', ['breadcrumb_other' => trans('forum/threads.new_updated')])

@section('title')
    <h1>
        {{ trans('forum/threads.new_updated') }}
    </h1>
@endsection

@section ('content')
    @if (!$threads->isEmpty())

        <div class="row">
            <div class="col-xs-6 col-sm-8 col-md-9">

            </div>
            <div class="col-xs-2 col-sm-1 col-md-1 text-right">
                {{ trans('forum/general.replies') }}
            </div>
            <div class="col-xs-4 col-sm-3 col-md-2 text-right">
                {{ trans('forum/posts.last') }}
            </div>
        </div>

                @foreach ($threads as $thread)
                    <hr class="v-margin-bot">
                    <div class="row {{ $thread->trashed() ? "deleted" : "" }}">
                        <div class="col-xs-6 col-sm-8 col-md-9">
                            <span class="pull-right">
                                @if ($thread->locked)
                                    <span class="label label-warning">{{ trans('forum/threads.locked') }}</span>
                                @endif
                                @if ($thread->pinned)
                                    <span class="label label-info">{{ trans('forum/threads.pinned') }}</span>
                                @endif
                                @if ($thread->userReadStatus && !$thread->trashed())
                                    <span class="label label-primary">{{ trans($thread->userReadStatus) }}</span>
                                @endif
                                @if ($thread->trashed())
                                    <span class="label label-danger">{{ trans('forum/general.deleted') }}</span>
                                @endif
                            </span>

                                                <p>
                                <span class="{{ $thread->locked ? "locked" : "" }} {{ $thread->pinned ? "pinned" : "" }}">
                                    <a href="{{ $thread->route }}">{{ $thread->title }}</a>
                                </span>
                                <br>
                                {{ $thread->userName }} <span>({{ $thread->posted }})</span>
                            </p>
                        </div>
                        <div class="col-xs-2 col-sm-1 col-md-1 text-right">
                            {{ $thread->replyCount }}
                        </div>
                        <div class="col-xs-4 col-sm-3 col-md-2 text-right">
                            {{ $thread->lastPost->userName }}
                            <p>({{ $thread->lastPost->posted }})</p>
                        </div>
                    </div>
                @endforeach

        @can ('markNewThreadsAsRead')
            <div class="text-center">
                <form action="{{ route('forum.mark-new') }}" method="POST" data-confirm>
                    {!! csrf_field() !!}
                    {!! method_field('patch') !!}
                    <button class="btn btn-primary btn-small">{{ trans('forum/general.mark_read') }}</button>
                </form>
            </div>
        @endcan
    @else
        <p class="text-center">
            {{ trans('forum/threads.none_found') }}
        </p>
    @endif
@stop
