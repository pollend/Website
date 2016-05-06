@extends('layouts.columns')

@section('sidebar')
    @include('assets.partials.filters', ['filters' => $filters, 'tags' => $tags])

    <hr>

    <div class="v-margin">
        {!! Ads::show('sidebar') !!}
    </div>
@endsection

@section('title')
    <h1>
        All {{ ucfirst($type) }}s
    </h1>
@endsection

@section('content')
    {!! $assetList !!}
@endsection
