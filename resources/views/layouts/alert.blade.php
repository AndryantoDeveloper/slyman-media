@if ($message = Session::get('message'))
<div class="alert alert-success alert-dismissable" id="alert-nofif-success">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <i class="fa fa-check"></i>&nbsp{{ $message }}
</div>
@endif