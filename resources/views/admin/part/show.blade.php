@extends('layouts.admin-base')
@section('title') Show Part @endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Part</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="col-md-6">
			<a href="{{ route('parts.index') }}" class="btn btn-default">
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
		      <label for="name" class="col-sm-2 control-label">Device</label>
		      <div class="col-sm-10">
		         <label class="control-label">
		         	<strong>:&nbsp{{ $part->device->name }}</strong>
		         </label>
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="name" class="col-sm-2 control-label">Name</label>
		      <div class="col-sm-10">
		         <label class="control-label">
		         	<strong>:&nbsp{{ $part->name }}</strong>
		         </label>
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="name" class="col-sm-2 control-label">Price</label>
		      <div class="col-sm-10">
		         <label class="control-label">
		         	<strong>:&nbsp{{ $part->price }}</strong>
		         </label>
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="name" class="col-sm-2 control-label">Stock</label>
		      <div class="col-sm-10">
		         <label class="control-label">
		         	<strong>:&nbsp{{ $part->stock }}</strong>
		         </label>
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="name" class="col-sm-2 control-label">Tax</label>
		      <div class="col-sm-10">
		         <label class="control-label">
		         	<strong>:&nbsp{{ $part->tax }}</strong>
		         </label>
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="name" class="col-sm-2 control-label">Description</label>
		      <div class="col-sm-10">
		         <label class="control-label">
		         	<strong>:&nbsp{{ $part->description }}</strong>
		         </label>
		      </div>
		   </div>
		</form>
	</div>
</div>
@endsection