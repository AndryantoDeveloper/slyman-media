@extends('layouts.admin-base')
@section('title') Show Role @endsection
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
			<a href="{{ route('roles.index') }}" class="btn btn-default">
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
		      <label for="firstname" class="col-sm-2 control-label">Name</label>
		      <div class="col-sm-10">
		         <label class="control-label">
		         	<strong>:&nbsp{{ $data->name }}</strong>
		         </label>
		      </div>
		   </div>
		    @include('admin.role.permission',[
                "data"=>$data,
                "options"=>["disabled"]
            ])
		</form>
	</div>
</div>
@endsection