@extends('master')

@section('title', 'miniWMS - Ręka Boga')

@section('content')

<div class="container" style="margin-top: 20px;">
    <div class="card">
        <div class="card-body">

            <h5 class="card-title">"Ręka boga"</h5>
            <h6 class="card-subtitle mb-4 text-muted">
                Odwracanie zmian, które zostały wprowadzone na magazynie
            </h6>
        @include('error_raports')

        <style>
        .table > tbody > tr > td
        {
            vertical-align: middle;
        }

        table{
            text-align: center;
        }
        </style>

        <table class="table table-sm">

            <thead>
                <tr>
                    <th scope="col">Akcja</th>
                    <th scope="col">Produkt</th>
                    <th scope="col">Lokalizacja</th>
                    <th scope="col">Ilość</th>
                    <th scope="col">Lokalizacja docelowa</th>
                    <th scope="col">Data</th>
                    <th scope="col"><!-- Wykonaj --></th>
                </tr>
            </thead> <!-- ./ thead -->

            <tbody>
                @forelse($godHand as $record)
                <tr>
                    @if ($record->action == 'attach')
                    <td class="table-success">
                    @elseif ($record->action == 'detach')
                    <td class="table-danger">
                    @else
                    <td class="table-warning">
                    @endif
                        {{ $record->action }}
                    </td>

                    <td>{{ App\Product::getName($record->product_id) }}</td>
                    <td>{{ App\Location::getName($record->location_id)}}</td>
                    <td>{{ $record->quantity_move }}</td>

                    @if($record->target_location_id)
                    <td>
                        {{ App\Location::getName($record->target_location_id)}}
                    </td>
                    @else
                    <td>
                        <span class="badge badge-light">Brak</span>
                    </td>
                    @endif
                    <td>{{ Carbon\Carbon::parse($record->created_at)->format('Y-m-d')}}</td>
                    <td>
                    {!! Form::model($record, ['method'=>'post', 'action'=>['GodHandController@godHand', $record->id]]) !!}
                        <button class="btn btn-outline-success" type="submit"><i class="fas fa-exchange-alt"></i></button>
                    {!! Form::close() !!}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">
                        <div class="alert alert-warning" role="alert">
                            Brak danych
                        </div>
                    </td>
                </tr>
                
                @endforelse

            </tbody> <!-- ./ tbody -->
        </table> <!-- ./ table -->
        <div class="card-footer">
        
            <div class="float-md-right">
            <!-- Show pagination -->
            {{ $godHand->links() }}
            </div>
            <div style="clear: both;"></div>

        </div> <!-- ./ card-footer -->
        </div> <!-- ./ card-body -->
    </div> <!-- ./ card -->

</div> <!-- ./ container -->

@endsection