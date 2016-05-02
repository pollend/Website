<div id="list-filters">
    <form>
        <div class="form-group">
            Name
            <input type="text" placeholder="Awesome Coaster" class="form-control" name="name"
                   value="{{ request('name', '') }}">
        </div>

        <input type="hidden" name="sort" value="{{ request('sort') }}"/>
        <input type="hidden" name="range" value="{{ request('range') }}"/>

        @if(count($filters['base']) > 0)
            <div class="panel panel-default filter-group">
                <div class="panel-heading" data-toggle="collapse" data-target="#options-filter" aria-expanded="false"
                     aria-controls="options-filter">
                    <h3 class="panel-title">
                        <i class="glyphicon glyphicon-filter"></i>
                        Filters
                    </h3>
                </div>
                <div class="panel-body{{ request('stats') == null ? ' collapse' : '' }}" id="options-filter">
                    <div id="sliders">
                        @foreach($filters['base'] as $name => $filter)
                            @include('assets.partials.filter', ['filter' => $filter])
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        @if(count($filters['advanced']) > 0)
            <div class="panel panel-default filter-group">
                <div class="panel-heading" data-toggle="collapse" data-target="#options-filter" aria-expanded="false"
                     aria-controls="options-filter">
                    <h3 class="panel-title">
                        <i class="glyphicon glyphicon-filter"></i>
                        Advanced Filters
                    </h3>
                </div>
                <div class="panel-body{{ request('stats') == null ? ' collapse' : '' }}" id="options-filter">
                    <div id="sliders">
                        @foreach($filters['advanced'] as $name => $filter)
                            @include('assets.partials.filter', ['filter' => $filter])
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @if(count($tags) > 0)
            <div class="panel panel-default filter-group">
                <div class="panel-heading" data-toggle="collapse" data-target="#options-tags" aria-expanded="false"
                     aria-controls="options-tags">
                    <h3 class="panel-title">
                        <i class="glyphicon glyphicon-tag"></i>
                        Tags
                    </h3>
                </div>
                <div class="panel-body{{ request('tags') == null ? ' collapse' : '' }}" id="options-tags">
                    @foreach($tags as $tag)
                        @include('assets.partials.tag-filter', ['tag' => $tag])
                    @endforeach
                </div>
            </div>
        @endif
    </form>
</div>
