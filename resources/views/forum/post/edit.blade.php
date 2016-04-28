@extends ('forum.master', ['breadcrumb_other' => trans('forum/posts.edit')])

@section('title')
    <h1>{{ trans('forum/posts.edit') }} ({{ $thread->title }})</h1>
@endsection

@section ('content')
    @if (!$post->isFirst)
        @can ('delete', $post)
            <form action="{{ route('forum.post.update', $post->id) }}" method="POST" data-actions-form>
                {!! csrf_field() !!}
                {!! method_field('delete') !!}

                @include ('forum.post.partials.actions')
            </form>
        @endcan
    @endif

    @if ($post->parent)
        <h3>{{ trans('forum/general.response_to', ['item' => $post->parent->userName]) }}...</h3>

        @include ('forum.post.partials.excerpt', ['post' => $post->parent])
    @endif

    <form method="POST" action="{{ route('forum.post.update', $post->id) }}">
        {!! csrf_field() !!}
        {!! method_field('patch') !!}

        <p>
            Markdown supported
        </p>
        <div class="form-group">
            <textarea name="content" class="form-control markdown" rows="10">{{ !is_null(old('content')) ? old('content') : $post->content }}</textarea>
        </div>

        <button type="submit" class="btn btn-success pull-right">{{ trans('forum/general.proceed') }}</button>
        <a href="{{ URL::previous() }}" class="btn btn-default">{{ trans('forum/general.cancel') }}</a>
    </form>
@stop
