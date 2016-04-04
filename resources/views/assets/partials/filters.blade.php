<div id="list-filters">
    <form>
        <div class="form-group">
            Name
            <input type="text" placeholder="Awesome Coaster" class="form-control" name="name"
                   value="{{ request('name', '') }}">
        </div>

        <div id="sliders">

            <div class="form-group">
                Minimum Excitement
                <br>
                <input type="text"
                       name="stats[1]"
                       data-slider-ticks="[0, 20, 40, 60, 80]"
                        {{--data-slider-ticks-labels='["Boring", "", "", "", "Exciting"]'--}}
                       data-slider-min="0"
                       data-slider-max="80"
                       data-slider-step="20"
                       data-slider-value="0"
                       data-tooltip-position="bottom">
            </div>
            <div class="form-group">
                Maximum Intensity
                <br>
                <input type="text"
                       name="stats[2]"
                       data-slider-ticks="[0, 20, 40, 60, 80, 100]"
                        {{--data-slider-ticks-labels='["Calm", "", "", "", "Intense"]'--}}
                       data-slider-min="20"
                       data-slider-max="100"
                       data-slider-step="20"
                       data-slider-value="100"
                       data-tooltip-position="bottom">
            </div>

            <div class="form-group">
                Maximum Nausea
                <br>
                <input type="text"
                       name="stats[3]"
                       data-slider-ticks="[20, 40, 60, 80, 100]"
                        {{--data-slider-ticks-labels='["Calm", "", "", "", "Intense"]'--}}
                       data-slider-min="20"
                       data-slider-max="100"
                       data-slider-step="20"
                       data-slider-value="100"
                       data-tooltip-position="bottom">
            </div>
        </div>
        @foreach($tags as $tag)
            @include('assets.partials.tag-filter', ['tag' => $tag])
        @endforeach

        <input type="submit" value="Filter" class="btn btn-primary btn-block"/>
    </form>
</div>
