<div class="col-sm-3 col-md-2">
    <a href="https://parkitectnexus.com/build-off/7/monthly-log-flume-edition">
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
                        So far,
                        <strong>{{ \AssetRepo::forBuildOff($buildOff)->count() }}</strong>
                        designers have entered this competition!
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <p class="text-muted build-off-time-remaining">
                        This build-off ends in {{ $buildOff->getPresenter()->getFuzzyEnd() }}
                    </p>
                </div>
            </div>
            @if(!$buildOff->canVote())
                <p class="text-muted build-off-time-remaining">
                    Voting starts in {{ $buildOff->getPresenter()->getFuzzyVotingStart() }}
                </p>
            @endif
            <div class="row">
                <div class="col-xs-12">
                    <div class="btn-group">
                        <a href="{{ route('assets.manage.selectfile') }}" class="btn btn-primary" alt="Submit your entry for the {{ $buildOff->name }} build-off">
                            Submit your entry
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


