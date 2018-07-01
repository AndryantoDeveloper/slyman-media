@extends('layouts.admin-base')
@section('title') Show Device @endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Device</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="col-md-6">
			<a href="{{ route('devices.index') }}" class="btn btn-default">
				Back to List
			</a>
		</div>
		<div class="col-md-6">
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="panel-body">
		<form class="form-horizontal">
		    <div class="form-group">
		      <label for="name" class="col-sm-2 control-label">Model</label>
		      <div class="col-sm-10">
		         <label class="control-label">
		         	<strong>:&nbsp{{ $device->model->name }}</strong>
		         </label>
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="name" class="col-sm-2 control-label">Name</label>
		      <div class="col-sm-10">
		         <label class="control-label">
		         	<strong>:&nbsp{{ $device->name }}</strong>
		         </label>
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="name" class="col-sm-2 control-label">Size</label>
		      <div class="col-sm-10">
		         <label class="control-label">
		         	<strong>:&nbsp{{ $device->size->value }} {{ $device->size->unit }}</strong>
		         </label>
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="name" class="col-sm-2 control-label">Color</label>
		      <div class="col-sm-10">
		         <label class="control-label">
		         	<strong>:&nbsp{{ $device->color->name }}</strong>
		         </label>
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="name" class="col-sm-2 control-label">Carrier</label>
		      <div class="col-sm-10">
		         <label class="control-label">
		         	<strong>:&nbsp{{ $device->carrier->name }}</strong>
		         </label>
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="name" class="col-sm-2 control-label">Conditions</label>
		      <div class="col-sm-10">
		         <label class="control-label">
		         	<strong>
		         	 	:&nbsp
		         	 	@if(count($device->conditions) > 0)
		         	 		@foreach($device->conditions as $c)
		         	 			{{ $c->name }} ,
		         	 		@endforeach
		         	 	@else
		         	 		No Data
		         	 	@endif
		         	 </strong>
		         </label>
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="name" class="col-sm-2 control-label">Description</label>
		      <div class="col-sm-10">
		         <label class="control-label">
		         	<strong>:&nbsp{{ $device->description }}</strong>
		         </label>
		      </div>
		   </div>
		</form>
	</div>
</div>
@endsection