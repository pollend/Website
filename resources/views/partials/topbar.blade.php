@inject('versionService', 'PN\Foundation\VersionService')
@inject('discordService', 'PN\Social\DiscordService')

<div id="top-bar">
    <header class="navbar navbar-default">
        {{--<div class="container">--}}
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('home.index') }}" title="ParkitectNexus"><span class="blue">Parkitect</span><span class="warning">Nexus</span></a>
            </div>
            <nav class="navbar-collapse collapse" id="navbar">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="/" title="Home">Home</a>
                    </li>
                    <li class="dropdown visible-sm-block">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Browse <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="/build-offs" title="Build-Off">
                                    Build-offs
                                </a>
                            </li>
                            <li>
                                <a href="/assets/mod" title="Mods">
                                    Mods
                                </a>
                            </li>
                            <li>
                                <a href="/assets/blueprint" title="Blueprints">
                                    Blueprints
                                </a>
                            </li>
                            <li>
                                <a href="/assets/park" title="Parks">
                                    Parks
                                </a>
                            </li>
                            <li>
                                <a href="/screenshots" title="Screenshots">
                                    Screenshots
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="hidden-sm">
                        <a href="/build-offs" title="Build-Off">
                            Build-offs
                        </a>
                    </li>
                    <li class="hidden-sm">
                        <a href="/assets/mod" title="Mods">
                            Mods
                        </a>
                    </li>
                    <li class="hidden-sm">
                        <a href="/assets/blueprint" title="Blueprints">
                            Blueprints
                        </a>
                    </li>
                    <li class="hidden-sm">
                        <a href="/assets/park" title="Parks">
                            Parks
                        </a>
                    </li>
                    <li class="hidden-sm">
                        <a href="/screenshots" title="Screenshots">
                            Screenshots
                        </a>
                    </li>
                    <li>
                        <a href="/forum" title="Forum">
                            Forum
                        </a>
                    </li>
                    <li>
                        <a href="/download-client" title="ParkitectNexus Client">
                            Client
                        </a>
                    </li>
                    <li>
                        <a href="/modding-wiki" title="ParkitectNexus Modding Wiki">
                            Modding Wiki
                        </a>
                    </li>
                </ul>
                @include('partials/navbar')
            </nav>
        {{--</div>--}}
    </header>
    <div class="container">
        @yield('title')
        {{--<h1 id="logo">--}}
            {{--<a href="{{ route('home.index') }}" title="ParkitectNexus">--}}
                {{--<img src="/img/logo.png">--}}
            {{--</a>--}}
        {{--</h1>--}}

        <div class="version-box">
            <p>
                Current version
                <span class="version">
                    {{ $versionService->getCurrentVersion() }}
                </span>
            </p>
        </div>
        <div class="social-box">
            <p>
                Join us on Twitter &amp; Facebook!
                <span class="networks">
                <a href="https://twitter.com/ParkitectNexus"><i class="fa fa-twitter"></i> @ParkitectNexus</a>
                |
                <a href="https://facebook.com/ParkitectNexus"><i class="fa fa-facebook"></i> ParkitectNexus</a>
                </span>
            </p>
        </div>
        <div class="discord-box">
            <p>
                Join the ParkitectNexus Discord chat!
                <span class="members">
                    {{ $discordService->getMemberCount() }} members online.
                    <a href="{{ $discordService->getUrl() }}">
                        <i class="fa fa-chain"></i>
                    </a>
                </span>
            </p>
        </div>
    </div>
</div>
