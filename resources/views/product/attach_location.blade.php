@extends('master')

@section('title', $product->name . ' - przypisz lokalizacje')

@section('content')

<div class="container" style="margin-top: 20px;">
<div class="row">
<div class="col-md-6 offset-md-3">
    <div class="card">
        <div class="card-body">

            <h5 class="card-title">Przypisz lokalizacje</h5>
            <h6 class="card-subtitle mb-2 text-muted">Produkt: {{ $product->name }} / Stan: {{ $product->stockLevel->quantity }}<small> .sztuk</small></h6>
            
            <div class="text-right">
                <!-- Powrót -->
                <a href="{{ redirect()->route('product.show', $product->id)->getTargetUrl() }}" class="btn btn-link">Powrót do produktu</a>
            </div> <!-- ./ text-right -->

            {{-- Show all errors --}}
            @include('error_raports')

            {!! Form::model($product, ['method'=>'post', 'action'=>['ProductController@storeAttachLocation', $product->id]]) !!}
            <div class="form-group">
                {!! Form::label('location','Lokalizacja:') !!}
                @if($disabled == true)
                {!! Form::select('location', ['Brak dostępnych lokalizacji'], null,['class'=>'form-control', 'disabled']) !!}
                @else
                {!! Form::select('location', $locations, null,['class'=>'form-control']) !!}
                @endif
            </div>

            <div class="form-group">
                {!! Form::label('quantity','Ilość:') !!}
                {!! Form::number('quantity', null, ['class'=>'form-control', 'min' => '1']) !!}
            </div>

            <div class="form-check font-italic small">
                {!! Form::checkbox('back', 1, false, ['class'=>'form-check-input', 'id' => 'checkbox']) !!}

                <label class="form-check-label" for="checkbox">
                    Po przypisaniu, powróć do tego formularza.
                </label>
            </div>

            <br>
            {!! Form::submit('Przypisz lokalizacje', ['class'=>'btn btn-outline-success']) !!}

            {!! Form::close() !!}

        </div> <!-- ./ card-body -->


    </div> <!-- ./ card -->
</div>
</div>
</div> <!-- ./ container -->

@endsection