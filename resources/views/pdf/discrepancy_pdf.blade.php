@extends('pdf.master')

@section('title', 'MiniWms - Stan toksyczny')

@section('content')
<div id="left">
    <p>Rozbieżności stanu</p>
</div>

<div id="right">
    miniWms: {{ Carbon\Carbon::now('Europe/Warsaw')->format('d-m-Y H:i:s') }}
</div>

<div style="clear: both;"></div>

<hr>

<table>
    <thead>
        <tr>
            <th></th>
            <th>Produkt</th>
            <th>Stan</th>
            <th>Stan na lokalizacjach</th>
            <th>Rozbieżność</th>
            <th>Lokalizacje</th>
        </tr>
    </thead> <!-- ./ thead -->

    <tbody >
    @forelse($products as $product)
        <tr>
            <th>{{ $loop->index + 1 }}</th>
            <td>{{ $product->name }}</td>
            <td>{{ $product->stocklevel->quantity }}</td>
            <td>
                {{ $product->locations()->sum('quantity') }}
            </td>
            <td style="font-weight: bold;"> + {{ $product->locations()->sum('quantity') - $product->stocklevel->quantity }}</td>
            <td>
            @foreach($product->locations as $location)
                {{ $location->name }}, 
            @endforeach
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6">
                <div style="text-align: center;">
                    Brak danych
                </div>
            </td>
        </tr>
    @endforelse
    </tbody> <!-- ./ tbody -->
</table> <!-- ./ table -->
@endsection