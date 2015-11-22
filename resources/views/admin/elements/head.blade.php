<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8">
        <title>{{ $page->getHead()->getTitle() }}</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <meta name="keywords" content="{{ $page->getHead()->getKeywords() }}" />
        <meta name="description" content="{{ $page->getHead()->getDescription() }}" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        {!! Html::style('http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all') !!}
        {!! Html::style('admin/global/plugins/font-awesome/css/font-awesome.min.css') !!}
        {!! Html::style('admin/global/plugins/simple-line-icons/simple-line-icons.min.css') !!}
        {!! Html::style('admin/global/plugins/bootstrap/css/bootstrap.min.css') !!}
        {!! Html::style('admin/global/plugins/uniform/css/uniform.default.css') !!}
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
        <!-- END PAGE LEVEL PLUGIN STYLES -->
        <!-- BEGIN PAGE STYLES -->
        @yield('pageHeadSpecificCSS')
        <!-- END PAGE STYLES -->
        <!-- BEGIN THEME STYLES -->
        <!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
        {!! Html::style('admin/global/css/components-rounded.css') !!}
        {!! Html::style('admin/global/css/plugins.css') !!}
        {!! Html::style('admin/layout3/css/layout.css') !!}
        {!! Html::style('admin/layout3/css/themes/default.css') !!}
        {!! Html::style('admin/layout3/css/custom.css') !!}

        @yield('pageHeadSpecificJS')

        <!-- END THEME STYLES -->
        <link rel="shortcut icon" href="favicon.ico">
    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <!-- DOC: Apply "page-header-menu-fixed" class to set the mega menu fixed  -->
    <!-- DOC: Apply "page-header-top-fixed" class to set the top menu fixed  -->
    <body>