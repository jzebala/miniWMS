@extends('pdf.master')

@section('title', 'MiniWms - Stan toksyczny')

@section('content')
<div id="left">
    <p>Stan toksyczny</p>
    <span>Ustawienia {{ $days }} dni</span>
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
            <th>Lokalizacja</th>
            <th>Ilość</th>
            <th><!-- Przypisano --></th>
        </tr>
    </thead> <!-- ./ thead -->
    <tbody>
        @forelse($results as $value)
        <tr>
            <th>{{ $loop->index + 1 }}</th>
            <td>{{ $value['name'] }}</td>
            <td>{{ $value['location'] }}</td>
            <td>{{ $value['quantity'] }} <small>.sztuk</small></td>
            <td style="text-align: center;">{{ $value['created_at'] }} &nbsp; &nbsp; <small>{{ $value['days'] }} dni temu</small></td>
        </tr>
        @empty
            <tr>
                <td colspan="5">
                    <div style="text-align: center;">
                        Brak danych
                    </div>
                </td>
            </tr>
        @endforelse
    </tbody> <!-- ./ tbody -->
</table> <!-- ./ table -->
@endsection