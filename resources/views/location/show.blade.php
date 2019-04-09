@extends('master')

@section('title', 'Lokalizacja: ' . $location->name)

@section('content')

<div class="container" style="margin-top: 20px;">
<div class="row">
<div class="col-md-8 offset-md-2">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Lokalizacja: <small>{{ $location->name }}</small></h5>
            <h6 class="card-subtitle mb-2 text-muted">Produkty na tej lokalizacji</h6>
            @include('error_raports')
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Produkt</th>
                        <th scope="col">Ilość</th>
                        <th scope="col">Przypisano</th>
                        <th scope="col"><!-- empty --></th>
                        <th scope="col"><!-- empty --></th>
                    </tr>
                </thead>
                <tbody>
                @forelse($products as $product)
                    <tr>
                        <th scope="row">{{$loop->index + 1 }}</th>
                        <td>{{ $product['name'] }}</td>
                        <td>{{ $product['quantity'] }}</td>
                        <td>{{ $product['created_at'] }}</td>
                        <td>
                        {{-- Detach location --}}
                        {!! Form::open(['method' => 'POST', 'action' => ['LocationController@detachProduct']]) !!}
                        {!! Form::hidden('product', $product['id']) !!}
                        {!! Form::hidden('location', $location->id) !!}
                        {!! Form::hidden('quantity', $product['quantity']) !!}
                        <button type="submit" class="btn btn-outline-danger">Usuń</button>
                        {!! Form::close() !!}
                        </td>
                        <td>
                            <a href="{{ route('product.show', $product['id'])}}" class="btn btn-outline-success">Wyświetl</a>
                        </td>
                    </tr>
                @empty
                    <td colspan="5">
                        <div class="alert alert-warning text-center" role="alert">
                            Brak produktów na lokalizacji.
                        </div>
                    </td>
                @endforelse
                </tbody>
            </table>


            <!-- Powrót -->
            <a href="{{ route('location.index')}}" class="btn btn-link">Powrót do listy lokalizacji</a>
        </div> <!-- ./ card-body -->
    </div> <!-- ./ card -->
</div>
</div>
</div> <!-- ./ container -->

@endsection