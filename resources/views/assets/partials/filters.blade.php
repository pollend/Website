<div id="list-filters">
    <form>
        <div class="form-group">
            Name
            <input type="text" placeholder="Awesome Coaster" class="form-control" name="name" value="{{ request('name', '') }}">
        </div>

        <input type="hidden" name="sort" value="{{ request('sort') }}" />
        <input type="hidden" name="range" value="{{ request('range') }}" />

        <div id="sliders">
            @foreach($filters['base'] as $name => $filter)
                @include('assets.partials.filter', ['filter' => $filter])
            @endforeach
            @foreach($filters['advanced'] as $name => $filter)
                @include('assets.partials.filter', ['filter' => $filter])
            @endforeach
        </div>
        @foreach($tags as $tag)
            @include('assets.partials.tag-filter', ['tag' => $tag])
        @endforeach
    </form>
</div>
