@extends('layouts.wide')

@section('title')
	<h1>
		Select your blueprint/park
	</h1>
@endsection

@section('content')
	<form method="post" action="{{ route('assets.manage.selectfile') }}" enctype="multipart/form-data">
		{{ csrf_field() }}

		@if(\Agent::is('OS X'))
			<div class="alert alert-info">
				Blueprints are located in ~/Library/Application Support/Parkitect/Saves/Blueprints
				<br>
				Parks are located in ~/Library/Application Support/Parkitect/Saves/Savegames
				<br>
				Scenarios are located in ~/Library/Application Support/Parkitect/Saves/Scenarios
			</div>
		@else
			<div class="alert alert-info">
				Blueprints are located in Documents\Parkitect\Saves\Blueprints
				<br>
				Parks are located in Documents\Parkitect\Saves\Savegames
				<br>
				Scenarios are located in Documents\Parkitect\Saves\Scenarios
			</div>
		@endif

		<div class="row">
			<div class="col-sm-4">
				<div class="form-group">
					<label for="select-asset">
						Select your asset
					</label>
					<input type="file" name="resource" id="select-asset" accept="image/png,text/plain,.park,.scenario">
				</div>
				<input type="submit" value="Upload" class="btn btn-primary">
			</div>
			<div class="col-sm-4">
				<div class="alert alert-info">
					Max 50 MB
					<br>
					Blueprint file (.png)
					<br>
					Park file (.txt, .park)
					<br>
					Scenario file (.scenario)
				</div>
			</div>
			<div class="col-sm-4"></div>
		</div>
	</form>
@endsection
