<!DOCTYPE html>
<!--[if lte IE 8]>
<html class="ie8 no-js" lang="en">
<![endif]-->
<!--[if IE 9]>
<html class="ie9 no-js" lang="en">
<![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="not-ie no-js" lang="en">
<!--<![endif]-->
    <head>
        <link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz|Open+Sans:400,600,700|Oswald|Electrolize' rel='stylesheet' type='text/css'>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <title>Car Dealer | Home</title>

        <meta name="description" content="">
        <meta name="author" content="">

        <link rel="shortcut" href="images/favicon.html" />
        {!! Html::style(static_files_route('css/style.css')) !!}
        {!! Html::style(static_files_route('css/skeleton.css')) !!}
        {!! Html::style(static_files_route('sliders/flexslider/flexslider.css')) !!}
        {!! Html::style(static_files_route('fancybox/jquery.fancybox.css')) !!}
        <!-- HTML5 Shiv + detect touch events -->
        @yield('pageHeadSpecificCSS')
        {!! Html::script(static_files_route('js/modernizr.custom.js')) !!}
        @yield('pageHeadSpecificJS')
    </head>
    <body class="menu-1 h-style-1 text-1">