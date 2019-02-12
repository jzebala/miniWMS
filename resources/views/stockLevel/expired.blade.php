@extends('master')

@section('title', 'miniWMS - Stany toksyczne')

@section('content')

<script>
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})
</script>

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

                @if(Request::get('days'))
                    @if(Request::get('days') == 'month')
                        <p class="mb-2">Wybrano: ostatni miesiąc.</p>
                    @else
                        <p class="mb-2">Wybrano: {{ Request::get('days') }} dni.</p>
                    @endif
                @else
                    <p class="mb-2">Wybrano: 10 dni.</p>
                @endif
            </div> <!-- ./ col -->

            <div class="col col-md-4 text-right">
            {!! Form::open(['method'=>'GET', 'route' => 'stocklevel.expired'])  !!}
                <div class="input-group">
                    <input type="number" name="days" class="form-control" min="1" placeholder="Ile dni ?">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-primary">Wyświetl</button>
                        <button type="button" class="btn btn-outline-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>

                        <div class="dropdown-menu">
                            <a class="dropdown-item" href={{ route('stocklevel.expired', ['days' => 10]) }}>10 dni</a>
                            <a class="dropdown-item" href={{ route('stocklevel.expired', ['days' => 20]) }}>20 dni</a>
                            <div role="separator" class="dropdown-divider"></div>
                            <a class="dropdown-item" href={{ route('stocklevel.expired', ['days' => 'month']) }}>Ostatni miesiąc</a>
                        </div>
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
                    <td class="text-center">
                        <span data-toggle="tooltip" data-placement="top" title="Godzina: {{ $value['time_created_at'] }}"">{{ $value['created_at'] }}</span> &nbsp; 
                        <span class="badge badge-primary">{{ $value['days'] }} dni temu</span>
                    </td>
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

        {{-- No results, don't show export to pdf button --}}
        @if(!empty($results))
        <div class="card-footer text-right">
            @if(Request::get('days'))
                <a href={{ route('stocklevel.expiredPdf', Request::get('days')) }} target="_blank" class="btn btn-outline-primary">PDF</a>
            @else
                <a href={{ route('stocklevel.expiredPdf', 10) }} target="_blank" class="btn btn-outline-primary">PDF</a>
            @endif
        </div>
        @endif
    </div> <!-- ./ card -->

</div> <!-- ./ container -->

@endsection