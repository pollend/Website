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