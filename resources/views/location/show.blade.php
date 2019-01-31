@extends('master')

@section('title', 'Lokalizacja: ' . $location->name)

@section('content')

<div class="container" style="margin-top: 20px;">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Lokalizacja: <small>{{ $location->name }}</small></h5>
            <h6 class="card-subtitle mb-2 text-muted">Lokalizacja na magazynie</h6>
        </div> <!-- ./ card-body -->
    </div> <!-- ./ card -->

</div> <!-- ./ container -->

@endsection