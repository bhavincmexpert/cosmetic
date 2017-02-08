<!--footer start-->
<footer class="site-footer">

<div class="text-center">
    <?php echo "2016 &copy; COSMETIC"; ?>
</div>
<a href="#" class="go-top">
    <i class="fa fa-angle-up"></i>
</a>
</div>

</footer>
<!--footer end-->
</section>
<script src="<?php echo base_url(); ?>public/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery-1.8.3.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>

<script class="include" type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="<?php echo base_url(); ?>public/js/fileinput.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.scrollTo.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.nicescroll.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>public/js/jquery.sparkline.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.easy-pie-chart.js"></script>
<script src="<?php echo base_url(); ?>public/js/owl.carousel.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.customSelect.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/respond.min.js"></script>


<script src="<?php echo base_url(); ?>public/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>public/js/DT_bootstrap.js"></script>

<script src="<?php echo base_url(); ?>public/js/moment.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/common-scripts.js"></script>



<!--script for this page-->
<script src="<?php echo base_url(); ?>public/js/sparkline-chart.js"></script>
<script src="<?php echo base_url(); ?>public/js/easy-pie-chart.js"></script>
<script src="<?php echo base_url(); ?>public/js/count.js"></script>

<script type="text/javascript">

    $(document).ready(function () {
        $('#example').dataTable({
            "aaSorting": [[4, "desc"]]
        });
    });

    $("#file-1").fileinput({
        uploadUrl: '#', // you must set a valid URL here else you will get an error
        allowedFileExtensions: ['jpg', 'png', 'gif', 'tif',],
        overwriteInitial: false,
        slugCallback: function (filename) {
            return filename.replace('(', '_').replace(']', '_');
        }
    });

</script>

</body>
</html>