{{-- Detach location --}}
{!! Form::open(['method' => 'POST', 'action' => ['ProductController@detachLocation']]) !!}
{!! Form::hidden('product', $product->id) !!}
{!! Form::hidden('location', $location->id) !!}
{!! Form::hidden('quantity', $product->getQuantityLocation($location->id)) !!}
<button type="submit" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Usuń</button>
{!! Form::close() !!}