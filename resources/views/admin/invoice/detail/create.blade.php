@extends('layouts.admin-base')
@section('title') Add Part @endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Add Part</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="col-md-6">
			<a href="{{ route('invoices.edit',["id"=>$invoice_id]) }}" class="btn btn-default">
				Back to List
			</a>
		</div>
		<div class="col-md-6"></div>
		<div class="clearfix"></div>
	</div>
	<div class="panel-body">
		 {!! Form::open(array(
		 	'route' => ['invoice.detail.store','id'=>$invoice_id],
		 	'method'=>'POST',
		 	'class'=>'form-horizontal',
		 	'id'=>'FormSubmit')) 
		 !!}
		   <div class="form-group">
		      <label for="part_id" class="col-sm-2 control-label">Part</label>
		      <div class="col-sm-10">
		       {!! Form::select('part_id', $parts->pluck('name','id'), null, ['id'=>'unit','class'=>'form-control','required'=>true]) !!}
		        @if ($errors->has('part_id'))
	            <span class="help-block">
	                <strong class="text-danger">{{ $errors->first('part_id') }}</strong>
	            </span>
	            @endif
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="qty" class="col-sm-2 control-label">Qty</label>
		      <div class="col-sm-10">
		        {!! Form::number('qty', null, array('class' => 'form-control','required'=>false)) !!}
		        @if ($errors->has('qty'))
	            <span class="help-block">
	                <strong class="text-danger">{{ $errors->first('qty') }}</strong>
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