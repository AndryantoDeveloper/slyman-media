@extends('layouts.admin-base')
@section('title') Create User @endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">User</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="col-md-6">
			<a href="{{ route('users.index') }}" class="btn btn-default">
				Back to List
			</a>
		</div>
		<div class="col-md-6"></div>
		<div class="clearfix"></div>
	</div>
	<div class="panel-body">
		 {!! Form::model($data, ['method' => 'PATCH','class'=>'form form-horizontal','id'=>'FormSubmit','route' => ['users.update', $data->id]]) !!}
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
		      <label for="phone" class="col-sm-2 control-label">Phone</label>
		      <div class="col-sm-10">
		        {!! Form::text('phone', null, array('class' => 'form-control','required'=>true)) !!}
		        @if ($errors->has('phone'))
	            <span class="help-block">
	                <strong class="text-danger">{{ $errors->first('phone') }}</strong>
	            </span>
	            @endif
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="username" class="col-sm-2 control-label">Username</label>
		      <div class="col-sm-10">
		        {!! Form::text('username', null, array('class' => 'form-control','required'=>true)) !!}
		        @if ($errors->has('username'))
	            <span class="help-block">
	                <strong class="text-danger">{{ $errors->first('username') }}</strong>
	            </span>
	            @endif
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="email" class="col-sm-2 control-label">Email</label>
		      <div class="col-sm-10">
		        {!! Form::email('email', null, array('class' => 'form-control','required'=>true)) !!}
		        @if ($errors->has('email'))
	            <span class="help-block">
	                <strong class="text-danger">{{ $errors->first('email') }}</strong>
	            </span>
	            @endif
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="password" class="col-sm-2 control-label">Password</label>
		      <div class="col-sm-10">
		        <input type="password" name="password" id="password" class="form-control" value="{{ old('old_password') }}" />
		        @if ($errors->has('password'))
	            <span class="help-block">
	                <strong class="text-danger">{{ $errors->first('password') }}</strong>
	            </span>
	            @endif
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="roles" class="col-sm-2 control-label">Roles</label>
		      <div class="col-sm-10">
		      	@foreach($roles as $r)
		         <div class="checkbox checkbox-inline">
		         	@php
                        $selectedRoles = $data->roles->pluck("id")->toArray();
                        $status = in_array($r->id,$selectedRoles) ? true : false;
                    @endphp
                    {{ Form::checkbox('roles[]', $r->id, $status) }} {{ $r->name }}
                 </div>
                @endforeach
		        @if ($errors->has('roles'))
	            <span class="help-block">
	                <strong class="text-danger">{{ $errors->first('roles') }}</strong>
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