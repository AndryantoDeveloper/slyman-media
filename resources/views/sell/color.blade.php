@extends('layouts.app')
@section('title') Sell @endsection
@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<strong>Select you color - Step 2 of 5</strong>
	</div>
	<div class="panel-body text-center">
		<a href="{{ route('sells.index') }}" class="btn btn-warning">
			{{ $model_name }}&nbsp;<i class="fa fa-times"></i> 
		</a>
		<hr>
		@php $i = 1; @endphp
		@foreach($color as $row)
			<a href="{{ route('ordersells.network',[
					'model_id'=>$model_id,
					'color_id'=>$row->id
				]) }}" class="btn btn-lg btn-primary btn-custom">
				{{ $row->name }}
			</a>
		@endforeach
	</div>
</div>
@endsection