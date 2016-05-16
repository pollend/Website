@extends('layouts.wide')

@section('title')
    <h1>
        Login
    </h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-2 border-right">
            <p class="text-muted">
                With your social media
            </p>
            <a href="{{ route('socialauth.steam') }}" title="Facebook" class="btn btn-primary btn-block">
                <i class="fa fa-steam"></i> Steam
            </a>
            <a href="{{ route('socialauth.facebook') }}" title="Facebook" class="btn btn-primary btn-block">
                <i class="fa fa-facebook"></i> Facebook
            </a>
            <a href="{{ route('socialauth.google') }}" title="Google" class="btn btn-primary btn-block">
                <i class="fa fa-google"></i> Google
            </a>
            <a href="{{ route('socialauth.github') }}" title="Github" class="btn btn-primary btn-block">
                <i class="fa fa-github"></i> Github
            </a>
        </div>

        <div class="col-sm-12 col-md-10">
            <p class="text-muted">
                With your username/password
            </p>
            <form class="login-form" method="POST" action="{{ route('auth.login') }}">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label class="col-sm-2 control-label">Email</label>
                    <input type="text" placeholder="Email" class="form-control" name="email" value="{{ \Request::old('email') }}"/>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Password</label>
                    <input type="password" placeholder="Minimum of 6 characters" class="form-control" name="password"/>
                </div>

                <div class="form-group">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">
                        Remember Me
                    </label>
                </div>

                <button type="submit" class="btn btn-primary">Login</button>
                <a href="{{ route('auth.forgotpassword') }}" title="Forgot password">Forgot password?</a>
            </form>
        </div>
    </div>

@endsection
