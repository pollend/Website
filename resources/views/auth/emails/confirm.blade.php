<p>
    Hey {{ $user['name'] }},
</p><p>
    Please confirm your email before logging in to <a href="{{ route('home.index') }}">ParkitectNexus</a>
</p>
<p>
    {{ route('auth.confirm', [$user['confirm_token']]) }}
</p>
<p>
    Greetings,
    <br>
    ParkitectNexus
</p>