@include('admin/elements/head')
<!-- BEGIN HEADER -->
@include('admin/elements/header')
<!-- END HEADER -->
<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
    <!-- BEGIN PAGE HEAD -->
    @include('admin/elements/pageheader')
    <!-- END PAGE HEAD -->
    <!-- BEGIN PAGE CONTENT -->
    <div class="page-content">
        <div class="container">
            @include('admin/elements/notices')
            <!-- BEGIN PAGE BREADCRUMB -->
            @include('admin/elements/breadcrumb')
            <!-- END PAGE BREADCRUMB -->
            <!-- BEGIN PAGE CONTENT INNER -->
            @yield('bodyContent')
            <!-- END PAGE CONTENT INNER -->
        </div>
    </div>
    <!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->
@include('admin/elements/footer')