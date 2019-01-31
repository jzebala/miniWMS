@extends('master')

@section('title', 'miniWMS - Rozbieżność stanu')

@section('content')

<div class="container" style="margin-top: 20px;">

    <div class="card">
        <div class="card-body">

            <h5 class="card-title">Rozbieżności stanu</h5>
            <h6 class="card-subtitle mb-4 text-muted">
                Produkty których łączna ilość na lokalizacjach, przekracza stan informatyczny
            </h6>


        <!-- CONTENT -->
        <table class="table">

            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Produkt</th>
                    <th scope="col">Stan</th>
                    <th scope="col">Stan na lokalizacjach</th>
                    <th scope="col">Rozbieżność</th>
                    <th scope="col">Lokalizacje</th>
                </tr>
            </thead> <!-- ./ thead -->

            <tbody>
            @forelse($products as $product)
                <tr>
                    <th scope="row">{{ $loop->index + 1 }}</th>
                    <td>
                        <a style="color:black;" href={{ route('product.show', $product->id) }}>{{ $product->name }}</a>
                    </td>
                    <td>{{ $product->stocklevel->quantity }}</td>
                    <td>
                        {{ $product->locations()->sum('quantity') }}
                    </td>
                    <td class="table-danger font-weight-bold"> + {{ $product->locations()->sum('quantity') - $product->stocklevel->quantity }}</td>
                    <td>
                    @foreach($product->locations as $location)
                        <a href={{ route('product.show', $product->id) }} class="badge badge-primary">{{ $location->name }}</a>
                    @endforeach
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">
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
            <a href={{ route('stocklevel.discrepancyPdf') }} target="_blank" class="btn btn-outline-primary">PDF</a>
        </div>
    </div> <!-- ./ card -->

</div> <!-- ./ container -->

@endsection