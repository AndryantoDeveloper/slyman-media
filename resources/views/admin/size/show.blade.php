@extends('layouts.admin-base')
@section('title') Show Size @endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Size</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="col-md-6">
			<a href="{{ route('sizes.index') }}" class="btn btn-default">
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
		      <label for="name" class="col-sm-2 control-label">Value</label>
		      <div class="col-sm-10">
		         <label class="control-label">
		         	<strong>:&nbsp{{ $size->value }}</strong>
		         </label>
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="name" class="col-sm-2 control-label">Size</label>
		      <div class="col-sm-10">
		         <label class="control-label">
		         	<strong>:&nbsp{{ $size->unit }}</strong>
		         </label>
		      </div>
		   </div>
		</form>
	</div>
</div>
@endsection