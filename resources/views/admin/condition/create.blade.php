@extends('layouts.admin-base')
@section('title') Create Condition @endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Condition</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="col-md-6">
			<a href="{{ route('conditions.index') }}" class="btn btn-default">
				Back to List
			</a>
		</div>
		<div class="col-md-6"></div>
		<div class="clearfix"></div>
	</div>
	<div class="panel-body">
		 {!! Form::open(array('route' => 'conditions.store','method'=>'POST','class'=>'form-horizontal','id'=>'FormSubmit')) !!}
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
		      <label for="link" class="col-sm-2 control-label">Deep Link</label>
		      <div class="col-sm-10">
		        {!! Form::text('link', null, array('class' => 'form-control','required'=>true)) !!}
		        @if ($errors->has('link'))
	            <span class="help-block">
	                <strong class="text-danger">{{ $errors->first('link') }}</strong>
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