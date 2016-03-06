@extends('layouts.wide')

@section('title')
    <h1>
        Login
    </h1>
@endsection

@section('content')
    <form method="POST" action="{{ route('auth.login') }}">
        {!! csrf_field() !!}

        <div class="form-group">
            <label class="col-sm-2 control-label">Email</label>
            <input type="text" placeholder="Email" class="form-control" name="email" value="{{ \Request::old('email') }}"/>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Password</label>
            <input type="password" placeholder="Minimum of 6 characters" class="form-control" name="password"/>
        </div>

        <div class="checkbox">
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">
                Remember Me
            </label>
        </div>

        <div class="row">
            <div class="col-lg-3">
                <button type="submit" class="btn btn-primary">Login</button>
                <a href="{{ route('auth.forgotpassword') }}" title="Forgot password">Forgot password?</a>
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
