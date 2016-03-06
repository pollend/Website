@extends('layouts.wide')

@section('content')
    <h1>
        Register for ParkitectNexus
    </h1>
    <hr>
    <form method="POST" action="{{ route('auth.register') }}">
        {!! csrf_field() !!}

        <div class="form-group">
            <label class="col-sm-2 control-label">Username</label>
            <input type="text" placeholder="Username" class="form-control" name="username" value="{{ \Request::old('username') }}"/>

            <p class="help-block">The following characters are allowed: a-z, 0-9, -</p>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Name</label>
            <input type="text" placeholder="Name" class="form-control" name="name" value="{{ \Request::old('name') }}"/>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Email</label>
            <input type="email" placeholder="Email" class="form-control" name="email" value="{{ \Request::old('email') }}"/>
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

        <div class="row">
            <div class="col-lg-3">
                <button type="submit" class="btn btn-primary">Register</button>
                <br>
                <br>
                <a href="{{ route('auth.forgotpassword') }}" title="Forgot Password">Forgot password?</a>
            </div>
            <div class="col-lg-9">
                Or log in with
                <br>
                <a href="{{ route('socialauth.facebook') }}" title="Facebook">
                    <i class="fa fa-facebook"></i> Facebook
                </a>
                <br>
                <a href="{{ route('socialauth.google') }}" title="Google">
                    <i class="fa fa-google"></i> Google
                </a>
                <br>
                <a href="{{ route('socialauth.github') }}" title="Github">
                    <i class="fa fa-github"></i> Github
                </a>
            </div>
        </div>
    </form>
@endsection
