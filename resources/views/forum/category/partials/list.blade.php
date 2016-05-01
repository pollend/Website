{{--<div class="well well-sm">--}}
	<div class="row">
		<div class="col-xs-7 col-md-4">
			<h2>
				@if($category->threadsEnabled)
					<a href="{{ $category->route }}">{{ $category->title }}</a>
				@else
					{{ $category->title }}
				@endif
			</h2>
			<span>{{ $category->description }}</span>
		</div>
		<div class="col-md-1 hidden-xs hidden-small hidden-medium">
			@if($category->threadsEnabled)
				{{ $category->threadCount }}
			@endif
		</div>
		<div class="col-md-1 hidden-xs hidden-small hidden-medium">
			@if($category->threadsEnabled)
				{{ $category->postCount }}
			@endif
		</div>
		<div class="col-md-3 hidden-xs hidden-small hidden-medium">
			@if ($category->newestThread)
				<a href="{{ $category->newestThread->route }}">
					{{ $category->newestThread->title }}
				</a>
				<p>
					{{ $category->newestThread->userName }}
					 -
					{{ $category->newestThread->lastPost->posted }}
				</p>
			@endif
		</div>
		<div class="col-xs-5 col-md-3">
			@if ($category->latestActiveThread)
				<a href="{{ $category->latestActiveThread->lastPost->url }}">
					{{ $category->latestActiveThread->title }}
				</a>
				<p>
					{{ $category->latestActiveThread->lastPost->userName }}
					 -
					{{ $category->latestActiveThread->lastPost->posted }}
				</p>
			@endif
		</div>
	</div>
	@if (!$category->children->isEmpty())
		<hr>

		@foreach ($category->children as $subcategory)
			@include ('forum.category.partials.subcategory-list', ['category' => $subcategory])
		@endforeach
	@endif
{{--</div>--}}
