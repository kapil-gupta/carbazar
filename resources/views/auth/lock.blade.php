<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8"/>
        <title>SmartCarBaza - Login</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta content="" name="description"/>
        <meta content="" name="author"/>
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
        <link href="/admin/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="/admin/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
        <link href="/admin/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="/admin/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="/admin/pages/css/lock2.css" rel="stylesheet" type="text/css"/>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME STYLES -->
        <link href="/admin/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css"/>
        <link href="/admin/global/css/plugins.css" rel="stylesheet" type="text/css"/>
        <link href="/admin/layout3/css/layout.css" rel="stylesheet" type="text/css"/>
        <link href="/admin/layout3/css/custom.css" rel="stylesheet" type="text/css"/>
        <!-- END THEME STYLES -->
        <link rel="shortcut icon" href="favicon.ico"/>
    </head>
    <!-- END HEAD -->
    <!-- BEGIN BODY -->
    <body>
        <div class="page-lock">
            <div class="page-logo">
                <a class="brand" href="index.html">
                    <img src="/admin/layout3/img/logo-big.png" alt="logo"/>
                </a>
            </div>
            <div class="page-body">
                @if($errors->has('password'))
                <div class="alert alert-danger">
                    <button class="close" data-close="alert"></button>
                    <span>
                        <strong>Error(s):</strong>
                        <?php
                        if ($errors->has('password')) {
                            echo $errors->first('password');
                        }
                        ?>
                    </span>
                </div>
                @else
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span>Enter password. </span>
                </div>
                @endif
                <img class="page-lock-img" src="/admin/pages/media/profile/profile.jpg" alt="">
                <div class="page-lock-info">
                    <h1>{{Auth::user()->first_name . " " . Auth::user()->last_name}}</h1>
                    <span class="email">{{Auth::user()->username}} </span>
                    <span class="locked"> Locked </span>
                    <form class="form-inline"method="post" action="{{url('/auth/lock')}}">

                        {!! csrf_field() !!}
                        <div class="input-group input-medium">
                            <input type="password" class="form-control" name='password' placeholder="Password">
                            <span class="input-group-btn">
                                <button type="submit" class="btn blue icn-only"><i class="m-icon-swapright m-icon-white"></i></button>
                            </span>
                        </div>
                        <!-- /input-group -->
                        <div class="relogin">
                            <a href="{{url('/logout')}}">
                                Not {{Auth::user()->first_name . " " . Auth::user()->last_name}}  ? </a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="page-footer-custom">
               {!! date('Y')!!} &copy; SmartCarBazar. All Rights Reserved.
            </div>
        </div>
        <!-- END COPYRIGHT -->
        <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
        <!-- BEGIN CORE PLUGINS -->
        <!--[if lt IE 9]>
        <script src="/admin/global/plugins/respond.min.js"></script>
        <script src="/admin/global/plugins/excanvas.min.js"></script> 
        <![endif]-->
        <script src="/admin/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="/admin/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
        <script src="/admin/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="/admin/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="/admin/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="/admin/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="/admin/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="/admin/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="/admin/global/plugins/select2/select2.min.js"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="/admin/global/scripts/metronic.js" type="text/javascript"></script>
        <script src="/admin/layout3/scripts/layout.js" type="text/javascript"></script>
        <script src="/admin/layout3/scripts/demo.js" type="text/javascript"></script>

        <!-- END PAGE LEVEL SCRIPTS -->
        <script>
jQuery(document).ready(function () {
    Metronic.init(); // init metronic core components
    Layout.init(); // init current layout
    //Login.init();
    Demo.init();
    // init background slide images
    $.backstretch([
        "/admin/pages/media/bg/1.jpg",
        "/admin/pages/media/bg/2.jpg",
        "/admin/pages/media/bg/3.jpg",
        "/admin/pages/media/bg/4.jpg"
    ], {
        fade: 1000,
        duration: 8000
    }
    );
});
        </script>
        <!-- END JAVASCRIPTS -->
    </body>
    <!-- END BODY -->
</html>