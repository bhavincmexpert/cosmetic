<?php

include('header.php');
$userid = $this->session->userdata('id');
$app_id =  $this->uri->segment(3);

$query = $this->db->query("SELECT * FROM user WHERE status != '9'");
$result = $query->result();

$service_query = $this->db->query("SELECT * FROM services WHERE status != '9'");
$service_result = $service_query->result();

if($app_id != ''){

    $app_query = $this->db->query("SELECT * FROM appointment WHERE id = '$app_id'");
    $app_result = $app_query->row_array();
}
?>
<!--main content start-->
<section id="main-content">

    <form role="form" method="post" action="<?php echo base_url().'index.php/appointment/add_update/';  ?>" enctype="">

        <input type="hidden" name="app_id" id="app_id" value="<?php echo $app_result['id']; ?>">

        <section class="wrapper site-min-height">
        <!-- page start-->
        <div id="msg">
            <?php if($this->session->flashdata('msg') && $this->session->flashdata('msg') != ''){ ?>
                <div class="alert alert-success fade in">
                    <strong>Success!</strong> <?php echo $this->session->flashdata('msg');; ?>
                </div>
            <?php } unset($this->session->flashdata); ?>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading"> Appointment </header>

                    <p class="sub_title">Please fill the information to continue</p>

                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <div class="customer">
                            <div class="form-group">
                                <label for="">User</label>
                                <select name="username" id="user" class="form-control">
                                    <option value="" selected disabled > Select User </option>
                                    <?php foreach ($result as $usr){ ?>
                                        <option value="<?php echo $usr->id; ?>" <?php if($usr->id == $app_result['user_id']){ ?> selected <?php } ?> ><?php echo $usr->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="">Service</label>
                                <select name="service" id="user" class="form-control">
                                    <option value="" selected disabled > Select Service </option>
                                    <?php foreach ($service_result as $service){ ?>
                                        <option value="<?php echo $service->id; ?>" <?php if($service->id == $app_result['service_id']){ ?> selected <?php } ?> ><?php echo $service->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="<?php echo $app_result['name']; ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <div class="customer padding_dropdown margin_btm">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="<?php echo $app_result['email']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="">Phone Number</label>
                                <input type="text" name="phone_no" class="form-control" id="phone_no" placeholder="Phone number" value="<?php echo $app_result['phone_no']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="">Date Time:</label>
                                <input type="text" name="app_date" class="form-control form_datetime" id="app_date" placeholder="Date" required value="<?php echo $app_result['date']; ?>">
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->
    </section>
    <footer class="panel-footer text-right bg-light lter">
        <input type="submit" name="submit" value="Submit" class="btn btn-success btn-s-xs">
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="mycancel" class="modal fade bs-example-modal-sm">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="fa fa-building-o"></i> Plan Insert Master Alert </h4>
                    </div>
                    <div class="modal-body">
                        <i class="fa fa-question-circle"></i> Are You Sure To Go Back!
                    </div>
                    <div class="modal-footer">
                        <input type='button' value='Yes' class="btn btn-success btn-shadow" onclick=""/>
                        <button data-dismiss="modal" class="btn btn-danger btn-shadow" type="button">No</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Code for Cancle Alert-->

        <a href="<?php echo base_url().'index.php/appointment/index'; ?>" data-toggle='modal' class="btn btn-success btn-s-xs" name="cancel">Cancel</a>

    </footer>
    </form>
</section>
<!--main content end-->

<script src="<?php echo base_url(); ?>public/js/jquery-1.8.3.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap-datetimepicker.js"></script>
<script src="<?php echo base_url(); ?>public/js/advanced-form-components.js"></script>

<?php include('footer.php'); ?>