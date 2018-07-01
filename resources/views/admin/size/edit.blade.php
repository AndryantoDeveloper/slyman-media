@extends('layouts.admin-base')
@section('title') Create Size @endsection
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
		<div class="col-md-6"></div>
		<div class="clearfix"></div>
	</div>
	<div class="panel-body">
		  {!! Form::model($data, ['method' => 'PATCH','class'=>'form form-horizontal','id'=>'FormSubmit','route' => ['sizes.update', $data->id]]) !!}
		   <div class="form-group">
		      <label for="value" class="col-sm-2 control-label">Value</label>
		      <div class="col-sm-10">
		        {!! Form::number('value', null, array('class' => 'form-control','required'=>true)) !!}
		        @if ($errors->has('value'))
	            <span class="help-block">
	                <strong class="text-danger">{{ $errors->first('value') }}</strong>
	            </span>
	            @endif
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="description" class="col-sm-2 control-label">Unit</label>
		      <div class="col-sm-10">
		        {!! Form::select('unit', $units, null, ['id'=>'unit','class'=>'form-control']) !!}
		        @if ($errors->has('unit'))
	            <span class="help-block">
	                <strong class="text-danger">{{ $errors->first('unit') }}</strong>
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