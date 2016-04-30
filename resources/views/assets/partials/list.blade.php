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
</p>

<p>
    <a @if(request('range') != 'week')href="{{ route('assets.filter', [$type] + Request::except(['range', 'page']) + ['range' => 'week']) }}"@endif>
        Week
    </a>
    |
    <a @if(request('range') != 'month')href="{{ route('assets.filter', [$type] + Request::except(['range', 'page']) + ['range' => 'month']) }}"@endif>
        Month
    </a>
    |
    <a @if(request('range') != 'quarter')href="{{ route('assets.filter', [$type] + Request::except(['range', 'page']) + ['range' => 'quarter']) }}"@endif>
        Quarter
    </a>
    |
    <a @if(request('range') != 'year')href="{{ route('assets.filter', [$type] + Request::except(['range', 'page']) + ['range' => 'year']) }}"@endif>
        Year
    </a>
    |
    <a @if(request('range') != 'alltime')href="{{ route('assets.filter', [$type] + Request::except(['range', 'page']) + ['range' => 'alltime']) }}"@endif>
        All time
    </a>
</p>
<hr>
@include('assets.partials.thumbnail-list', ['assets' => $assets])