<ul class="nav navbar-nav navbar-right">
    @if(\Auth::check())
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                Upload <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="{{ route('assets.manage.selectfile') }}">
                        Blueprint
                    </a>
                </li>
                <li>
                    <a href="{{ route('assets.manage.selectfile') }}">
                        Park
                    </a>
                </li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                {{ \Auth::user()->getPresenter()->displayName }} <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="#">
                        Profile
                    </a>
                </li>
                <li>
                    <a href="#">
                        Settings
                    </a>
                </li>
                <li role="separator" class="divider"></li>
                <li>
                    <a href="{{ route('auth.logout') }}">
                        Logout
                    </a>
                </li>
            </ul>
        </li>
    @else
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                Login <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="{{ route('auth.login') }}">
                        Password
                    </a>
                </li>
                <li>
                    <a href="{{ route('socialauth.google') }}">
                        Google
                    </a>
                </li>
                <li>
                    <a href="{{ route('socialauth.facebook') }}">
                        Facebook
                    </a>
                </li>
                <li>
                    <a href="{{ route('socialauth.github') }}">
                        GitHub
                    </a>
                </li>
                <li role="separator" class="divider"></li>
                <li>
                    <a href="{{ route('auth.register') }}">
                        Register
                    </a>
                </li>
            </ul>
        </li>
    @endif
</ul>
