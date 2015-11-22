@if($errors->has('error') || Session::has('success') || Session::has('warning') || Session::has('info'))
<div class="portlet-body">
	@if(Session::has('warning'))
	<div class="alert alert-warning" style='margin-top: 10px;'>
	   <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
	   <strong>Warning!</strong> {{Session::get('warning')}}
	</div>
	@elseif(Session::has('success'))
	<div class="alert alert-success alert-dismissable" style='margin-top: 10px;'>
	   <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
	   <strong>Success!</strong> {{Session::get('success')}}
	</div>
	@elseif(Session::has('info'))
	<div class="alert alert-info alert-dismissable" style='margin-top: 10px;'>
	  <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
	   <strong>Info!</strong> {{Session::get('info')}}
	</div>
	@elseif($errors->has('error'))
	<div class="alert alert-danger alert-dismissable" style='margin-top: 10px;'>
	   <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
		<span>
			<strong>Error(s):</strong>
			{{ implode("<br>",$errors->get('error')) }}
		</span>
	</div>	
	@endif
</div>
@endif


