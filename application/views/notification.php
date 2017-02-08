<?php

include('header.php');
$userid = $this->session->userdata('id');

$query = $this->db->query("SELECT * FROM device_token_check");
$result = $query->result();
?>
<!--main content start-->
    <section id="main-content">
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
                        <header class="panel-heading">
                            Notification
                        </header>
                        <div class="panel-body">
                            <div class="adv-table">
                                <div id="example_wrapper" class="dataTables_wrapper form-inline" role="grid">

                                    <div class="panel-body" style="float: right"> <a href="<?php echo base_url().'index.php/notification/add'; ?>" class="btn btn-primary btn-lg">Send Notification</a> </div>

                                    <table class="display table table-bordered table-striped dataTable" id="example"
                                           aria-describedby="example_info">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="width: 305px;">Action</th>
                                            <th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="width: 305px;">Device Id</th>
                                            <th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="width: 305px;">Device Type</th>
                                            <th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="width: 305px;">Device OS</th>
                                        </tr>
                                        </thead>
                                        <tbody role="alert" aria-live="polite" aria-relevant="all">

                                        <?php foreach ($result as $app){ ?>

                                            <tr class="gradeX odd">
                                                <td class="">
                                                    <a href="javascript:;" onclick="single_delete(<?php echo $app->id; ?>)" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
                                                </td>
                                                <td class=""><?php echo $app->device_id; ?></td>
                                                <td class=""><?php echo $app->device_type; ?></td>
                                                <td class=""><?php echo $app->device_os; ?></td>
                                            </tr>

                                        <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <!-- page end-->
        </section>
    </section>
<!--main content end-->

<script type="text/javascript">

    function single_delete(value) {

        var id = value;

        $.ajax({
            url: '<?php echo base_url().'index.php/notification/single_delete_product/'; ?>' ,
            data: {
                ids: id.toString(),
                url: '<?php echo base_url().'index.php/notification/single_delete_product/'; ?>' ,
            },
            success: function (data) {

                if (data.status == 1) {
                    alert("Notification has been deleted successfully");
                    window.location.reload(true);
                }
                else {
                    alert('Failed to delete selected notification.');
                    window.location.reload(true);
                }
            },
            error: function () {
                alert('Failed to delete selected notification.');
                window.location.reload(true);
            }
        });
    }

</script>

<?php include('footer.php'); ?>