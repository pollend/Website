<div class="thumbnail">
    <a href="{{ $asset->presenter()->url }}" title="{{ $asset->name }}">
        <img src="{{ $asset->image->presenter()->source }}" alt="{{ $asset->name }}">
    </a>
    <ul class="list-inline pull-left">
        <li>
            <i class="fa fa-heart"></i> {{ $asset->likes }}
        </li>
    </ul>
    <ul class="list-inline pull-right">
        <li>
            <i class="fa fa-download"></i> {{ $asset->downloads }}
        </li>
        <li>
            <i class="fa fa-eye"></i> {{ $asset->views }}
        </li>
    </ul>
    <div class="clearfix"></div>
    <hr>
    <div class="caption">
        <a href="{{ $asset->presenter()->url }}" title="{{ $asset->name }}">
            {{ $asset->name }}
        </a>
        <br>
        By:
        <a href="https://parkitectnexus.com/user/TheDeeGee" title="TheDeeGee">TheDeeGee</a>
    </div>
</div>
