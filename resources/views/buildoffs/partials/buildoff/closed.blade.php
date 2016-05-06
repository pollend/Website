<div class="col-sm-3 col-md-2">
    <a href="{{ route('buildoffs.show', [$buildOff->id, $buildOff->getPresenter()->getSlug()]) }}">
        <img class="build-off-type-icon" src="{{ $buildOff->getPresenter()->getThumbnailPath() }}">
    </a>
</div>
<div class="col-sm-6 col-md-8">
    <div class="row">
        <div class="col-xs-12 build-off-info">
            <h2>
                <a href="{{ route('buildoffs.show', [$buildOff->id, $buildOff->getPresenter()->getSlug()]) }}">
                    {{ $buildOff->name }}
                </a>
            </h2>
            <div class="row">
                <div class="col-xs-12">
                    {{ $buildOff->short_description }}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <p>
                        Out of
                        <strong>{{ $buildOff->getRanks()->count() }}</strong>
                        contestants,
                        <strong>
                            <a href="https://parkitectnexus.com/assets/3bba39453d/the-enigma">
                                {{ $buildOff->getWinner()->getAsset()->name }}
                            </a>
                        </strong> made by
                        <strong><a href="https://parkitectnexus.com/user/lord-gonchar">
                                {{ $buildOff->getWinner()->getAsset()->getUser()->getPresenter()->displayName() }}
                            </a>
                        </strong>
                        has won the competition! Congratulations!
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <p class="text-muted build-off-time-remaining">
                        This build-off ended {{ $buildOff->getPresenter()->getFuzzyEnd() }}
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <a href="{{ route('buildoffs.show', [$buildOff->id, $buildOff->getPresenter()->getSlug()]) }}" class="btn btn-primary" title="View contestants of the {{ $buildOff->name }} build-off">
                        View contestants
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>



