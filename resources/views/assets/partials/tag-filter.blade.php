<div class="tag-filter">
    <div class="btn-group btn-group-xs">
        <button type="button" class="btn btn-success @if(\Request::input('tags.'.$tag->slug, '') == 'on') active @endif">
            <i class="fa fa-check"></i>
        </button>
        <button type="button" class="btn btn-danger @if(\Request::input('tags.'.$tag->slug, '') == 'off') active @endif">
            <i class="fa fa-times"></i>
        </button>
    </div>
    <input type="hidden" name="tags[{{ $tag->slug }}]" value="{{ \Request::input('tags.'.$tag->slug, '') }}" />
    {{ $tag->tag }}
</div>
