@extends('layouts.app')
@section('title') Sell @endsection
@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<strong>Final Step</strong>
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
		<a href="{{ route('ordersells.condition',[
					'model_id'=>$model_id,
					'color_id'=>$color_id,
					'carrier_id'=>$carrier_id,
					'size_id'=>$size_id
				]) }}" class="btn btn-warning">
			{{ $condition_name }}&nbsp;<i class="fa fa-times"></i> 
		</a>
		<hr>
		<h2>Total Paid : $ {{ $price }}</h2>&nbsp;
		<a href="javascript:void(0);" class="btn btn-success" onclick="event.preventDefault(); document.getElementById('checkout-form').submit();">
			<i class="fa fa-dropbox"></i>&nbsp;Order Now
		</a>
		<form id="checkout-form" action="{{ route('sells.store') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
            <input type="hidden" name="device_id" value="{{ $device_id }}">
            <input type="hidden" name="condition_id" value="{{ $condition_id }}">
        </form>
	</div>
</div>
@endsection