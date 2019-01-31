@extends('pdf.master')

@section('title', 'MiniWms - Lista inwentaryzacyjna')

@section('content')
<div id="left">
    <p>Lista inwentaryzacyjna</p>
</div>

<div id="right">
    miniWms: {{ Carbon\Carbon::now('Europe/Warsaw')->format('d-m-Y H:i:s') }}
</div>

<div style="clear: both;"></div>

<hr>
<style>
body
{
    font-size: 13px;
}
th, td
{
    border: 1px solid #DDDDDD;
    padding: 5;
}
</style>
<table>
    <thead>
        <tr>
            <th>Lok.</th>
            <th>Produkt</th>
            <th>EAN</th>
            <th>Ilość</th>
            <th>Ilość</th>
            <th>Uwagi</th>
        </tr>
    </thead> <!-- ./ thead -->

    <tbody>
    @foreach ($results as $result)
        <tr>
            <td>{{ $result['location'] }}</td>
            <td>{{ $result['product'] }}</td>
            <td>{{ $result['ean_code'] }}</td>
            <td style="text-align: center;">{{ $result['quantity'] }}</td>
            <td></td>
            <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
        </tr>
    @endforeach
    </tbody> <!-- ./ tbody -->
</table> <!-- ./ table -->
@endsection