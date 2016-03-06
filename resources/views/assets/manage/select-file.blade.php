@extends('layouts.columns')

@section('content')
	<form method="post" action="{{ route('assets.manage.selectfile') }}" enctype="multipart/form-data">
		{{ csrf_field() }}

		<input type="file" name="resource" />

		<input type="submit" value="Upload" />
	</form>
@endsection
