@extends('layouts.admin-base')
@section('title') List Part @endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Part</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="col-md-6">
			<a href="{{ route('parts.create') }}" class="btn btn-default">
				Create New
			</a>
			<a href="{{ route('parts.index') }}" class="btn btn-default">
				Refresh
			</a>
		</div>
		<div class="col-md-6">
			<form action="{{ route('parts.index') }}">
				<div class="input-group">
	               <input type="text" class="form-control" name="search"  value="{{ \Input::get('search') }}"  required/>
	               <span class="input-group-btn">
	                  <button class="btn btn-default" type="submit">
	                    Search
	                  </button>
	               </span>
	            </div>
			</form>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="panel-body">
		@include('layouts.alert')
		<div class="table-responsive">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Created At</th>
						<th>Name</th>
						<th>Price</th>
						<th>Stock</th>
						<th>Device</th>
						<th>Description</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					@if(count($result)==0)
					<tr>
						<td colspan="8" class="text-center">No Data</td>
					</tr>
					@else
						@php   
							$page = \Input::get('page') ? \Input::get('page') : 1;
							$num = ($page * 10) - 9;
						@endphp
						@foreach($result as $row)
							<tr>
								<td>{{ $num++ }}</td>
								<td>{{ $row->created_at }}</td>
								<td>{{ $row->name }}</td>
								<td>{{ $row->price }}</td>
								<td>{{ $row->stock }}</td>
								<td>
									{{ $row->device->name }} - {{ $row->device->color->name }} - {{ $row->device->carrier->name }}  - {{ $row->device->size->value }}{{ $row->device->size->unit }}
								</td>
								<td>{{ $row->description }}</td>
								<td class="text-center">
				                    {!! Form::open(array(
				                            'method' => 'DELETE',
				                            'route' => ['parts.destroy', $row->id],
				                            'onsubmit' => "return confirm('Are you sure you want to delete?')",
				                        )) 
				                    !!}
				                    <a class="btn btn-default btn-sm" href="{{ route('parts.edit',['id'=>$row->id]) }}">
										Edit
									</a>
									<a class="btn btn-default btn-sm" href="{{ route('parts.show',['id'=>$row->id]) }}">
										Show
									</a>
				                    {!! Form::submit('Delete',["class"=>"btn btn-default btn-sm"]) !!}
				                    {!! Form::close() !!}
								</td>
							</tr>
						@endforeach
					@endif
				</tbody>
			</table>
			{{ $result->links() }}
		</div>
	</div>
</div>
@endsection