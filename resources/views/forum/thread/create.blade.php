@extends ('forum.master', ['breadcrumb_other' => trans('forum/threads.new_thread')])

@section('title')
    <h1>{{ trans('forum/threads.new_thread') }} ({{ $category->title }})</h1>
@endsection

@section ('content')
    <form method="POST" action="{{ route('forum.thread.store', $category->id) }}">
        {!! csrf_field() !!}
        {!! method_field('post') !!}

        <div class="form-group">
            <label for="title">{{ trans('forum/general.title') }}</label>
            <input type="text" name="title" value="{{ old('title') }}" class="form-control">
        </div>

        <p>
            Markdown supported
        </p>
        <div class="form-group">
            <textarea name="content" class="form-control markdown" rows="10">{{ old('content') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success pull-right">{{ trans('forum/general.create') }}</button>
        <a href="{{ URL::previous() }}" class="btn btn-default">{{ trans('forum/general.cancel') }}</a>
    </form>
@stop
