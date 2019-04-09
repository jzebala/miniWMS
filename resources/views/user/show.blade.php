@extends('master')

@section('title', 'Użytkownik: ' . $user->name)

@section('content')
<div class="container" style="margin-top: 20px;">
<div class="row">
<div class="col-md-6 offset-md-3">
    <div class="card">
        <div class="card-body">
            <div class="text-center">
                <img src={{ asset('user.png') }} class="rounded-circle" alt="User image">
            </div>
			<hr>
            @include('error_raports')
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col"><!-- Pusto --></th>
                        <th scope="col">Opis</th>
                    </tr>
                </thead> <!-- ./ thead -->

                <tbody>
                    <tr>
                        <th scope="row">Nazwa</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Uprawnienia</th>
                        <td>
						@foreach($user->roles as $role)
							{{ $role->name }}
						@endforeach
						</td>
                    </tr>
                    <tr>
                        <th scope="row">E-mail</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th scope="row"><!-- Pusto --></th>
                        <td>
							<a href="{{ route('user.changePasswordForm', $user->name) }}" class="btn btn-outline-primary">Zmień hasło</a>
							<button class="btn btn-outline-success">Edytuj</button>
                            <a href="{{ route('logout') }}" class="btn btn-outline-secondary" 
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            Wyloguj
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </td>
                    </tr>
                </tbody> <!-- ./tbody -->
            </table> <!-- ./ table -->

          </div>

        </div> <!-- ./ card-body -->
    </div> <!-- ./ card -->
</div>
</div>
</div> <!-- ./ container -->

@endsection