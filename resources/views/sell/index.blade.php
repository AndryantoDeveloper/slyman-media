@extends('layouts.app')
@section('title') Sell @endsection
@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<strong>Select you model - Step 1 of 5</strong>
	</div>
	<div class="panel-body text-center">
		@include('layouts.alert')
		@php $i = 1; @endphp
		@foreach($model as $row)
			<a href="{{ route('ordersells.color',['model_id'=>$row->id]) }}" class="btn btn-lg btn-primary btn-custom">
				{{ $row->name }}
			</a>
		@endforeach
	</div>
</div>
@endsection