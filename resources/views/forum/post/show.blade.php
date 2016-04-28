@extends ('forum.master', ['breadcrumb_other' => trans('forum/posts.view')])

@section('title')
	<h1>
		{{ $thread->title }}
	</h1>
@endsection

@section ('content')
	<div id="post">
		<p>
			<a href="{{ $post->url }}" class="btn btn-default">
				&laquo; {{ trans('forum/threads.view') }}
			</a>
		</p>

		@include ('forum.post.partials.list', compact('post'))
	</div>
@stop
