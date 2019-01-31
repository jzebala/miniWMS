{{-- Success Message --}}
@if(Session::has('successMsg'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('successMsg') }}
    </div>
@endif

{{-- Danger, Error Message --}}
@if(Session::has('dangerMsg'))
    <div class="alert alert-danger" role="alert">
        {{ Session::get('dangerMsg') }}
    </div>
@endif

{{-- Warning Message --}}
@if(Session::has('warningMsg'))
    <div class="alert alert-warning" role="alert">
        {{ Session::get('warningMsg') }}
    </div>
@endif

{{-- Info Message --}}
@if(Session::has('infoMsg'))
    <div class="alert alert-info" role="alert">
        {{ Session::get('infoMsg') }}
    </div>
@endif

{{-- Validation report  --}}
@if (count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif