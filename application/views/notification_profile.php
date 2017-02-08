<?php

include('header.php');
$userid = $this->session->userdata('id');
$service_id =  $this->uri->segment(3);

if($service_id != ''){

    $app_query = $this->db->query("SELECT * FROM device_token_check WHERE id = '$service_id'");
    $app_result = $app_query->row_array();
}
?>
<!--main content start-->
<section id="main-content">

    <form role="form" method="post" action="<?php echo base_url().'index.php/notification/add_update/';  ?>" enctype="multipart/form-data" name="service_form">

        <input type="hidden" name="app_id" id="app_id" value="<?php echo $app_result['id']; ?>">
        <input type="hidden" name="service_img" id="service_img" value="<?php echo $app_result['image']; ?>">

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
                    <header class="panel-heading"> Service </header>

                    <p class="sub_title">Please fill the information to continue</p>

                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <div class="customer">
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="message" class="form-control" id="message" placeholder="Description"><?php echo $app_result['description']; ?></textarea>
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

        <a href="<?php echo base_url().'index.php/notification/index'; ?>" data-toggle='modal' class="btn btn-success btn-s-xs" name="cancel">Cancel</a>

    </footer>
    </form>
</section>
<!--main content end-->

<?php include('footer.php'); ?>