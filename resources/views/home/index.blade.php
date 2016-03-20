@extends('layouts.wide')

@section('content')
    <div class="row" id="list">
        @foreach($popular as $asset)
            <div class="col-sm-12 col-md-6 col-lg-3">
                @include('assets.partials.thumbnail', ['asset' => $asset])
            </div>
        @endforeach
    </div>

    <div class="row" id="list">
        @foreach($newest as $asset)
            <div class="col-sm-12 col-md-6 col-lg-3">
                @include('assets.partials.thumbnail', ['asset' => $asset])
            </div>
        @endforeach
    </div>
@endsection
