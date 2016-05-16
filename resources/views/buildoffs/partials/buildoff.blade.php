<div class="row build-off">

    @if($buildOff->toStart())
        @include('buildoffs.partials.buildoff.tostart', ['buildOff', $buildOff])
    @elseif($buildOff->isOpen())
        @include('buildoffs.partials.buildoff.open', ['buildOff', $buildOff])
    @else
        @include('buildoffs.partials.buildoff.closed', ['buildOff', $buildOff])
    @endif
</div>