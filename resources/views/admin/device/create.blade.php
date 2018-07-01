@extends('layouts.admin-base')
@section('title') Create Device @endsection
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
		<div class="col-md-6"></div>
		<div class="clearfix"></div>
	</div>
	<div class="panel-body">
		 {!! Form::open(array('route' => 'devices.store','method'=>'POST','class'=>'form-horizontal','id'=>'FormSubmit')) !!}
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
		      <label for="name" class="col-sm-2 control-label">Model</label>
		      <div class="col-sm-10">
		        {!! Form::select('model_id', $model->pluck('name','id'), null, ['id'=>'unit','class'=>'form-control','required'=>true]) !!}
		        @if ($errors->has('model_id'))
	            <span class="help-block">
	                <strong class="text-danger">{{ $errors->first('model_id') }}</strong>
	            </span>
	            @endif
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="name" class="col-sm-2 control-label">Color</label>
		      <div class="col-sm-10">
		        {!! Form::select('color_id', $colors->pluck('name','id'), null, ['id'=>'unit','class'=>'form-control','required'=>true]) !!}
		        @if ($errors->has('color_id'))
	            <span class="help-block">
	                <strong class="text-danger">{{ $errors->first('color_id') }}</strong>
	            </span>
	            @endif
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="name" class="col-sm-2 control-label">Size</label>
		      <div class="col-sm-10">
		        {!! Form::select('size_id', $sizes->pluck('value','id'), null, ['id'=>'unit','class'=>'form-control','required'=>true]) !!}
		        @if ($errors->has('size_id'))
	            <span class="help-block">
	                <strong class="text-danger">{{ $errors->first('size_id') }}</strong>
	            </span>
	            @endif
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="name" class="col-sm-2 control-label">Carrier</label>
		      <div class="col-sm-10">
		        {!! Form::select('carrier_id', $carriers->pluck('name','id'), null, ['id'=>'unit','class'=>'form-control','required'=>true]) !!}
		        @if ($errors->has('carrier_id'))
	            <span class="help-block">
	                <strong class="text-danger">{{ $errors->first('carrier_id') }}</strong>
	            </span>
	            @endif
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="price" class="col-sm-2 control-label">Price</label>
		      <div class="col-sm-10">
		        {!! Form::number('price', 0, array('class' => 'form-control','required'=>true)) !!}
		        @if ($errors->has('price'))
	            <span class="help-block">
	                <strong class="text-danger">{{ $errors->first('price') }}</strong>
	            </span>
	            @endif
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="firstname" class="col-sm-2 control-label">Conditions</label>
		      <div class="col-sm-10">
		      	  @foreach($conditions as $c)
		           <label class="checkbox-inline">
				      <input type="checkbox" name="conditions[]" value="{{ $c->id }}"> {{ $c->name }}
				   </label>
				   @endforeach
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