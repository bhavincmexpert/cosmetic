<?php

include('header.php');
$userid = $this->session->userdata('id');

$query = $this->db->query("SELECT * FROM services WHERE status != '9' ");
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
                            Service
                        </header>
                        <div class="panel-body">
                            <div class="adv-table">
                                <div id="example_wrapper" class="dataTables_wrapper form-inline" role="grid">

                                    <div class="panel-body" style="float: right"> <a href="<?php echo base_url().'index.php/service/add'; ?>" class="btn btn-primary btn-lg">Add Service</a> </div>

                                    <table class="display table table-bordered table-striped dataTable" id="example"
                                           aria-describedby="example_info">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="width: 305px;">Action</th>
                                            <th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="width: 305px;">Name</th>
                                            <th class="sorting" role="columnheader" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="width: 305px;">Image</th>
                                        </tr>
                                        </thead>
                                        <tbody role="alert" aria-live="polite" aria-relevant="all">

                                        <?php foreach ($result as $app){ ?>

                                            <tr class="gradeX odd">
                                                <td class="">
                                                    <a href="<?php echo base_url().'index.php/service/add/'.$app->id; ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                                    <a href="javascript:;" onclick="single_delete(<?php echo $app->id; ?>)" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a>
                                                </td>
                                                <td class=""><?php echo $app->name; ?></td>
                                                <td class=""><img src="<?php echo base_url().'public/images/service/'.$app->image; ?>" height="50" width="50"></td>
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
            url: '<?php echo base_url().'index.php/service/single_delete_product/'; ?>' ,
            data: {
                ids: id.toString(),
                url: '<?php echo base_url().'index.php/service/single_delete_product/'; ?>' ,
            },
            success: function (data) {

                if (data.status == 1) {
                    alert("Service has been deleted successfully");
                    window.location.reload(true);
                }
                else {
                    alert('Failed to delete selected service.');
                    window.location.reload(true);
                }
            },
            error: function () {
                alert('Failed to delete selected service.');
                window.location.reload(true);
            }
        });
    }

</script>

<?php include('footer.php'); ?>