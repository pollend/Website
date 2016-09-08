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
                <div class="panel-heading" data-toggle="collapse" data-target="#options-filter-basic" aria-expanded="false"
                     aria-controls="options-filter-basic">
                    <h3 class="panel-title">
                        <i class="glyphicon glyphicon-filter"></i>
                        Filters
                    </h3>
                </div>
                <div class="panel-body collapse {{ request('stats') != null || count($filters['advanced']) > 0 ? 'in' : '' }}" id="options-filter-basic">
                    <div class="sliders">
                        @foreach($filters['base'] as $name => $filter)
                            @include('assets.partials.filter', ['filter' => $filter])
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        @if(count($filters['advanced']) > 0)
            <div class="panel panel-default filter-group">
                <div class="panel-heading" data-toggle="collapse" data-target="#options-filter-advanced" aria-expanded="false"
                     aria-controls="options-filter-advanced">
                    <h3 class="panel-title">
                        <i class="glyphicon glyphicon-filter"></i>
                        Advanced Filters
                    </h3>
                </div>
                <div class="panel-body{{ request('stats') == null ? ' collapse' : '' }}" id="options-filter-advanced">
                    <div class="sliders">
                        @foreach($filters['advanced'] as $name => $filter)
                            @include('assets.partials.filter', ['filter' => $filter])
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @if(isset($contentTypeTags) && count($contentTypeTags) > 0)
            <div class="panel panel-default filter-group">
                <div class="panel-heading" data-toggle="collapse" data-target="#options-blueprint" aria-expanded="true" aria-controls="options-primary-tags">
                    <h3 class="panel-title">
                        <i class="glyphicon glyphicon-tag"></i>
                        Blueprint
                    </h3>
                </div>
                <div class="panel-body collapse in" id="options-blueprint" aria-expanded="true">
                    @foreach($contentTypeTags as $tag)
                        @include('assets.partials.tag-filter', ['tag' => $tag])
                    @endforeach
                </div>
            </div>
        @endif

        @if(isset($coasterTypeTags) && count($coasterTypeTags) > 0)
            <div class="panel panel-default filter-group">
                <div class="panel-heading" data-toggle="collapse" data-target="#options-coaster-types" aria-expanded="false"
                     aria-controls="options-primary-tags">
                    <h3 class="panel-title">
                        <i class="glyphicon glyphicon-tag"></i>
                        Coaster Types
                    </h3>
                </div>
                <div class="panel-body{{ request('tags') == null ? ' collapse' : '' }}" id="options-coaster-types">
                    @foreach($coasterTypeTags as $tag)
                        @include('assets.partials.tag-filter', ['tag' => $tag])
                    @endforeach
                </div>
            </div>
        @endif

        @if(count($tags) > 1)
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
