{{-- $thread is passed as NULL to the master layout view to prevent it from showing in the breadcrumbs --}}
@extends ('forum.master', ['thread' => null])

@section('title')
    <h1>
        {{ $category->title }}
    </h1>
    @if ($category->description)
        <p>
            {{ $category->description }}
        </p>
    @endif
@endsection

@section ('content')
    <div id="category">
        @can ('createCategories')
            @include ('forum.category.partials.form-create')
        @endcan

        @can ('manageCategories')
            <form action="{{ route('forum.category.update', $category->id) }}" method="POST" data-actions-form>
                {!! csrf_field() !!}
                {!! method_field('patch') !!}

                @include ('forum.category.partials.actions')
            </form>
        @endcan

        @if ($category->threadsEnabled)
            @can ('createThreads', $category)
            <a href="{{ $category->newThreadRoute }}" class="btn btn-primary">{{ trans('forum/threads.new_thread') }}</a>
            @endcan
        @endif

        @if (!$category->children->isEmpty())
            <div class="row">
                <div class="col-xs-7 col-md-5">

                </div>
                <div class="col-md-1 hidden-xs hidden-small hidden-medium">
                    {{ trans_choice('forum/threads.thread', 2) }}
                </div>
                <div class="col-md-1 hidden-xs hidden-small hidden-medium">
                    {{ trans_choice('forum/posts.post', 2) }}
                </div>
                <div class="col-md-3 hidden-xs hidden-small hidden-medium">
                    {{ trans('forum/threads.newest') }}
                </div>
                <div class="col-xs-5 col-md-3">
                    {{ trans('forum/posts.last') }}
                </div>
            </div>
            @foreach ($category->children as $subcategory)
                <hr>
                @include ('forum.category.partials.list', ['category' => $subcategory])
            @endforeach
        @endif

        {!! $category->threadsPaginated->render() !!}

        @can ('manageThreads', $category)
            <form action="{{ route('forum.bulk.thread.update') }}" method="POST" data-actions-form>
                {!! csrf_field() !!}
                {!! method_field('delete') !!}
        @endcan

        @if ($category->threadsEnabled)
            <div class="row">
                <div class="col-xs-6 col-sm-7 col-md-8">

                </div>
                <div class="col-xs-2 col-sm-1 col-md-1 text-right">
                    {{ trans('forum/general.replies') }}
                </div>
                <div class="col-xs-2 col-sm-1 col-md-1 text-right">
                    {{ trans('forum/threads.views') }}
                </div>
                <div class="col-xs-4 col-sm-3 col-md-2 text-right">
                    {{ trans('forum/posts.last') }}
                </div>
            </div>


            @if (!$category->threadsPaginated->isEmpty())
                @foreach ($category->threadsPaginated as $thread)
                    @include('forum.thread.partials.list')
                @endforeach
            @endif
        @endif

        @can ('manageThreads', $category)
                @include ('forum.category.partials.thread-actions')
            </form>
        @endcan

        <div class="row">
            <div class="col-xs-4">
                @if ($category->threadsEnabled)
                    @can ('createThreads', $category)
                        <a href="{{ $category->newThreadRoute }}" class="btn btn-primary">{{ trans('forum/threads.new_thread') }}</a>
                    @endcan
                @endif
            </div>
            <div class="col-xs-8 text-right">
                {!! $category->threadsPaginated->render() !!}
            </div>
        </div>

        @if ($category->threadsEnabled)
            @can ('markNewThreadsAsRead')
                <hr>
                <div class="text-center">
                    <form action="{{ route('forum.mark-new') }}" method="POST" data-confirm>
                        {!! csrf_field() !!}
                        {!! method_field('patch') !!}
                        <input type="hidden" name="category_id" value="{{ $category->id }}">
                        <button class="btn btn-default btn-small">{{ trans('forum/categories.mark_read') }}</button>
                    </form>
                </div>
            @endcan
        @endif
    </div>
@stop
