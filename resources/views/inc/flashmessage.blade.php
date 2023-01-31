@if ($message = Session::get('succes'))
    <div class="alert alert-solid-success">
        {{ $message }}
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-solid-danger">
        {{ $message }}
    </div>
@endif
