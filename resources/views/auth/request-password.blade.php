@extends('layouts.wide')

@section('content')
    <h1>
        Request new password
    </h1>
    <hr>
    <form method="POST" action="{{ route('auth.forgotpassword') }}">
        {!! csrf_field() !!}

        <div class="form-group">
            <label class="col-sm-2 control-label">Email</label>
            <input type="email" placeholder="Email" class="form-control" name="email" value="{{ old('email') }}"/>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <button type="submit" class="btn btn-primary">Request new password</button>
            </div>
        </div>
    </form>
@endsection