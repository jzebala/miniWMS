@extends('master')

@section('title', 'Locations')

@section('content')

<div class="container" style="margin-top: 20px;">
<div class="row">
<div class="col-md-8 offset-md-2">
    <div class="card">
        <div class="card-body">

        <h5 class="card-title">Lokalizacje</h5>
        <h6 class="card-subtitle mb-2 text-muted">Ilość lokalizacji: {{ App\Location::count() }}</h6>

        <div class="text-right">
            <a class="btn btn-link" data-toggle="collapse" href="#locationInfo" role="button" aria-expanded="false" aria-controls="locationInfo">
                Lokalizacje opis...
            </a>
        </div>

        <div class="collapse" id="locationInfo">
            <div class="alert alert-info">
                <p>Opis lokalizacji:</p>
                <ul>
                    <li>
                        <strong><span class="badge badge-primary">10</span>-2-1</strong>
                        <ul>
                            <li>Regał</li>
                        </ul>
                    </li>
                    <li>
                        <strong>10-<span class="badge badge-primary"> 2 </span>-1</strong>
                        <ul>
                            <li>Półka</li>
                        </ul>
                    </li>
                    <li>
                        <strong>10-2-<span class="badge badge-primary"> 1 </span></strong>
                        <ul>
                            <li>Rząd</li>
                        </ul>
                    </li>
                </ul>
                <i><small>Czytaj: Regał 10, Półka 2, Rząd 1.</small></i>
            </div>
        </div>


        <table class="table">

            <thead>
                <tr>
                    <th scope="col">Lokalizacja</th>
                    <th scope="col">Ilość produktów</th>
                    <th scope="col"><!-- Wyświetl --></th>
                </tr>
            </thead> <!-- ./ thead -->

            <tbody>
            @foreach($locations as $location)
                <tr>
                    <td>{{ $location->name }}</td>
                    <td>
                    @if($location->productsCount() > 0)
                        Produkty <span class="badge badge-success">{{ $location->productsCount() }}</span>
                    @else
                        <span class="badge badge-warning">Pusto</span>
                    @endif
                    </td>
                    <td class="text-center">
                        <a href={{ route('location.show', $location->id) }} class="btn btn-outline-success">Wyświetl</a>
                    </td>
                </tr>
            @endforeach
            </tbody> <!-- ./ tbody -->

        </table> <!-- ./ table -->


        </div> <!-- ./ card-body -->

        <div class="card-footer">
        
            <div class="float-md-right">
            <!-- Show pagination -->
            {{ $locations->links() }}
            </div>
            <div style="clear: both;"></div>

        </div> <!-- ./ card-footer -->
    </div> <!-- ./ card -->
</div>
</div>
</div> <!-- ./ container -->

@endsection