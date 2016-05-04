	<div class="row">
		<div class="col-sm-9" id="asset-select">

			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" placeholder="Name" name="name" class="form-control"
				       value="{{ old('name', $asset->name) }}"/>
			</div>

			<div class="row">
				<div class="col-sm-12">
					<div class="form-group">
						<label for="name">
							Description <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="Markdown supported"></i>
						</label>

                        <textarea name="description" placeholder="Description" id="description" class="form-control markdown" rows="15">{{ old('description', $asset->description) }}</textarea>
					</div>
				</div>
			</div>

		</div>
		<div class="col-sm-3" id="asset-select">
			<div>
				@if(count($primaryTags) > 0)
					<label>
						Primary Tags <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="Primary tags are assigned automatically by detection algorithms"></i>
					</label>
					@foreach($primaryTags as $primaryTag)
						<div class="checkbox">
							<input type="checkbox" checked disabled>
							<label>
								{{ $primaryTag->tag }}
							</label>
						</div>
					@endforeach
				@endif
			</div>
			<div>
			<label>
				Secondary Tags
			</label>
				@foreach($secondaryTags as $index => $tag)
					<div class="checkbox">
						<input id="tag-{{ $tag->slug }}" name="tags[{{ $tag->id }}]" type="checkbox" @if(Request::old('tags.'.$tag->slug, $asset->tags->where('id', $tag->id)->count()>0) != false) checked @endif>
						<label for="tag-{{ $tag->slug }}">
							{{ $tag->tag }}
						</label>
					</div>
				@endforeach
			</div>
		</div>
	</div>
