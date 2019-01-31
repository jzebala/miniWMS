@extends('master')

@section('title', 'Produkt: ' . $product->name)

@section('content')

<div class="container" style="margin-top: 20px;">

    <div class="card">
        <div class="card-body">

        {{-- Show all errors --}}
        @include('error_raports')

        <div class="row">
        <div class="col col-md-7" style="padding-right: 50px;">
            <h3>Karta produktu</h3>
            
            <hr>

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
                        <td>{{ $product->name }}</td>
                    </tr>
                    <tr>
                        <th scope="row" style="vertical-align: middle !important;">Kod EAN</th>
                        <td>{{ $product->ean_code }} {!! DNS1D::getBarcodeHTML($product->ean_code, "EAN13") !!}</td>
                    </tr>
                    <tr>
                        <th scope="row">Stan</th>
                        <td>{{ $product->stockLevel->quantity }} <small> .sztuk</small></td>
                    </tr>
                    <tr>
                        <th scope="row"><!-- Pusto --></th>
                        <td>
                            <a href={{ route('product.productPdf', $product->id ) }} target="_blank" class="btn btn-outline-primary">PDF</a>
                            <a href={{ route('product.attachLocation', $product->id ) }} class="btn btn-outline-success">Przypisz lokalizacje</a>
                        </td>
                    </tr>
                </tbody> <!-- ./tbody -->
            </table> <!-- ./ table -->

        </div> <!-- ./ column LEFT -->


        <div class="col col-md-5">

            <h5>Produkt na lokalizacji</h5>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Lokalizacja</th>
                        <th scope="col">Stan</th>
                        <th scope="col"><!-- Operacje --></th>
                        <th scope="col"><!-- Operacje --></th>
                    </tr>
                </thead> <!-- ./ thead -->

                <tbody>
                     @forelse($product->locations as $location)
                        <tr>
                            <td><a href="#">{{ $location->name }}</a></td>
                            <td>{{ $location->pivot->quantity }}</td>
                            <td class="text-right">
                                <a href={{ route('product.moveProduct', [$product->id, $location->id])}} class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Przenieś</a>
                            </td>
                            <td class="text-right">
                                {{-- Show detach button --}}
                                @include('product.detach_location')
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td><span class="badge badge-warning">Brak</span></td>
                            <td><span class="badge badge-warning">Brak</span></td>
                        </tr>
                    @endforelse
                </tbody> <!-- ./tbody -->
            </table> <!-- ./ table -->
            
        </div> <!-- ./ column RIGHT -->

        </div> <!-- ./ row -->

        <!-- Powrót -->
        <a href="{{ redirect('/product')->getTargetUrl() }}" class="btn btn-link">Powrót do listy produktów</a>

        </div> <!-- ./ card-body -->
    </div> <!-- ./ card -->

</div> <!-- ./ container -->

@endsection