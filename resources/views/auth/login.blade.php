<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>miniWMS - Panel logowania</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/main.css') }}" rel="stylesheet">
        
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    </head>
<body>
<style>
.row{
    margin-top: 10%;
}
</style>
<div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-4 text-center">
            <div class="card">
                <div class="card-body">

                    <img src={{ asset('user.png') }} class="rounded-circle" alt="User image">

                    <h2 class="mb-3 mt-2">Witaj, zaloguj się!</h2>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Adres email" required autofocus>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong class="form-text text-danger">{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <input type="password"  class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"  placeholder="Hasło" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong class="form-text text-danger">{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-check text-left mb-3 mt-2">
                            <input type="checkbox" class="form-check-input"  name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">Zapamiętaj mnie</label>
                        </div>
                        
                        <div class="text-left">
                            <button style="width: 100%;" type="submit" class="btn btn-outline-success btn-lg">Zaloguj</button>
                        </div>
                        
                    </form> <!-- ./ form -->
                </div> <!-- ./ card-body -->
            </div> <!-- ./ card -->
        </div> <!-- ./ col -->
    </div> <!-- ./ row -->
</div> <!-- ./ container -->

<footer class="footer text-right">
    <span>Magazynowy system informatyczny &nbsp; &nbsp; &nbsp; &nbsp; </span>
</footer>

</body>
</html>
