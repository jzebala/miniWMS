@extends('master')

@section('title', 'Products')

@section('content')

<div class="container" style="margin-top: 20px;">
    <div class="card">
        <div class="card-body">

        <div class="row">
            <div class="col col-md-8">
                <h5 class="card-title">Produkty</h5>
                @if(Request::get('search'))
                    <h6 class="card-subtitle mb-2 text-muted">Znaleziono produktów: {{ $products->count() }}</h6>
                @else
                <h6 class="card-subtitle mb-2">
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ilość produktów: {{ App\Product::count() }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href={{ route('product.excel') }} >Pobierz w Excel</a>
                        </div>
                    </div>
                </h6>
                @endif
            </div> <!-- ./ col -->

            <div class="col col-md-4 text-right">
            {!! Form::open(['method'=>'GET', 'route' => 'product.index'])  !!}
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Czego szukasz ?">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit">Wyświetl</button>
                    </div>
                </div>
            {!! Form::close() !!}
            </div> <!-- ./ col -->
        </div> <!-- ./ row -->

        <table class="table">

            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nazwa</th>
                    <th scope="col">EAN</th>
                    <th scope="col">Stan</th>
                    <th scope="col">Lokalizacja</th>
                    <th scope="col">Wyświetl</th>
                </tr>
            </thead> <!-- ./ thead -->

            <tbody>
                @forelse($products as $product)
                <tr>
                    <th scope="row">{{ $loop->index + 1 }}</th>
                    <td>
                        {{ strtoupper(str_limit($product->name, 20)) }}
                    </td>
                    <td>{{ $product->ean_code }}</td>
                    <td>{{ $product->stockLevel->quantity }} </td>
                    <td>
                        
                        @forelse($product->locations as $location)
                            <span class="badge badge-success">{{ $location->name }}</span>
                        @empty
                            <span class="badge badge-warning">Brak</span>
                        @endforelse
                    </td>
                    <td>
                        <a href={{ route('product.show', $product->id) }} class="btn btn-outline-success">Wyświetl</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        <div class="alert alert-warning text-center" role="alert">
                            Brak wyników wyszukiwania!
                        </div>
                    </td>
                </tr>
                
                @endforelse

            </tbody> <!-- ./ tbody -->

        </table> <!-- ./ table -->

        </div> <!-- ./ card-body -->

        {{-- Show if isset pagination --}}
        @if($products instanceof \Illuminate\Pagination\AbstractPaginator)
        <div class="card-footer">
            <div class="float-md-right">
            <!-- Show pagination -->
            {{ $products->links() }}
            </div>
            <div style="clear: both;"></div>

        </div> <!-- ./ card-footer -->
        @endif

    </div> <!-- ./ card -->

</div> <!-- ./ container -->

@endsection