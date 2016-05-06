@if(\Auth::check())
    <div class="row like"
         likes="{{ $asset->like_count }}"
         type="asset"
         id="{{ $asset->id }}"
         @if(\Auth::check())
         liked="{{ var_export(\Auth::user()->liked($asset), true) }}"
            @endif>
        <div class="col-xs-6 text-center" title="Views">
            <i class="fa icon-xl" v-bind:class="{ 'fa-heart': isLiked(), 'fa-heart-o': !isLiked() }" v-on:click="toggleLike"></i>
        </div>
        <div class="col-xs-6 text-center" title="Downloads">
            @if($asset->getBuildOff() != null)
                <p>
                    @if(\Auth::user()->liked($asset))
                        You like this
                    @else
                        You didn't like this yet
                    @endif
                </p>
            @else
                <b>
                    @{{ likes }}
                </b>

                <p v-if="likes == 1">
                    Person like this
                </p>
                <p v-if="likes != 1">
                    People like this
                </p>
            @endif
        </div>
    </div>
@else
    <div class="row">
        <div class="col-xs-6 text-center" title="Views">
            <i class="fa icon-xl fa-heart"></i>
        </div>
        <div class="col-xs-6 text-center" title="Downloads">
            <b>
                {{ $asset->like_count }}
            </b>

            <p>
                @if($asset->like_count == 1)
                    Person like this
                @else
                    People like this
                @endif
            </p>
        </div>
    </div>
@endif

<hr>