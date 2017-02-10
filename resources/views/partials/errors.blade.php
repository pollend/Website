@if(isset($errors) && $errors->count() > 0)

    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        @foreach($errors->all() as $error)
        <div>{!! $error !!}</div>
        @endforeach
    </div>
@endif

{!! \Notification::showAll() !!}

