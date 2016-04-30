<div class="thumbnail">
    <a href="{{ $asset->getPresenter()->url }}" title="{{ $asset->name }}">
        <img src="{{ $asset->getImage()->getPresenter()->source(263, 263) }}" alt="{{ $asset->name }}">
    </a>
    @if(!isset($showStats) || $showStats)
        <ul class="list-inline pull-left">
            <li>
                <i class="fa fa-heart"></i> {{ $asset->like_count }}
            </li>
        </ul>
        <ul class="list-inline pull-right">
            <li>
                <i class="fa fa-download"></i> {{ $asset->download_count }}
            </li>
            <li>
                <i class="fa fa-eye"></i> {{ $asset->view_count }}
            </li>
        </ul>
        <div class="clearfix"></div>
    @endif
    <hr>
    <div class="caption">
        <a href="{{ $asset->getPresenter()->url }}" title="{{ $asset->name }}">
            {{ $asset->name }}
        </a>
        <br>
        By:
        <a href="{{ $asset->getUser()->getPresenter()->url() }}" title="{{ $asset->getUser()->getPresenter()->displayName() }}">
            {{ $asset->getUser()->getPresenter()->displayName() }}
        </a>
    </div>
</div>
