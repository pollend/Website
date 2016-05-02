@extends('layouts.wide')

@inject('assetCount', 'PN\Assets\AssetCountService')

@section('content')
    <h1>
        Create and discover mods, coasters and parks for Parkitect
    </h1>

    <div class="row">
        <div class="col-md-7">
            <p>
                Here you will find mods, coasters and parks created by players for Parkitect.
                We already have <b>{{ $assetCount->getModCount() }} mods</b>,
                <b>{{ $assetCount->getBlueprintCount() }} blueprints</b> and
                <b>{{ $assetCount->getParkCount() }} parks</b> ready for download!
                It's even easier with the <a href="{{ route('pages.show', ['client']) }}">ParkitectNexus Client</a>
            </p>
        </div>
        <div class="col-md-5 hidden-xs hidden-sm">
            <button href="{{ route('pages.show', ['client']) }}" class="btn btn-primary btn-lg btn-block">
                Download the ParkitectNexus Client
            </button>
        </div>
    </div>

    <hr class="hidden-xs" />

    <div class="row v-margin home-asset-types hidden-xs">
        <div class="col-md-4 border-right asset-type">
            <div class="row">
                <a href="{{route('assets.filter', ['mod'])}}"class="col-xs-5 text-center symbol">
                    <i class="fa fa-wrench v-margin" style="font-size: 110px;"></i>
                    <h2>Mods</h2>
                </a>
                <div class="col-xs-7">
                    <p>
                        Want to go further than the game's limitations?
                        We have {{ $assetCount->getModCount() }} mods for countless hours of fun!
                    </p>
                    <p>
                        <a class="btn btn-default v-margin" href="{{ route('assets.filter', ['mod']) }}" role="button" title="Parks">
                            View all »
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4 border-right asset-type">
            <div class="row">
                <a href="{{route('assets.filter', ['blueprint'])}}"class="col-xs-5 text-center symbol">
                    <i class="fa fa-flask v-margin" style="font-size: 110px;"></i>
                    <h2>Blueprints</h2>
                </a>
                <div class="col-xs-7">
                    <p>
                        If you're not that good at building things,
                        we have {{ $assetCount->getBlueprintCount() }} blueprints ready for download!
                    </p>
                    <p>
                        <a class="btn btn-default v-margin" href="{{ route('assets.filter', ['blueprint']) }}" role="button" title="Parks">
                            View all »
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4 asset-type">
            <div class="row">
                <a href="{{route('assets.filter', ['park'])}}"class="col-xs-5 text-center symbol">
                    <i class="fa fa-save v-margin" style="font-size: 110px;"></i>
                    <h2>Parks</h2>
                </a>
                <div class="col-xs-7">
                    <p>
                        Out of inspiration? We have {{ $assetCount->getParkCount() }} parks to refill your fantasy!
                    </p>
                    <p>
                        <a class="btn btn-default v-margin" href="{{ route('assets.filter', ['park']) }}" role="button" title="Parks">
                            View all »
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <hr />

    <h2>
        Popular assets
    </h2>

    <div class="row" id="list">
        @foreach($popular as $asset)
            <div class="col-xs-6 col-md-3 item">
                @include('assets.partials.thumbnail', ['asset' => $asset])
            </div>
        @endforeach
    </div>

    <h2>
        Newest assets
    </h2>
    <div class="row" id="list">
        @foreach($newest as $asset)
            <div class="col-xs-6 col-md-3 item">
                @include('assets.partials.thumbnail', ['asset' => $asset])
            </div>
        @endforeach
    </div>
@endsection
