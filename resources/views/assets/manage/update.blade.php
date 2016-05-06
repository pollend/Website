@extends('layouts.wide')

@section('content')
    <div class="col-sm-12">
        <form action="{{ route('assets.manage.update', [$asset->identifier]) }}" method="post" enctype="multipart/form-data" id="asset-create" class="v-margin">

            {{ csrf_field() }}

            <h1>
                Updating {{ $asset->name }}
            </h1>

            <div>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#tab-general" aria-controls="home" role="tab" data-toggle="tab">General</a></li>
                    <li role="presentation"><a href="#tab-media" aria-controls="profile" role="tab" data-toggle="tab">Media</a></li>
                    <li role="presentation"><a href="#tab-advanced" aria-controls="messages" role="tab" data-toggle="tab">Advanced</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content v-margin">
                    <div role="tabpanel" class="tab-pane active" id="tab-general">
                        @include('assets.manage.tabs.update.general')
                    </div>
                    <div role="tabpanel v-margin" class="tab-pane" id="tab-media">
                        @include('assets.manage.tabs.update.media')
                    </div>
                    <div role="tabpanel v-margin" class="tab-pane" id="tab-advanced">
                        @include('assets.manage.tabs.update.advanced')
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <input type="submit" value="Update" class="btn btn-primary"/>
                </div>
            </div>
        </form>
    </div>
@endsection
