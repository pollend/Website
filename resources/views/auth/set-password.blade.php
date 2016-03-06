@extends('layout.wide')

@section('content')
    <h1>
        Set your new password
    </h1>
    <hr>
    <form method="POST" action="{{ route('auth.newpassword', [$token]) }}">
        {!! csrf_field() !!}

        <div class="form-group">
            <label class="col-sm-2 control-label">Email</label>
            <input type="email" placeholder="Email" class="form-control" name="email"
                   value="{{ Input::old('email') }}"/>
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
            <div class="col-lg-6">
                <button type="submit" class="btn btn-primary">Request new password</button>
            </div>
        </div>
    </form>
@endsection