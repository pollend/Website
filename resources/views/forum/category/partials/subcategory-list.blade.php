<div class="row">
	<div class="col-xs-7 col-md-3">
		<p>
			<a href="{{ $category->route }}">{{ $category->title }}</a>
			<br>
			{{ $category->description }}</p>
	</div>
	<div class="col-md-1 hidden-xs hidden-small hidden-medium">
		{{ $category->threadCount }}
	</div>
	<div class="col-md-1 hidden-xs hidden-small hidden-medium">
		{{ $category->postCount }}
	</div>
	<div class="col-md-1 hidden-xs hidden-small hidden-medium">
			{{ $category->thread_views }}
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
