@extends('layouts.admin-base')
@section('title') List Invoice @endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Invoice</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="col-md-6">
			<a href="{{ route('invoices.index') }}" class="btn btn-default">
				Refresh
			</a>
		</div>
		<div class="col-md-6">
			<form action="{{ route('invoices.index') }}">
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
						<th>Invoice Number</th>
						<th>Device</th>
						<th>Customer</th>
						<th>Status</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					@if(count($result)==0)
					<tr>
						<td colspan="7" class="text-center">No Data</td>
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
								<td>
									@php 
										echo $row->confirmed ? $row->invoice_number : "<label class='label label-danger'>No Followed</label>";  
									@endphp
								</td>
								<td>{{ $row->device->name }}</td>
								<td>{{ $row->customer->name }}</td>
								<td>
									@php 
										echo $row->confirmed ? "<label class='label label-success'>Followed</label>" : 
										"<label class='label label-danger'>No Followed</label>";  
									@endphp
								</td>
								<td class="text-center">
									{!! Form::open(array(
				                            'method' => 'DELETE',
				                            'route' => ['invoices.destroy', $row->id],
				                            'onsubmit' => "return confirm('Are you sure you want to delete?')",
				                        )) 
				                    !!}
				                    <a class="btn btn-default btn-sm" href="{{ route('invoices.edit',['id'=>$row->id]) }}">
										Edit
									</a>
									<a class="btn btn-default btn-sm" href="{{ route('invoices.show',['id'=>$row->id]) }}">
										Show
									</a>
									@if(!$row->confirmed)
									<a class="btn btn-default btn-sm" onclick="return confirm('Are you sure ?')" href="{{ route('invoices.followed',['id'=>$row->id]) }}">
										Follow Up
									</a>
									@endif
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