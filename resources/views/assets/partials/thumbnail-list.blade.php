<div class="text-center">
    {{ $assets->render() }}
</div>
<div class="row" id="list">
    @foreach($assets as $key => $asset)
        <div class="col-xs-6 col-sm-4 item">
            @include('assets.partials.thumbnail', ['asset' => $asset,  'showLikes' => $asset->getBuildOff() == null])
        </div>
    @endforeach
</div>
<div class="text-center">
    {{ $assets->render() }}
</div>