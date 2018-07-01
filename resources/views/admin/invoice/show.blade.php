@extends('layouts.admin-base')
@section('title') Edit Invoice @endsection
@section('content')
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Invoice</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="col-md-6">
			<a href="{{ route('invoices.index') }}" class="btn btn-default">
				Back to List
			</a>
			<a href="{{ route('invoices.edit',['id'=>$invoice->id]) }}" class="btn btn-default">
				Edit
			</a>
			@if(count($detail)>0)
			<a target="_blank" href="{{ route('invoices.print',['id'=>$invoice->id]) }}" class="btn btn-default">
				Print Ticket
			</a>
			@endif
		</div>
		<div class="col-md-6">
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="panel-body">
		<form class="form-horizontal">
			<div class="form-group">
				<label for="name" class="col-sm-2 control-label">Name</label>
				<div class="col-sm-10">
					<label class="control-label">
						<strong>:&nbsp{{ $invoice->customer->name }}</strong>
					</label>
				</div>
			</div>
			<div class="form-group">
				<label for="name" class="col-sm-2 control-label">Phone</label>
				<div class="col-sm-10">
					<label class="control-label">
						<strong>:&nbsp{{ $invoice->customer->phone }}</strong>
					</label>
				</div>
			</div>
			<div class="form-group">
				<label for="name" class="col-sm-2 control-label">Device Type</label>
				<div class="col-sm-10">
					<label class="control-label">
						<strong>:&nbsp
							{{ $invoice->device->name }} - {{ $invoice->device->color->name }} - {{ $invoice->device->carrier->name }}  - {{ $invoice->device->size->value }}{{ $invoice->device->size->unit }}- {{ $invoice->condition->name }}
						</strong>
					</label>
				</div>
			</div>
			<div class="form-group">
				<label for="name" class="col-sm-2 control-label">Price</label>
				<div class="col-sm-10">
					<label class="control-label">
						<strong>:&nbsp${{ $invoice->condition->price }}</strong>
					</label>
				</div>
			</div>
		</form>
		<p></p>
		<h2 class="pull-left">Parts</h2>
		<div class="table-responsive">
			@include('layouts.alert')
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Part name</th>
						<th>Quantity</th>
						<th>Price</th>
						<th>Tax (8.61%)</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
					@if(count($detail)==0)
					<tr>
						<td colspan="6" class="text-center">No Data</td>
					</tr>
					@else
					@foreach($detail as $row)
					<tr>
						<td>{{ $row->part->name }}</td>
						<td>{{ $row->qty }}</td>
						<td>{{ $row->price }}</td>
						<td>{{ $row->tax }}</td>
						<td>{{ $row->total }}</td>
					</tr>
					@endforeach
					@endif
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection