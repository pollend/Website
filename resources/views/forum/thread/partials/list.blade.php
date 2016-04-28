<hr class="v-margin-bot">
<div class="row {{ $thread->trashed() ? "deleted" : "" }}">
    <div class="col-xs-6 col-sm-7 col-md-8">
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
    <div class="col-xs-2 col-sm-1 col-md-1 text-right">
        {{ $thread->views }}
    </div>
    <div class="col-xs-4 col-sm-3 col-md-2 text-right">
        {{ $thread->lastPost->userName }}
        <p>({{ $thread->lastPost->posted }})</p>


        @can ('manageThreads', $category)
            <input type="checkbox" name="items[]" value="{{ $thread->id }}">
        @endcan
    </div>
</div>
