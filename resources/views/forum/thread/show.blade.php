@extends ('forum.master')

@section('title')
	<h1>
		@if ($thread->trashed())
			<span class="label label-danger">{{ trans('forum/general.deleted') }}</span>
		@endif
		@if ($thread->locked)
			<span class="label label-warning">{{ trans('forum/threads.locked') }}</span>
		@endif
		@if ($thread->pinned)
			<span class="label label-info">{{ trans('forum/threads.pinned') }}</span>
		@endif
		{{ $thread->title }}
	</h1>
@endsection

@section ('content')
	<div id="thread">

		@can ('manageThreads', $category)
		<form action="{{ route('forum.thread.update', $thread->id) }}" method="POST" data-actions-form>
			{!! csrf_field() !!}
			{!! method_field('patch') !!}

			@include ('forum.thread.partials.actions')
		</form>
		@endcan

		@can ('deletePosts', $thread)
		<form action="{{ route('forum.bulk.post.update') }}" method="POST" data-actions-form>
			{!! csrf_field() !!}
			{!! method_field('delete') !!}
			@endcan

			@can ('reply', $thread)
			<div class="row">
				<div class="col-md-6">
					<a href="{{ $thread->replyRoute }}" class="btn btn-primary">{{ trans('forum/general.new_reply') }}</a>
					<a href="#quick-reply" class="btn btn-primary">{{ trans('forum/general.quick_reply') }}</a>
				</div>
				<div class="col-md-6 text-right">
					{!! $thread->postsPaginated->render() !!}
				</div>
			</div>
			@endcan

			@can ('deletePosts', $thread)
			<span class="pull-right">
                                <input type="checkbox" data-toggle-all>
                            </span>
			@endcan
			<div class="row {{ $thread->trashed() ? 'deleted' : '' }}">
				<div class="col-xs-12">
					@foreach ($thread->postsPaginated as $post)
						@include ('forum.post.partials.list', compact('post'))
					@endforeach
					<hr>
				</div>
			</div>

			@can ('deletePosts', $thread)
			@include ('forum.thread.partials.post-actions')
		</form>
		@endcan

		{!! $thread->postsPaginated->render() !!}

		@can ('reply', $thread)
			<h3>{{ trans('forum/general.quick_reply') }}</h3>

			<div id="quick-reply">
				<form method="POST" action="{{ route('forum.post.store', $thread->id) }}">
					{!! csrf_field() !!}

					<div class="form-group">
						<textarea name="content" class="form-control" rows="5">{{ old('content') }}</textarea>
					</div>

					<button type="submit" class="btn btn-success pull-right">{{ trans('forum/general.reply') }}</button>
				</form>
			</div>
		@endcan
	</div>
@stop

@section ('footer')
	<script>
		$('tr input[type=checkbox]').change(function () {
			var postRow = $(this).closest('tr').prev('tr');
			$(this).is(':checked') ? postRow.addClass('active') : postRow.removeClass('active');
		});
	</script>
@stop
