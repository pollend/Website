@if(isset($errors) && $errors->has())
    <div class="alert alert-warning">
        @foreach($errors->all() as $error)
            {!! $error !!}
            <br/>
        @endforeach
        <a href="#" class="close">&times;</a>
    </div>
@endif
