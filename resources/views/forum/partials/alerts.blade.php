@if (Session::has('alerts'))
    @foreach (Session::get('alerts') as $alert)
        @include ('forum.partials.alert', ['type' => $alert['type'], 'message' => $alert['message']])
    @endforeach
@endif

@if (isset($errors) && $errors->count() > 0)
    @foreach ($errors->all() as $error)
        @include ('forum.partials.alert', ['type' => 'danger', 'message' => $error])
    @endforeach
@endif
