@extends('pdf.master')

@section('title', 'MiniWms - Stan toksyczny')

@section('content')
<div id="left">
    <p>Karta produktu</p>
</div>

<div id="right">
    miniWms: {{ Carbon\Carbon::now('Europe/Warsaw')->format('d-m-Y H:i:s') }}
</div>

<div style="clear: both;"></div>

<hr>

<table class="table table-bordered">
    <thead>
        <tr>
            <th><!-- Pusto --></th>
            <th>Opis</th>
        </tr>
    </thead> <!-- ./ thead -->
    <tbody>
        <tr>
            <th style="border-right: 1px solid #DDDDDD;">Nazwa</th>
            <td>{{ $product->name }}</td>
        </tr>
        <tr>
            <th style="vertical-align: middle !important; border-right: 1px solid #DDDDDD;">Kod EAN</th>
            <td>
            {!! DNS1D::getBarcodeHTML($product->ean_code, "EAN13") !!}
            {{ $product->ean_code }}
            </td>
        </tr>
        <tr>
            <th style="border-right: 1px solid #DDDDDD;">Stan</th>
            <td>{{ $product->stockLevel->quantity }} <small> .sztuk</small></td>
        </tr>
    </tbody> <!-- ./tbody -->
</table> <!-- ./ table -->

<style>
th, td
{
    border: 1px solid #DDDDDD;
    padding-left: 5px;
}
</style>

<table>
    <thead>
        <tr>
            <th></th>
            <th>Lokalizacja</th>
            <th>Kod kreskowy</th>
            <th>Ilośc</th>
        </tr>
    </thead> <!-- ./ thead -->

    <tbody>
        @forelse($product->locations as $location)
            <tr>
                <th scope="row">{{ $loop->index + 1 }}</th>
                <td>{{ $location->name }}</td>
                <td>{!! DNS1D::getBarcodeHTML($location->name, "C39") !!}</td>
                <td>{{ $location->pivot->quantity }} <small> .sztuk</small></td>
            </tr>
        @empty
            <tr>
                <td colspan="4">
                    <div style="text-align: center;">
                        Brak danych
                    </div>
                </td>
            </tr>
        @endforelse
    </tbody> <!-- ./tbody -->
</table> <!-- ./ table -->
@endsection