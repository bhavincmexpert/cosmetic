<?php
include('header.php');
session_start();

$product_id = $this->uri->segment(3);
$user_id = $this->session->userdata('id');

$query = $this->db->query("SELECT * FROM image WHERE haircutnail_id = '$product_id' AND status != '9' ORDER BY id DESC");
$row = $query->result();

?>
<section id="main-content">

    <form role="form" method="post" action="<?php echo base_url() . 'index.php/haircut_nail/update_product_image'; ?>" enctype="multipart/form-data">

        <input type="hidden" name="product_id" id="product_id" value="<?php echo $product_id; ?>">
        <section class="wrapper">

            <div id="msg">
                <?php if($this->session->flashdata('msg') && $this->session->flashdata('msg') != ''){ ?>
                    <div class="alert alert-success fade in">
                        <strong>Success!</strong> <?php echo $this->session->flashdata('msg');; ?>
                    </div>
                <?php } unset($this->session->flashdata); ?>
            </div>

            <header class="panel-heading"> Images </header>
            <p class="sub_title"></p>
            <div class="col-md-6 col-lg-12 col-sm-12 col-xs-12">
                <div class="customer">
                    <div class="form-group">
                        <?php  foreach($row as $image){ ?>
                            <div style="float: left; margin-right: 20px;">
                                <a href="javascript:;" onclick="single_delete(<?php echo $image->id; ?>)" style="float: right;" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
                                <img src="<?php echo base_url().'public/images/haircut_nail/'.$image->name; ?>" style="height: 180px; width: 200px;" class="img-rounded"><br><br>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <p class="sub_title"></p>
            <div class="col-md-6 col-lg-12 col-sm-12 col-xs-12">
                <div class="customer">
                    <div class="form-group">
                        <label for="handle">Add New Images</label>
                        <input id="file-1" type="file" multiple class="file form-control" data-overwrite-initial="false" data-min-file-count="2" name="userfile[]">
                    </div>
                </div>
            </div>
        </section>
        <footer class="panel-footer text-right bg-light lter">
            <a href="<?php echo base_url().'index.php/haircut_nail/index'; ?>" data-toggle='modal' class="btn btn-success btn-s-xs" name="cancel">Cancel</a>
            <input type="submit" class="btn btn-success btn-s-xs" value="Update">
        </footer>
    </form>
</section>

<style>
    .fileinput-upload-button, .kv-file-upload{
        display: none;
    }
</style>

<script src="<?php echo base_url(); ?>public/js/jquery-1.8.3.min.js"></script>
<script>
    setTimeout( function(){$('#msg').hide();} , 4000);
    /*Single Delete Script*/
    function single_delete(value) {

        var id = value;
        $.ajax({
            url: '<?php echo base_url().'index.php/haircut_nail/single_delete_image/'; ?>' ,
            data: {
                ids: id.toString(),
                url: '<?php echo base_url().'index.php/haircut_nail/single_delete_image/'; ?>' ,
            },
            success: function (data) {

                if (data.status == 1) {
                    alert("Haircut & Nail image has been deleted successfully");
                    window.location.reload(true);
                }
                else {
                    alert('Failed to delete selected haircut & nail image.');
                }
            },
            error: function () {
                alert('Failed to delete selected haircut & nail image.');
            }
        });
    }
</script>

<?php include('footer.php'); ?>