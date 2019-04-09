@extends('master')

@section('title', 'miniWMS - Lista inwentaryzacyjna')

@section('content')

<div class="container" style="margin-top: 20px;">
<div class="row">
<div class="col-md-6 offset-md-3">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Lista inwentaryzacyjna</h5>
            <h6 class="card-subtitle mb-4 text-muted">
                Wybierz lokalizację, na których chcesz przeprowadzić inwentaryzacje.
            </h6>

            {!! Form::open(['action' => 'InventoryListController@abc', 'method' => 'POST']) !!}
            <div class="form-check text-right">
                <input class="form-check-input" type="checkbox" name="all" id="checkbox_all">
                <label class="form-check-label" for="checkbox_all">
                    <strong>Wszystkie lokalizacje</strong>
                </label>
            </div>
            <hr>
            @foreach ($locations as $location)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="{{$location->id}}" id="checkbox_{{$location->id}}">
                <label class="form-check-label" for="checkbox_{{$location->id}}">
                    {{ $location->name }}
                </label>
            </div>
            <hr>
            @endforeach

            <div class="float-right">
                <input class="btn btn-outline-primary btn-lg" type="submit" value="Wykonaj" >
            </div>
            
            {!! Form::close() !!}
        </div> <!-- ./ card-body -->
    </div> <!-- ./ card -->
</div>
</div>
</div> <!-- ./ container -->
@endsection