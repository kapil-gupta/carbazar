<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="container">
        {!! date('Y')!!} &copy; SmartCarBazar. All Rights Reserved.
    </div>
</div>
<div class="scroll-to-top">
    <i class="icon-arrow-up"></i>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS (Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
{!! Html::script('admin/global/plugins/jquery.min.js') !!}
{!! Html::script('admin/global/plugins/jquery-migrate.min.js') !!}
{!! Html::script('admin/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js') !!}
{!! Html::script('admin/global/plugins/bootstrap/js/bootstrap.min.js') !!}
{!! Html::script('admin/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') !!}
{!! Html::script('admin/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') !!}
{!! Html::script('admin/global/plugins/jquery.blockui.min.js') !!}
{!! Html::script('admin/global/plugins/jquery.cokie.min.js') !!}
{!! Html::script('admin/global/plugins/uniform/jquery.uniform.min.js') !!}
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
{!! Html::script('admin/global/scripts/metronic.js') !!}
{!! Html::script('admin/layout3/scripts/layout.js') !!}
<!-- END PAGE LEVEL SCRIPTS -->
<!-- END :: Core Plugins -->
<!-- START :: Page Level Plugins -->
@yield('pageFooterSpecificPlugin')
<!-- END :: Page Level Plugins -->
<!-- START :: Page Level Scripts -->
@yield('pageFooterSpecificJS')
<!-- END :: Page Level Scripts --> 
@yield('pageFooterScriptInitialize')
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>