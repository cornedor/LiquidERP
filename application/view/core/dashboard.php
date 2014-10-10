<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Liquid - Dashboard</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" type="text/css" href="<?php echo $this->templatedir; ?>/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $this->templatedir; ?>/style/dashboard.css">
    </head>
    <body>
        <header>
            <nav class="navbar navbar-fixed-top" role="navigation">
                <div class="branding-logo">
                    Branding logo here
                </div>

                <ul class="nav navbar-nav pull-right">
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:;">
                            <i class="glyphicon glyphicon-envelope"></i>
                        </a>
                        <ul class="dropdown-menu pull-right-xs">
                            <li><a href="#">Logout</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:;">
                            <i class="glyphicon glyphicon-globe"></i>
                            <!--<span class="badge badge-up badge-danger badge-small">34</span>-->
                        </a>
                        <ul class="dropdown-menu pull-right-xs">
                            <li><a href="#">Logout</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:;">
                            <!--<img class="img-circle" src="http://gravatar.com/avatar/e7b275f72475aa7a16d0036935fac094?s=128">-->
                            <span class="hidden-xs">Kevin van der Burgt</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu pull-right-xs">
                            <li><a href="/logout">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>

        <div class="page-wrapper">
            <aside class="sidebar sidebar-default">
                Hello!
            </aside>
        </div>

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo $this->templatedir; ?>/bootstrap/js/bootstrap.min.js"></script>

        <!--
        <div class="page-wrapper">
            <aside class="sidebar sidebar-default">
                asd
            </aside>
            <div class="page-content">
                <div class="subheader">
                    <ol class="breadcrumb">
                        <li class="active"><a href="javascript:;">Dashboard</a></li>
                        <li class="active"><a href="javascript:;">Sub page</a></li>
                        <li class="active"><a href="javascript:;">Sub sub page</a></li>
                    </ol>
                </div>

                <div class="container-fluid">
                    Test
                </div>
            </div>
        </div>
        -->
    </body>
</html>
