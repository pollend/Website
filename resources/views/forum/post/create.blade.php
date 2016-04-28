@extends ('forum.master', ['breadcrumb_other' => trans('forum/general.new_reply')])

@section('title')
    <h1>{{ trans('forum/general.new_reply') }}
    </h1>
    <p>
        {{ $thread->title }}
    </p>
@endsection

@section ('content')
    @if (!is_null($post) && !$post->trashed())
        <h3>{{ trans('forum/general.replying_to', ['item' => $post->userName]) }}...</h3>

        @include ('forum.post.partials.excerpt')
    @endif

    <form method="POST" action="{{ route('forum.post.store', $thread->id) }}">
        {!! csrf_field() !!}
        @if (!is_null($post))
            <input type="hidden" name="post_id" value="{{ $post->id }}">
        @endif

        <p>
            Markdown supported
        </p>
        <div class="form-group">
            <textarea name="content" class="form-control markdown" rows="10">{{ old('content') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success pull-right">{{ trans('forum/general.reply') }}</button>
        <a href="{{ URL::previous() }}" class="btn btn-default">{{ trans('forum/general.cancel') }}</a>
    </form>
@stop
