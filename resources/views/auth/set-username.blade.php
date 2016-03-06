@extends('layouts.wide')

@section('content')
    <h1>
        We need a username for your social media account.
    </h1>
    <hr>
    <p>
        You need a username to make use of ParkitectNexus. We generated the following username for you but you can
        change it if you don't like it.
    </p>
    <div data-alert class="alert alert-info">
        If you already had a ParkitectNexus account, don't panic, choose a username and it will be set on your old
        account.
        <a href="#" class="close">&times;</a>
    </div>

    <form method="post" action="{{ route('socialauth.setusername', [$encryptedIdentifier]) }}">
        {!! csrf_field() !!}


        <div class="form-group">
            <label class="col-sm-2 control-label">Username</label>
            <input type="text" placeholder="Username" class="form-control" name="username"
                   value="{{ Request::old('username', $proposedUsername) }}"/>

            <p class="help-block">The following characters are allowed: a-z, 0-9, -</p>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
@endsection
