<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Sistem Informasi Telehealth Orthodontist</title>
    <!-- core CSS -->
    <link href="<?php echo base_url(); ?>asset/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/css/animate.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/css/owl.carousel.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/css/owl.transitions.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/css/prettyPhoto.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/css/main.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/css/responsive.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>asset/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/jquery.gritter.css" />
     
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">-->
</head><!--/head-->

<body id="home" class="homepage">

    <header id="header">
        <nav id="main-menu" class="navbar navbar-default navbar-fixed-top" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="homepage"><img src="<?php echo base_url(); ?>asset/images/logo.png" alt="logo" width="104" height="57"></a>
                </div>
                
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="<?php echo $home ?>">
                            <a href="<?php echo base_url(); ?>index.php/admin">Home</a>
                        </li>
                        <li class="dropdown <?php echo $manage ?>">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Manage Doctor<strong class="caret"></strong></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/admin/register">Create Orthodontist Center</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/admin/retrieve">Retrieve All Doctor</a>
                                </li>
                            </ul>
                        </li>
                        <li class="<?php echo $jadwal ?>">
                            <a href="<?php echo base_url(); ?>index.php/admin/jadwal">Daily Schedule</a>
                        </li>
                        <li class="dropdown <?php echo $inbox ?>">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Inbox<strong class="caret"></strong></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/admin/diagnosa">Diagnose</a>
                                </li>                           
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/admin/verify">Member Verification</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown <?php echo $setting ?>">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings<strong class="caret"></strong></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/admin/edit_profile">Edit Profile</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/admin/change">Change Password</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/admin/logout">Sign Out</a>
                        </li>                        
                    </ul>
                </div>                  
            </div><!--/.container-->
        </nav><!--/nav-->
        <?php if(isset($status)) echo $status; ?>
    </header><!--/header-->