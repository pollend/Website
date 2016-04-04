@extends('layouts.columns')

@section('sidebar')
    @include('assets.partials.filters', ['filters' => $filters, 'tags' => $tags])
@endsection

@section('content')
    <h1>
        All {{ ucfirst($type) }}s
    </h1>
    <p>
        Order by:

        <a @if(request('sort') != 'hot_score')href="{{ route('assets.filter', [$type] + Request::except(['sort', 'page']) + ['sort' => 'hot_score']) }}"@endif>
            Hot
        </a>
         |
        <a @if(request('sort') != 'best')href="{{ route('assets.filter', [$type] + Request::except(['sort', 'page']) + ['sort' => 'best']) }}"@endif>
            Best
        </a>
         |
        <a @if(request('sort') != 'newest')href="{{ route('assets.filter', [$type] + Request::except(['sort', 'page']) + ['sort' => 'newest']) }}"@endif>
            Newest
        </a>
         |
        <a @if(request('sort') != 'views')href="{{ route('assets.filter', [$type] + Request::except(['sort', 'page']) + ['sort' => 'views']) }}"@endif>
            Views
        </a>
         |
        <a @if(request('sort') != 'downloads')href="{{ route('assets.filter', [$type] + Request::except(['sort', 'page']) + ['sort' => 'downloads']) }}"@endif>
            Downloads
        </a>
    </p>

    <p>
        <a @if(request('range') != 'week')href="{{ route('assets.filter', [$type] + Request::except(['range', 'page']) + ['range' => 'week']) }}"@endif>
            This Week
        </a>
         |
        <a @if(request('range') != 'month')href="{{ route('assets.filter', [$type] + Request::except(['range', 'page']) + ['range' => 'month']) }}"@endif>
            This Month
        </a>
         |
        <a @if(request('range') != 'alltime')href="{{ route('assets.filter', [$type] + Request::except(['range', 'page']) + ['range' => 'alltime']) }}"@endif>
            All time
        </a>
    </p>
    <hr>
    <div class="text-center">
        {{ $assets->render() }}
    </div>
    <div class="row" id="list">
        @foreach($assets as $key => $asset)
            <div class="col-xs-6 col-sm-4">
                @include('assets.partials.thumbnail', ['asset' => $asset])
            </div>
        @endforeach
    </div>
    <div class="text-center">
        {{ $assets->render() }}
    </div>
@endsection
