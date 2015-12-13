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
        <link href="/admin/global/plugins/select2/select2.css" rel="stylesheet" type="text/css"/>
        <link href="/admin/pages/css/login-soft.css" rel="stylesheet" type="text/css"/>
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
    <body class="login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="index.html">
                <img src="/admin/layout3/img/logo-big.png" alt=""/>
            </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
        <div class="menu-toggler sidebar-toggler">
        </div>
        <!-- END SIDEBAR TOGGLER BUTTON -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <?php 
            print_r($errors);
            ?>
            <!-- BEGIN LOGIN FORM -->
            <form class="login-form" action="/auth/login" method="post">
                {!! csrf_field() !!}
                <h3 class="form-title">Login to your account</h3>
                @if($errors->has('email') || $errors->has('password'))
                <div class="alert alert-danger">
                    <button class="close" data-close="alert"></button>
                    <span>
                        <strong>Error(s):</strong>
                        <?php
                        if ($errors->has('email') && $errors->has('password')) {
                            echo $errors->first('email') . '<br>' .
                                    $errors->first('password');
                        }else if ($errors->has('email') && !$errors->has('password')) {
                            echo $errors->first('email');
                        }if (!$errors->has('email') && $errors->has('password')) {
                            echo $errors->first('password');
                        }
                        ?>
                    </span>
                </div>
                @else
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span>Enter any username and password. </span>
                </div>
                @endif
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Username</label>
                    <div class="input-icon">
                        <i class="fa fa-user"></i>
                        <input class="form-control placeholder-no-fix" type="email"  placeholder="Email" name="email" value="{{ old('email') }}"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <div class="input-icon">
                        <i class="fa fa-lock"></i>
                        <input class="form-control placeholder-no-fix" type="password" placeholder="Password" name="password"/>
                    </div>
                </div>
                <div class="form-actions">
                    <label class="checkbox">
                        <input type="checkbox" name="remember" value="1"/> Remember me </label>
                    <button type="submit" class="btn blue pull-right">
                        Login <i class="m-icon-swapright m-icon-white"></i>
                    </button>
                </div>
                <!-- <div class="login-options">
                        <h4>Or login with</h4>
                        <ul class="social-icons">
                                <li>
                                        <a class="facebook" data-original-title="facebook" href="#">
                                        </a>
                                </li>
                                <li>
                                        <a class="twitter" data-original-title="Twitter" href="#">
                                        </a>
                                </li>
                                <li>
                                        <a class="googleplus" data-original-title="Goole Plus" href="#">
                                        </a>
                                </li>
                                <li>
                                        <a class="linkedin" data-original-title="Linkedin" href="#">
                                        </a>
                                </li>
                        </ul>
                </div>-->
                <div class="forget-password">
                    <h4>Forgot your password ?</h4>
                    <p>
                        no worries, click <a href="/password/email" id="forget-password">
                            here </a>
                        to reset your password.
                    </p>
                </div>
                <!--<div class="create-account">
                        <p>
                                 Don't have an account yet ?&nbsp; <a href="javascript:;" id="register-btn">
                                Create an account </a>
                        </p>
                </div>-->
            </form>
            <!-- END LOGIN FORM -->

        </div>
        <!-- END LOGIN -->
        <!-- BEGIN COPYRIGHT -->
        <div class="copyright">
            2014 &copy; Metronic - Admin Dashboard Template.
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
        <script src="/admin/pages/scripts/login-soft.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <script>
jQuery(document).ready(function () {
    Metronic.init(); // init metronic core components
    Layout.init(); // init current layout
    Login.init();
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