<table class="table">
    <thead>
        <tr>
            <th class="col-md-2">
                {{ trans('forum/general.user') }}
            </th>
            <th>
                {{ trans_choice('forum/posts.post', 1) }}
            </th>
        </tr>
    </thead>
    <tbody>
        <tr id="post-{{ $post->id }}">
            <td>
                <strong>{!! $post->userName !!}</strong>
            </td>
            <td>
                {!! \PN\Social\MarkdownParser::parse($post->content) !!}
            </td>
        </tr>
    </tbody>
</table>
