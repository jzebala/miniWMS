@extends('master')

@section('title', 'miniWMS - Lista inwentaryzacyjna')

@section('content')

<div class="container" style="margin-top: 20px;">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Lista inwentaryzacyjna</h5>
            <h6 class="card-subtitle mb-4 text-muted">
                Odwracanie zmian, które zostały wprowadzone na magazynie
            </h6>

            <form action="{{ route('InventoryList.index') }}" method="GET">

                <!-- @csrf -->

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
            </form>
        </div> <!-- ./ card-body -->
    </div> <!-- ./ card -->
</div> <!-- ./ container -->
@endsection