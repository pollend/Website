@extends('layouts.wide')

@section('title')
    <h1>
        Account settings
    </h1>
    <hr>
@endsection

@section('content')
    <form method="post" action="{{ route('users.regenerateapikey') }}">
        {!! csrf_field() !!}
        {!! method_field('put') !!}

        <h2>
            Api key
        </h2>
        <p class="mute">
            Use this key for applications or mods that want to connect to ParkitectNexus, If you generate a new key, all applications will be disconnected.
        </p>
        <div class="row">
            <div class="col-md-4">
                <input type="text" readonly class="form-control col-sm-6" value="{{ old('api_key', $user->api_key) }}">
            </div>
            <div class="col-md-8">
                <input type="submit" value="Regenerate new key" class="btn btn-primary" />
            </div>
        </div>
    </form>
    <form method="POST" action="{{ route('users.update') }}" enctype="multipart/form-data">
        {!! csrf_field() !!}
        {!! method_field('put') !!}

        <h2>
            Avatar
        </h2>
        <div class="row">
            <div class="col-sm-2">
                <img src="{{ $user->getPresenter()->avatarUrl }}" width="100%">
            </div>
            <div class="col-sm-8">
                <div class="form-group">
                    <label class="col-sm-12 control-label">Select avatar</label>
                    <input type="file" name="avatar"/>
                </div>
            </div>
        </div>

        {{--<h2>--}}
            {{--Change email--}}
        {{--</h2>--}}

        {{--<div class="form-group">--}}
            {{--<label class="col-sm-2 control-label">New emailaddress</label>--}}
            {{--<input type="email" placeholder="Email" class="form-control" name="email" value="{{ old('email') }}"/>--}}
        {{--</div>--}}

        <h2>
            Social media
        </h2>

        <div class="form-group">
            <label class="col-sm-2 control-label">
                Twitter
            </label>

            <div class="input-group">
                <div class="input-group-addon">https://twitter.com/</div>
                <input type="text" name="twitter" placeholder="Twitter username" class="form-control" value="{{ old('twitter', $user->twitter) }}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">
                Twitch
            </label>

            <div class="input-group">
                <div class="input-group-addon">https://twitch.tv/</div>
                <input type="text" name="twitch" placeholder="Twitch username" class="form-control" value="{{ old('twitch', $user->twitch) }}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">
                Steam
            </label>

            <div class="input-group">
                <div class="input-group-addon">https://steamcommunity.com/</div>
                <input type="text" name="steam" placeholder="Steam user id (eg. 76561198016349396)" class="form-control" value="{{ old('steam', $user->steam) }}">
            </div>
        </div>

        <h2>
            Donations
        </h2>

        <p>
            You can receive donations for your uploaded mods. Currently there are 2 options, paypal and bitcoin.
            Please create an account at <a href="https://www.paypal.me/" target="_blank">PayPal.me</a>.
            Do not use bitcoin for 'fun', you can lose all your coins if you don't know what you're doing.
        </p>

        <div class="form-group">
            <label class="col-sm-2 control-label">
                PayPal
            </label>

            <div class="input-group">
                <div class="input-group-addon">https://paypal.me/</div>
                <input type="text" name="paypal" placeholder="PayPal.me username" class="form-control" value="{{ old('paypal', $user->paypal) }}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">
                Bitcoin address
            </label>

            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-bitcoin"></i> </div>
                <input type="text" name="bitcoin" placeholder="Bitcoin address" class="form-control" value="{{ old('bitcoin', $user->bitcoin) }}">
            </div>
        </div>

        <h2>
            Email settings
        </h2>

        <label>Email me unread notifications (Like comments on your creations or when someone mentions you)</label>

        <div class="checkbox">
            <input type="radio" name="notification_rate" value="0" id="notification_rate_0" {{ old('notification_rate', $user->notification_rate) == "0" ? "checked" : "" }}>
            <label for="notification_rate_0">Never</label>
        </div>

        <div class="checkbox">
            <input type="radio" name="notification_rate" value="1" id="notification_rate_1" {{ old('notification_rate', $user->notification_rate) == "1" ? "checked" : "" }}>
            <label for="notification_rate_1">Once per day</label>
        </div>

        <div class="checkbox">
            <input type="radio" name="notification_rate" value="2" id="notification_rate_2" {{ old('notification_rate', $user->notification_rate) == "2" ? "checked" : "" }}>
            <label for="notification_rate_2">Once per three days</label>
        </div>

        <div class="checkbox">
            <input type="radio" name="notification_rate" value="3" id="notification_rate_3" {{ old('notification_rate', $user->notification_rate) == "3" ? "checked" : "" }}>
            <label for="notification_rate_3">Once per week</label>
        </div>

        <label>Email me a weekly/monthly recap with the best creations</label>

        <div class="checkbox">
            <input type="radio" name="recap_rate" value="0" id="recap_rate_0" {{ old('recap_rate', $user->recap_rate) == "0" ? "checked" : "" }}>
            <label for="recap_rate_0">Never</label>
        </div>

        <div class="checkbox">
            <input type="radio" name="recap_rate" value="1" id="recap_rate_1" {{ old('recap_rate', $user->recap_rate) == "1" ? "checked" : "" }}>
            <label for="recap_rate_1">Once per week</label>
        </div>

        <div class="checkbox">
            <input type="radio" name="recap_rate" value="2" id="recap_rate_2" {{ old('recap_rate', $user->recap_rate) == "2" ? "checked" : "" }}>
            <label for="recap_rate_2">Once per month</label>
        </div>

        @if($user->social == 0)
            <h2>
                Change password
            </h2>

            <div class="form-group">
                <label class="col-sm-2 control-label">Current password</label>
                <input type="password" placeholder="Current password" class="form-control" name="current_password"/>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Password</label>
                <input type="password" placeholder="Password" class="form-control" name="password"/>

                <p class="help-block">
                    Minimal 6 characters
                </p>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Confirm Password</label>
                <input type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation"/>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-12">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
@endsection