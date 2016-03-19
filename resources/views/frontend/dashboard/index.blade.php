@extends('frontend.layouts.onecolom')


@section('pageHeadSpecificCSS')	{{-- Page Head Specific CSS Files --}}
@stop

@section('pageHeadSpecificJS')	{{-- Page Head Specific JS Files --}}
@stop

@section('bodyContent')	{{-- Page Body Content --}}
<!-- START :: Logo -->
 <div class="row">
				<div class="col-md-12">
                                            
                                    <h1>Dashboard</h1>
				</div>
			</div>
@stop

@section('pageFooterSpecificPlugin')	{{-- Page Footer Specific Plugin Files --}}
<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- END PAGE LEVEL PLUGINS -->
@stop

@section('pageFooterSpecificJS')
@stop

@section('pageFooterScriptInitialize')	{{-- Page Footer Script Initialization Code --}}
<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core componets
        Layout.init(); // init layout
    });
</script>
@stop