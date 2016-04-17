<div class="row">
	<div class="col-xs-12">
		@if(count($buildOffs) > 0)
			<div class="well">
				<div class="alert alert-info" role="alert">
					This {{ $type }} is eligible for one or more Build-Offs. <u>Build-Off submissions can only be set on
						creation. You can't add them later.</u>
				</div>

				<div class="form-group">
					<label for="buildoff">Build-Off</label>
					<select id="buildoff" class="form-control" name="buildoff">
						<option value="0">None</option>
						@foreach($buildOffs as $buildOff)
							<option value="{{ $buildOff->id }}"
							        @if(Request::old('buildoff', null) == $buildOff->id) selected @endif>{{ $buildOff->name }}
								(closes: {{ $buildOff->end }})
							</option>
						@endforeach
					</select>
				</div>
			</div>
		@endif
	</div>
</div>

<div class="row">
	<div class="col-sm-9" id="asset-select">

		<div class="form-group">
			<label for="name">Name</label>
			<input type="text" placeholder="Name" name="name" class="form-control"
			       value="{{ Request::old('name', $resource->getPresenter()->name) }}"/>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="form-group">
					<label for="name">
						Description <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right"
						               title="Markdown supported"></i>
					</label>

                        <textarea name="description" placeholder="Description" id="description"
                                  class="form-control markdown"
                                  rows="15">{{ Request::old('description') }}</textarea>

				</div>
			</div>
		</div>

	</div>
	<div class="col-sm-3" id="asset-select">
		<div>
			<label>
				Primary Tags <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right"
				                title="Primary tags are assigned automatically by detection algorithms"></i>
			</label>
			@foreach($primaryTags as $primaryTag)
				<div class="checkbox">
					<input type="checkbox" checked disabled>
					<label>
						{{ $primaryTag->tag }}
					</label>
				</div>
			@endforeach
		</div>
		<div>
			<label>
				Secondary Tags
			</label>
			@foreach($secondaryTags as $index => $tag)
				<div class="checkbox">
					<input id="tag-{{ $tag->slug }}" name="tags[{{ $tag->id }}]" type="checkbox" @if(Request::old('tags.'.$tag->id, 'off') == $tag->slug) checked @endif>
					<label for="tag-{{ $tag->slug }}">
						{{ $tag->tag }}
					</label>
				</div>
			@endforeach
		</div>
	</div>
</div>
