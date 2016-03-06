<p>
    Hey {{ $user['name'] }},
</p><p>
    We recieved a request to reset your password. You can choose a new password with the following link:
</p>
<p>
    {{ route('auth.newpassword', [$user['password_token']]) }}
</p>
<p>
    Greetings,
    <br>
    ParkitectNexus
</p>