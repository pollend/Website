<div class="user-profile v-margin">
    <div class="avatar">
        <img src="{{ $user->getPresenter()->avatarUrl() }}">
    </div>

    <div class="user-detail">
        <div class="username">
            <h2>
                <a href="{{ $user->getPresenter()->url() }}"
                   title="{{ $user->getPresenter()->displayName() }}">
                    {{ $user->getPresenter()->displayName() }}
                </a>
            </h2>
            @if($user->getPresenter()->hasFlair())
                <span class="label label-primary">
                        {{ $user->flair }}
                    </span>
            @endif
        </div>

        <p class="user-statistics">
            {{ $user->getPresenter()->uploadCount }} Uploads
            <br>
            {{ $user->getPresenter()->postCount }} Posts
            <br>
            {{ $user->getPresenter()->likeCount }} Likes
        </p>
    </div>
</div>