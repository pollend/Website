<ul class="nav nav-tabs">
    <li role="presentation" @if($tab == 'uploads') class="active" @endif>
        <a href="{{ $user->getPresenter()->uploadsUrl() }}">
            Uploads
        </a>
    </li>
    @if(\Auth::check() && $user->id == \Auth::user()->id)
        <li role="presentation" @if($tab == 'downloads') class="active" @endif>
            <a href="{{ $user->getPresenter()->downloadsUrl() }}">
                Downloads
            </a>
        </li>
        <li role="presentation" @if($tab == 'views') class="active" @endif>
            <a href="{{ $user->getPresenter()->viewsUrl() }}">
                Views
            </a>
        </li>
        <li role="presentation" @if($tab == 'likes') class="active" @endif>
            <a href="{{ $user->getPresenter()->likesUrl() }}">
                Likes
            </a>
        </li>
    @endif
</ul>
