@extends('client.base')

@section('download')
    <a href="{{ route('client.downloadwin') }}" class="btn btn-primary btn-block btn-lg" title="Download ParkitectNexus Client">
        Download ParkitectNexus Client
    </a>
    <br>
    <p class="text-center">
        <a href="{{ route('client.downloadosx') }}">Or download the OSX variant</a>
    </p>
@endsection
