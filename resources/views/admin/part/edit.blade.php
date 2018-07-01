@extends('layouts.admin-base')
@section('title') Create Part @endsection
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
		<div class="col-md-6"></div>
		<div class="clearfix"></div>
	</div>
	<div class="panel-body">
		 {!! Form::model($data, ['method' => 'PATCH','class'=>'form form-horizontal','id'=>'FormSubmit','route' => ['parts.update', $data->id]]) !!}
		   <div class="form-group">
		      <label for="device_id" class="col-sm-2 control-label">Device</label>
		      <div class="col-sm-10">
		        <select class="form-control" name="device_id" id="device_id">
		        	@foreach($device as $d)
		        		<option id="{{ $d->id }}" value="{{ $d->id }}">
		        			{{ $d->name }} - {{ $d->color->name }} - {{ $d->carrier->name }}  - {{ $d->size->value }}{{ $d->size->unit }}
		        		</option>
		        	@endforeach
		        </select>
		        @if ($errors->has('device_id'))
	            <span class="help-block">
	                <strong class="text-danger">{{ $errors->first('device_id') }}</strong>
	            </span>
	            @endif
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="name" class="col-sm-2 control-label">Name</label>
		      <div class="col-sm-10">
		        {!! Form::text('name', null, array('class' => 'form-control','required'=>true)) !!}
		        @if ($errors->has('name'))
	            <span class="help-block">
	                <strong class="text-danger">{{ $errors->first('name') }}</strong>
	            </span>
	            @endif
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="price" class="col-sm-2 control-label">Price</label>
		      <div class="col-sm-10">
		        {!! Form::number('price', null, array('class' => 'form-control','required'=>true)) !!}
		        @if ($errors->has('price'))
	            <span class="help-block">
	                <strong class="text-danger">{{ $errors->first('price') }}</strong>
	            </span>
	            @endif
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="tax" class="col-sm-2 control-label">Tax</label>
		      <div class="col-sm-10">
		        {!! Form::number('tax', null, array('class' => 'form-control','required'=>true)) !!}
		        @if ($errors->has('tax'))
	            <span class="help-block">
	                <strong class="text-danger">{{ $errors->first('tax') }}</strong>
	            </span>
	            @endif
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="stock" class="col-sm-2 control-label">Stock</label>
		      <div class="col-sm-10">
		        {!! Form::number('stock', null, array('class' => 'form-control','required'=>true)) !!}
		        @if ($errors->has('stock'))
	            <span class="help-block">
	                <strong class="text-danger">{{ $errors->first('stock') }}</strong>
	            </span>
	            @endif
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="description" class="col-sm-2 control-label">Description</label>
		      <div class="col-sm-10">
		        {!! Form::textarea('description', null, array('class' => 'form-control','required'=>false)) !!}
		        @if ($errors->has('description'))
	            <span class="help-block">
	                <strong class="text-danger">{{ $errors->first('description') }}</strong>
	            </span>
	            @endif
		      </div>
		   </div>
		   <div class="form-group">
		      <div class="col-sm-offset-2 col-sm-10">
		         <button type="submit" class="btn btn-default">Save</button>
		      </div>
		   </div>
		{!! Form::close() !!}
	</div>
</div>
@endsection