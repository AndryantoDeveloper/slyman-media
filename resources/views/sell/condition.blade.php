@extends('layouts.app')
@section('title') Sell @endsection
@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<strong>Select you condition - Step 5 of 5</strong>
	</div>
	<div class="panel-body text-center">
		<a href="{{ route('sells.index') }}" class="btn btn-warning">
			{{ $model_name }}&nbsp;<i class="fa fa-times"></i> 
		</a>
		<a href="{{ route('ordersells.color',['model_id'=>$model_id]) }}" class="btn btn-warning">
			{{ $color_name }}&nbsp;<i class="fa fa-times"></i> 
		</a>
		<a href="{{ route('ordersells.network',[
					'model_id'=>$model_id,
					'color_id'=>$color_id
				]) }}" class="btn btn-warning">
			{{ $carrier_name }}&nbsp;<i class="fa fa-times"></i> 
		</a>
		<a href="{{ route('ordersells.size',[
					'model_id'=>$model_id,
					'color_id'=>$color_id,
					'carrier_id'=>$carrier_id
				]) }}" class="btn btn-warning">
			{{ $size_name }}&nbsp;<i class="fa fa-times"></i> 
		</a>
		<hr>
		@php $i = 1; @endphp
		@foreach($condition as $row)
			<a href="{{ route('ordersells.checkout',[
					'model_id'=>$model_id,
					'color_id'=>$color_id,
					'carrier_id'=>$carrier_id,
					'size_id'=>$size_id,
					'condition_id'=>$row->id
				]) }}" class="btn btn-lg btn-primary btn-custom">
				{{ $row->name }}
			</a>
		@endforeach
	</div>
</div>
@endsection