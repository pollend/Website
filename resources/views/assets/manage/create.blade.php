@extends('layouts.wide')

@section('content')
	<div class="col-sm-12">
		<form action="{{ route('assets.manage.create') }}" method="post" enctype="multipart/form-data" id="asset-create" class="v-margin">

			{{ csrf_field() }}

			{{ $resource->presenter()->imageUrl }}

			<h1>
				Create new {{ $type }}
			</h1>

			<div>
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#tab-general" aria-controls="home" role="tab" data-toggle="tab">General</a></li>
					<li role="presentation"><a href="#tab-media" aria-controls="profile" role="tab" data-toggle="tab">Media</a></li>
					<li role="presentation"><a href="#tab-advanced" aria-controls="messages" role="tab" data-toggle="tab">Advanced</a></li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content v-margin">
					<div role="tabpanel" class="tab-pane active" id="tab-general">
						@include('assets.manage.tabs.create.general')
					</div>
					<div role="tabpanel v-margin" class="tab-pane" id="tab-media">
						@include('assets.manage.tabs.create.media')
					</div>
					<div role="tabpanel v-margin" class="tab-pane" id="tab-advanced">
						@include('assets.manage.tabs.create.advanced')
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-12">
					<input type="submit" value="Create" class="btn btn-primary"/>
				</div>
			</div>
		</form>

		<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="asset-modal"
		     aria-labelledby="myLargeModalLabel">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel">Hold on tight.</h4>

					</div>
					<div class="modal-body">
						<p>
							We're uploading the images to our servers to process them. This can take a few seconds,
							please don't
							reload. You will be redirected automatically.
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
