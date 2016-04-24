<div class="row build-off">

    @if($buildOff->isOpen())
        @include('buildoffs.partials.buildoff.open', ['buildOff', $buildOff])
    @else
        @include('buildoffs.partials.buildoff.closed', ['buildOff', $buildOff])
    @endif
</div>