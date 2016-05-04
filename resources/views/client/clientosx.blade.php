@extends('client.base')

@section('download')
    <a href="{{ route('client.downloadosx') }}#installation-guide" class="btn btn-primary btn-block btn-lg" title="Download ParkitectNexus Client">
        Download ParkitectNexus Client for OSX
    </a>
    <br>
    <p class="text-center">
        <a href="{{ route('client.downloadwin') }}">Or download the Windows variant</a>
    </p>
@endsection
