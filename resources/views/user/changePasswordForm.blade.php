@extends('master')

@section('title', 'Użytkownik: ' . $user->name . ' - Zmiana hasła')

@section('content')
<div class="container" style="margin-top: 20px;">
<div class="row">
<div class="col-md-6 offset-md-3">
    <div class="card">
        <div class="card-body">

            <h5 class="card-title">Zmiana hasła</h5>
            <h6 class="card-subtitle mb-2 text-muted">Zmień hasło dla użytkownika: 
            <a href="{{ route('user.show', $user->name) }}">{{ $user->name }}</a>
            </h6>
            <hr>
        @include('error_raports')

        {{ Form::open(['method' => 'POST', 'action' => ['UserController@changePassword', $user->name]]) }}
        <div class="form-group row">
            <label for="password" class="col-sm-4 col-form-label">Aktualne hasło</label>
            <div class="col-sm-8">
                {{ Form::password('password', ['id' => 'password', 'class' => 'form-control']) }}
            </div>
        </div>

        <div class="form-group row">
            <label for="new_password" class="col-sm-4 col-form-label">Nowe hasło</label>
            <div class="col-sm-8">
                {{ Form::password('new_password', ['id' => 'new_password', 'class' => 'form-control']) }}
            </div>
        </div>

        <div class="form-group row">
            <label for="new_password_confirmation" class="col-sm-4 col-form-label">Powtórz hasło</label>
            <div class="col-sm-8">
                {{ Form::password('new_password_confirmation', ['id' => 'new_password_confirmation', 'class' => 'form-control']) }}
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-12 text-right">
                {{ Form::submit('Zmień hasło', ['class' => 'btn btn-primary']) }}
            </div>
        </div>
        {{ Form::close() }}
        </div> <!-- ./ card-body -->
    </div> <!-- ./ card -->
</div>
</div>
</div> <!-- ./ container -->

@endsection