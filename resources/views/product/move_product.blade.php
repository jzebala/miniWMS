@extends('master')

@section('title', $product->name . ' - przenieś produkt')

@section('content')

<div class="container" style="margin-top: 20px;">
<div class="row">
<div class="col-md-6 offset-md-3">
    <div class="card">
        <div class="card-body">

            <h5 class="card-title">Przenieś produkt</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{ $product->name }} / Obecna lokalizacja: {{ $product->getNameLocation($location->id) }}</h6>
            
            <div class="text-right">
                <!-- Powrót -->
                <a href="{{ redirect()->route('product.show', $product->id)->getTargetUrl() }}" class="btn btn-link">Powrót do produktu</a>
            </div> <!-- ./ text-right -->

            {{-- Show all errors --}}
            @include('error_raports')

            {!! Form::model($product, ['method'=>'post', 'action'=>['ProductController@storeMoveProduct', $product->id, $location->id]]) !!}

            <div class="form-group">
                {!! Form::label('location','Przenieś do:') !!}
                {!! Form::select('location', $locations, null,['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('quantity','Ilość:') !!}
                {!! Form::number('quantity', $product->getQuantityLocation($location->id), ['class'=>'form-control', 'min' => '1', 'max' => $product->getQuantityLocation($location->id)]) !!}
            </div>

            <br>
            {!! Form::submit('Przenieś produkt', ['class'=>'btn btn-outline-success']) !!}

            {!! Form::close() !!}

        </div> <!-- ./ card-body -->


    </div> <!-- ./ card -->
</div>
</div>
</div> <!-- ./ container -->

@endsection