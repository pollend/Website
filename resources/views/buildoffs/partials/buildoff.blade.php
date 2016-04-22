<div class="row build-off">
    <div class="col-sm-3 col-md-2">
        <a href="https://parkitectnexus.com/build-off/7/monthly-log-flume-edition">
            <img class="build-off-type-icon" src="/img/buildoff-thumbnails/LogFlumeCar.png">
        </a>
    </div>
    <div class="col-sm-6 col-md-8">
        <div class="row">
            <div class="col-xs-12 build-off-info">
                @if($buildOff->isOpen())
                    @include('buildoffs.partials.buildoff.open', ['buildOff', $buildOff])
                @else
                    @include('buildoffs.partials.buildoff.closed', ['buildOff', $buildOff])
                @endif
            </div>
        </div>
    </div>
</div>