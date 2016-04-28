@extends('layouts.wide')

@section('title')
    <h1>
        Update {{ $screenshot->title }}
    </h1>
@endsection

@section('content')
    <form method="post" action="{{ route('screenshots.update', [$screenshot->identifier]) }}">
        {{ csrf_field() }}
        {{ method_field('put') }}

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="{{ old('title', $screenshot->title) }}">
        </div>

        <input type="submit" class="btn btn-primary" value="Update" />
    </form>
@endsection