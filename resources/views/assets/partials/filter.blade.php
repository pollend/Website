<div class="form-group">
    {{ $filter['name'] }}:
    <span class="filter-value">
        {{ request('stats.'.$name, $filter['default']) }}
    </span>
    <br>
    <input type="text"
           name="stats[{{ $name }}]"
           data-slider-ticks="[{{ implode(',', $filter['ticks']) }}]"
           data-slider-min="{{ $filter['min'] }}"
           data-slider-max="{{ $filter['max'] }}"
           data-slider-step="{{ $filter['step'] }}"
           data-slider-value="{{ request('stats.'.$name, $filter['default']) }}"
           data-tooltip-position="bottom">
</div>