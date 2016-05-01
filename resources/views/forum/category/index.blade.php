{{-- $category is passed as NULL to the master layout view to prevent it from showing in the breadcrumbs --}}
@extends ('forum.master', ['category' => null])

@section('title')
    <h1>
        {{ trans('forum/general.index') }}
    </h1>
@endsection

@section ('content')
    @can ('createCategories')
        @include ('forum.category.partials.form-create')
    @endcan

    <div class="row">
        <div class="col-xs-7 col-md-4">

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

    @foreach ($categories as $category)
        @include ('forum.category.partials.list', ['titleClass' => 'lead'])
    @endforeach
@stop
