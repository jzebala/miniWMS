@extends('master')

@section('title', 'miniWMS')

@section('content')

<div class="container" style="margin-top: 20px;">
<div class="row">
    <div class="col col-md-8">
        <div class="card">
            <div class="card-header">
                Lokalizacje
            </div> <!-- ./ card-header -->

            <div class="card-body">
                <table class="table">

                    <thead>
                        <tr>
                            <th scope="col">Lokalizacja</th>
                            <th scope="col" class="text-center">Ilość produktów</th>
                            <th scope="col"><!-- Wyświetl --></th>
                        </tr>
                    </thead> <!-- ./ thead -->

                    <tbody>
                    @foreach($locations as $location)
                        <tr>
                            <td>{{ $location->name }}</td>
                            <td class="text-center">
                            @if($location->productsCount() > 0)
                                Produkty <span class="badge badge-success">{{ $location->productsCount() }}</span>
                            @else
                                <span class="badge badge-warning">Pusto</span>
                            @endif
                            </td>
                            <td class="text-right">
                                <a href={{ route('location.show', $location->id) }} class="btn btn-outline-success">Wyświetl</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody> <!-- ./ tbody -->
                </table> <!-- ./ table -->
            </div> <!-- ./ card-body -->

        </div> <!-- ./ card -->
    </div> <!-- ./ col-md-8 -->

    <div class="col col-md-4">

        <div class="card border-light">
            <div class="card-header">
                Witaj, {{ Auth::user()->name }}
            </div> <!-- ./ card-header -->

            <div class="card-body">
                <div class="text-center">
                    <img src={{ asset('user.png') }} class="rounded-circle" alt="User image">
                </div>
                <hr>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{ route('user.show', Auth::user()->id) }}" class="btn btn-outline-primary"><i class="fas fa-user"></i> Profil</a>
                    <a href="#" class="btn btn-outline-success"><i class="fas fa-envelope"></i> Wiadomości (5)</a>
                    <!-- <a href="#" class="btn btn-outline-secondary"><i class="fas fa-sign-out-alt"></i>Wyloguj</a> -->
                    <a href="{{ route('logout') }}" class="btn btn-outline-secondary" 
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>Wyloguj
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div> <!-- ./ card-body -->
        </div> <!-- ./ card -->

        <hr>

        <div class="card">
            <div class="card-header">
                Stany magazynowe
            </div> <!-- ./ card-header -->

            <div class="card-body">
                <div class="list-group list-group-flush">
                    <a href={{ route('stocklevel.discrepancy') }} class="list-group-item list-group-item-action">Rozbieżność</a>
                    <a href={{ route('stocklevel.expired') }} class="list-group-item list-group-item-action">Stan toksyczny</a>
                </div> <!-- ./ list-group -->
            </div> <!-- ./ card-body -->
        </div> <!-- ./ card -->

        <hr>

        <div class="card">
            <div class="card-header">
                Operacje
            </div> <!-- ./ card-header -->

            <div class="card-body">
                <div class="list-group list-group-flush">
                    <a href={{ route('godhand.index') }} class="list-group-item list-group-item-action">Ostatnia aktywność</a>
                    <a href={{ route('inventoryList') }} target="_blank" class="list-group-item list-group-item-action">
                        Lista inwentaryzacyjna
                        <span class="badge badge-primary">PDF</span>
                    </a>
                </div> <!-- ./ list-group -->
            </div> <!-- ./ card-body -->
        </div> <!-- ./ card -->

    </div> <!-- ./ col-md-4 -->
</div> <!-- ./ row -->

</div> <!-- ./ container -->

@endsection