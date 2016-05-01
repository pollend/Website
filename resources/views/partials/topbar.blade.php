@inject('versionService', 'PN\Foundation\VersionService')
<div id="top-bar" class="hidden-xs hidden-sm">
    <div class="container">
        <h1 id="logo">
            <a href="{{ route('home.index') }}" title="ParkitectNexus">
                <img src="/img/logo.png">
            </a>
        </h1>

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
    </div>
</div>
<header class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand visible-xs visible-sm" href="{{ route('home.index') }}" title="ParkitectNexus">ParkitectNexus</a>
        </div>
        <nav class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li>
                    <a href="/" title="Home">Home</a>
                </li>
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
                    <a href="/screenshots" title="Parks">
                        Screenshots
                    </a>
                </li>
                <li>
                    <a href="/forum" title="Forum">
                        Forum
                    </a>
                </li>
                <li>
                    <a href="#" title="ParkitectNexus Client">
                        Client
                    </a>
                </li>
            </ul>
            @include('partials/navbar')
        </nav>
    </div>
</header>
