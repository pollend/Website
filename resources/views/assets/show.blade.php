@extends('layouts.columns')

@section('title')
	<h1>
		{{ $asset->name }}
	</h1>
@endsection

@section('content')
	{{ $asset->description }}
@endsection
