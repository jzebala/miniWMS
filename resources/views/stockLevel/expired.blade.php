@extends('master')

@section('title', 'miniWMS - Stany toksyczne')

@section('content')

<div class="container" style="margin-top: 20px;">

    <div class="card">
        <div class="card-body">

        <div class="row">
            <div class="col col-md-8">
                <h5 class="card-title">Stan toksyczny</h5>
                <h6 class="card-subtitle mb-4 text-muted">
                Produkty które na lokalizacji są dłużej niż 
                <a href={{ route('stocklevel.expired') }}>10 dni</a>
                </h6>
            </div> <!-- ./ col -->

            <div class="col col-md-4 text-right">
            {!! Form::open(['method'=>'GET', 'route' => 'stocklevel.expired'])  !!}
                <div class="input-group">
                    <input type="number" name="days" class="form-control" min="1" placeholder="Ile dni ?">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit" id="button-addon2">Wyświetl</button>
                    </div>
                </div>
            {!! Form::close() !!}
            </div> <!-- ./ col -->
        </div> <!-- ./ row -->


        <table class="table">

            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Produkt</th>
                    <th scope="col">Lokalizacja</th>
                    <th scope="col">Ilość</th>
                    <th scope="col"><!-- Przypisano --></th>
                </tr>
            </thead> <!-- ./ thead -->

            <tbody>
                @forelse($results as $value)
                @if($loop->index + 1 <= 3)
                <tr class="table-warning">
                @else
                <tr class="table-info">
                @endif
                
                    <th scope="row">{{ $loop->index + 1 }}</th>
                    <td>
                        <a style="color:black;" href={{ route('product.show', $value['product_id']) }}>{{ $value['name'] }}</a>
                    </td>
                    <td>{{ $value['location'] }}</td>
                    <td>{{ $value['quantity'] }}</td>
                    <td class="text-center">{{ $value['created_at'] }} &nbsp; <span class="badge badge-primary">{{ $value['days'] }} dni temu</span></td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">
                        <div class="alert alert-warning text-center" role="alert">
                            Brak danych
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody> <!-- ./ tbody -->

        </table> <!-- ./ table -->

        </div> <!-- ./ card-body -->
        <div class="card-footer text-right">
            @if(Request::get('days'))
                <a href={{ route('stocklevel.expiredPdf', Request::get('days')) }} target="_blank" class="btn btn-outline-primary">PDF</a>
            @else
                <a href={{ route('stocklevel.expiredPdf', 10) }} target="_blank" class="btn btn-outline-primary">PDF</a>
            @endif
        </div>
    </div> <!-- ./ card -->

</div> <!-- ./ container -->

@endsection