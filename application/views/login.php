<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content=">
<link rel=" shortcut icon
    " href="img/favicon.png">

    <title>Login</title>
    <link href="<?php echo base_url(); ?>/public/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/public/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="<?php echo base_url(); ?>/public/assets/font-awesome/css/font-awesome.css" rel="stylesheet"/>
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>/public/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/public/css/style-responsive.css" rel="stylesheet"/>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="login-body" style="background: url('<?php echo base_url()."public/images/back_img.png"; ?>')">
<div class="container">

    <div id="registered">
        <?php if ($this->session->flashdata('registered') && $this->session->flashdata('registered') != '') { ?>
            <div class="alert alert-success" style="text-align: center">
                <?php echo $this->session->flashdata('registered');; ?>
            </div>
        <?php }
        unset($this->session->flashdata); ?>
    </div>

    <form class="form-signin" enctype="multipart/form-data"
          action="<?php echo base_url() . 'index.php/home/check_login/'; ?>" method="post">
        <h2 class="form-signin-heading">Cosmetic</h2>
        <div id="msg">
            <?php if ($this->session->flashdata('msg') && $this->session->flashdata('msg') != '') { ?>
                <div class="alert alert-danger" style="text-align: center">
                    <?php echo $this->session->flashdata('msg');; ?>
                </div>
            <?php }
            unset($this->session->flashdata); ?>
        </div>
        <div class="login-wrap">
            <input type="text" name="email" class="form-control" placeholder="Email Address" required="" autofocus>
            <input type="password" name="password" class="form-control" placeholder="Password" required="">
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
<span class="pull-right">
<a data-toggle="modal" href="#myModal"> Forgot Password?</a>
</span>
            </label>
            <button class="btn btn-lg btn-login btn-block" type="submit">Login</button>

        </div>
    </form>
</div>


<!-- js placed at the end of the document so the pages load faster -->
<script src="<?php echo base_url(); ?>/public/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>/public/js/bootstrap.min.js"></script>

</body>

<script type="text/javascript"> setTimeout(function () {
        $('#registered').hide();
    }, 6000); </script>

</html>
