<div class="form-group">
  <label for="name" class="col-sm-2 control-label">Permissions</label>
  <div class="col-sm-10">
	<div class="row">
		<div class="col-md-12">
			@foreach($permissions as $perm)
			 @php $per_found = null;  if( isset($data) ) {  $per_found = $data->hasPermissionTo($perm->name); } @endphp
			 <div class="col-md-3">
                <div class="checkbox checkbox-primary">
                    <input type="checkbox">
                    {!! Form::checkbox("permissions[]", $perm->name, $per_found, isset($options) ? $options : []) !!} 
                    <label class="{{ str_contains($perm->name, 'delete') ? 'text-danger' : '' }}">
                    	{{ $perm->name }}
                    </label>
                </div>
             </div>
			 @endforeach
		</div>
    @if ($errors->has('permissions'))
    <p></p>
    <span class="help-block">
        <strong class="text-danger">{{ $errors->first('permissions') }}</strong>
    </span>
    @endif
	</div>
  </div>
</div>