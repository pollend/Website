@extends('layouts.columns')

@section('title')
	<h1>
		{{ $asset->getName() }}
	</h1>
@endsection

@section('content')
	{{ $asset->getDescription() }}
@endsection
