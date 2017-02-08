<?php if ($this->session->userdata('email') == FALSE) { redirect('home/login'); } ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Cosmetic | Admin</title>

    <link href="<?php echo base_url(); ?>public/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/css/bootstrap-reset.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>public/css/multi-select.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/css/fileinput.css" rel="stylesheet">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" />

    <link href="<?php echo base_url(); ?>public/css/demo_page.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>public/css/demo_table.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>public/css/DT_bootstrap.css" rel="stylesheet" />

    <link href="<?php echo base_url(); ?>public/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/public/css/owl.carousel.css" type="text/css">

    <link href="<?php echo base_url(); ?>public/css/datetimepicker.css">

    <link href="<?php echo base_url(); ?>public/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/css/style-responsive.css" rel="stylesheet" />
</head>
<body>
<section id="container">
    <!--header start-->
    <header class="header white-bg border_top">
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
        </div>
        <!--logo start-->
        <a href="" class="logo">COSME<span>TIC</span></a>
        <!--logo end-->
        <div class="top-nav ">
            <!--search & user info start-->
            <ul class="nav pull-right top-menu">
                <li>
                    <input type="text" class="form-control search" placeholder="Search">
                </li>
                <!-- user login dropdown start-->
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <!-- <img alt="" src="img/avatar1_small.jpg"> -->
                        <span class="username"><?php echo $this->session->userdata('name'); ?></span>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu extended logout">
                        <div class="log-arrow-up"></div>
                        <li><a href="<?php echo base_url().'index.php/admin/index'; ?>"><i class=" fa fa-suitcase"></i>Profile</a></li>
                        <li><a href="<?php echo base_url().'index.php/appointment/index'; ?>"><i class="fa fa-calendar"></i> Appointment</a></li>
                        <li><a href="<?php echo base_url().'index.php/notification/index'; ?>"><i class="fa fa-comments"></i> Notification</a></li>
                        <li><a href="<?php echo base_url() . 'index.php/Home/logout/'; ?>"><i class="fa fa-key"></i> LogOut</a></li>
                    </ul>
                </li>
                <!-- user login dropdown end -->
            </ul>
            <!--search & user info end-->
        </div>
    </header>
    <!--header end-->
    <!--sidebar start-->
    <aside>
        <div id="sidebar" class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="<?php if($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'index'){ ?> active <?php } ?>" href="<?php echo base_url() . 'index.php/home/index/'; ?>">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a class="<?php if($this->uri->segment(1) == 'appointment' && $this->uri->segment(2) == 'index'){ ?> active <?php } ?>" href="<?php echo base_url() . 'index.php/appointment/index/'; ?>">
                        <i class="fa fa-calendar"></i>
                        <span>Appointment</span>
                    </a>
                </li>
                <li>
                    <a class="<?php if($this->uri->segment(1) == 'service' && $this->uri->segment(2) == 'index'){ ?> active <?php } ?>" href="<?php echo base_url() . 'index.php/service/index/'; ?>">
                        <i class="fa fa-cog"></i>
                        <span>Service</span>
                    </a>
                </li>
                <li>
                    <a class="<?php if($this->uri->segment(1) == 'news' && $this->uri->segment(2) == 'index'){ ?> active <?php } ?>" href="<?php echo base_url() . 'index.php/news/index/'; ?>">
                        <i class="fa fa-newspaper-o"></i>
                        <span>News</span>
                    </a>
                </li>
                <li>
                    <a class="<?php if($this->uri->segment(1) == 'promo' && $this->uri->segment(2) == 'index'){ ?> active <?php } ?>" href="<?php echo base_url() . 'index.php/promo/index/'; ?>">
                        <i class="fa fa-credit-card"></i>
                        <span>Promo</span>
                    </a>
                </li>
                <li>
                    <a class="<?php if($this->uri->segment(1) == 'academy' && $this->uri->segment(2) == 'index'){ ?> active <?php } ?>" href="<?php echo base_url() . 'index.php/academy/index/'; ?>">
                        <i class="fa fa-universal-access"></i>
                        <span>Academy</span>
                    </a>
                </li>
                <li>
                    <a class="<?php if($this->uri->segment(1) == 'notification' && $this->uri->segment(2) == 'index'){ ?> active <?php } ?>" href="<?php echo base_url() . 'index.php/notification/index/'; ?>">
                        <i class="fa fa-comments"></i>
                        <span>Notification</span>
                    </a>
                </li>
                <li>
                    <a class="<?php if($this->uri->segment(1) == 'haircut_nail' && $this->uri->segment(2) == 'index'){ ?> active <?php } ?>" href="<?php echo base_url() . 'index.php/haircut_nail/index/'; ?>">
                        <i class="fa fa-scissors"></i>
                        <span>Haircut & Nail</span>
                    </a>
                </li>
            </ul>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->


