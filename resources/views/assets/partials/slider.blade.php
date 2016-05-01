<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img src="{{ $asset->getImage()->getPresenter()->source(1920, 1080) }}"/>
        </div>
        @foreach($asset->images as $image)
            <div class="item">
                <img src="{{ $image->getPresenter()->source }}"/>
            </div>
        @endforeach

        @if($asset->type != 'mod')
            <div class="item">
                <img src="{{ $asset->resource->getImage()->getPresenter()->source }}"/>
            </div>
        @endif
    </div>

    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<div class="row slider-thumbnails">
    <div class="col-sm-2">
        <img data-target="#carousel-example-generic" data-slide-to="0" width="100%" src="{{ $asset->getImage()->getPresenter()->source(116, 66) }}"/>
    </div>
    @foreach($asset->images as $key => $image)
        <div class="col-sm-2">
            <img data-target="#carousel-example-generic" data-slide-to="{{ $key + 1 }}" width="100%" src="{{ $image->getPresenter()->source(116, 66) }}"/>
        </div>
    @endforeach

    @if($asset->type != 'mod')
        <div class="col-sm-2">
            <img data-target="#carousel-example-generic" data-slide-to="{{ count($asset->images) + 1 }}" width="100%" src="{{ $asset->resource->getImage()->getPresenter()->source(116, 66) }}"/>
        </div>
    @endif
</div>
