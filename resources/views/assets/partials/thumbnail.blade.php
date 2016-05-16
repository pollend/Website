<div class="thumbnail">
    <a href="{{ $asset->getPresenter()->url }}" title="{{ $asset->name }}">
        <img src="{{ $asset->getImage()->getPresenter()->source(263, 263) }}" alt="{{ $asset->name }}">
    </a>
    <ul class="list-inline pull-left">
        <li>
            <like @if(!isset($showLikes) || $showLikes) likes="{{ $asset->like_count }}"@endif
                  type="asset"
                  id="{{ $asset->id }}"
                  @if(\Auth::check())
                  liked="{{ var_export(\Auth::user()->liked($asset), true) }}"
                  @endif>
            </like>
            <script type="text/html" id="like-template">
                <i class="fa fa-heart" v-bind:class="{ 'fa-heart': isLiked(), 'fa-heart-o': !isLiked() }" @if(\Auth::check()) v-on:click="toggleLike" @endif></i> @if(!isset($showLikes) || $showLikes) {{ $asset->like_count }} @endif
            </script>
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
    <hr>
    <div class="caption">
        <a href="{{ $asset->getPresenter()->url }}" title="{{ $asset->name }}">
            {{ \Illuminate\Support\Str::limit($asset->name, 25) }}
        </a>
        <br>
        By:
        <a href="{{ $asset->getUser()->getPresenter()->url() }}" title="{{ $asset->getUser()->getPresenter()->displayName() }}">
            {{ $asset->getUser()->getPresenter()->displayName() }}
        </a>
    </div>
</div>
