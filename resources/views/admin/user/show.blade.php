@extends('layouts.admin-base')
@section('title') Show User @endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Roles</h1>
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
		         	<strong>:&nbsp{{ $user->name }}</strong>
		         </label>
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="name" class="col-sm-2 control-label">Phone</label>
		      <div class="col-sm-10">
		         <label class="control-label">
		         	<strong>:&nbsp{{ $user->phone }}</strong>
		         </label>
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="username" class="col-sm-2 control-label">Username</label>
		      <div class="col-sm-10">
		         <label class="control-label">
		         	<strong>:&nbsp{{ $user->username }}</strong>
		         </label>
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="email" class="col-sm-2 control-label">Email</label>
		      <div class="col-sm-10">
		         <label class="control-label">
		         	<strong>:&nbsp{{ $user->email }}</strong>
		         </label>
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="roles" class="col-sm-2 control-label">Roles</label>
		      <div class="col-sm-10">
		         <ul>
                    @foreach($user->roles as $row)
                        <li>{{ $row->name }}</li>
                    @endforeach
                </ul>
		      </div>
		   </div>
		</form>
	</div>
</div>
@endsection