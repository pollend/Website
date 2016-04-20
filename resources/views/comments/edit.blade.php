@extends('layouts.wide')

@section('content')
    <form method="post" action="{{ route('comments.update', [$comment->id]) }}">
        {{ method_field('put') }}
        {{ csrf_field() }}

        <textarea name="body">{{ $comment->body }}</textarea>

        <input type="submit" class="btn btn-primary" value="Update comment" />
    </form>
@endsection