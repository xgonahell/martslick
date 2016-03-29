
        </div>
        <!-- body content end-->
    </section>



<!-- Placed js at the end of the document so the pages load faster -->

<!-- Calling DataTable Dependency Responsive Table -->
<script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/js/datatables/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/js/datatables/media/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/js/datatables/media/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/js/datatables/media/js/responsive.bootstrap.min.js"></script>
<!-- End of Calling DataTable Dependency Responsive Table -->



<!--jquery-ui-->
<script src="<?php echo base_url() ?>assets/js/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>

<script src="<?php echo base_url() ?>assets/js/jquery-migrate.js"></script>
<script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/modernizr.min.js"></script>

<!--Nice Scroll-->
<script src="<?php echo base_url() ?>assets/js/jquery.nicescroll.js" type="text/javascript"></script>

<!--right slidebar-->
<script src="<?php echo base_url() ?>assets/js/slidebars.min.js"></script>

<!--switchery-->
<script src="<?php echo base_url() ?>assets/js/switchery/switchery.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/switchery/switchery-init.js"></script>

<!--flot chart -->
<script src="<?php echo base_url() ?>assets/js/flot-chart/jquery.flot.js"></script>
<script src="<?php echo base_url() ?>assets/js/flot-chart/flot-spline.js"></script>
<script src="<?php echo base_url() ?>assets/js/flot-chart/jquery.flot.resize.js"></script>
<script src="<?php echo base_url() ?>assets/js/flot-chart/jquery.flot.tooltip.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/flot-chart/jquery.flot.pie.js"></script>
<script src="<?php echo base_url() ?>assets/js/flot-chart/jquery.flot.selection.js"></script>
<script src="<?php echo base_url() ?>assets/js/flot-chart/jquery.flot.stack.js"></script>
<script src="<?php echo base_url() ?>assets/js/flot-chart/jquery.flot.crosshair.js"></script>


<!--earning chart init-->
<script src="<?php echo base_url() ?>assets/js/earning-chart-init.js"></script>


<!--Sparkline Chart-->
<script src="<?php echo base_url() ?>assets/js/sparkline/jquery.sparkline.js"></script>
<script src="<?php echo base_url() ?>assets/js/sparkline/sparkline-init.js"></script>

<!--easy pie chart-->
<script src="<?php echo base_url() ?>assets/js/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
<script src="<?php echo base_url() ?>assets/js/easy-pie-chart.js"></script>


<!--vectormap-->
<script src="<?php echo base_url() ?>assets/js/vector-map/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/vector-map/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?php echo base_url() ?>assets/js/dashboard-vmap-init.js"></script>

<!--Icheck-->
<script src="<?php echo base_url() ?>assets/js/icheck/skins/icheck.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/todo-init.js"></script>

<!--jquery countTo-->
<script src="<?php echo base_url() ?>assets/js/jquery-countTo/jquery.countTo.js"  type="text/javascript"></script>

<!--owl carousel-->
<script src="<?php echo base_url() ?>assets/js/owl.carousel.js"></script>


<!--common scripts for all pages-->

<script src="<?php echo base_url() ?>assets/js/scripts.js"></script>


<script type="text/javascript">

    $(document).ready(function() {

        //countTo

        $('.timer').countTo();

        //owl carousel

        $("#news-feed").owlCarousel({
            navigation : true,
            slideSpeed : 300,
            paginationSpeed : 400,
            singleItem : true,
            autoPlay:true
        });
    });

    $(window).on("resize",function(){
        var owl = $("#news-feed").data("owlCarousel");
        owl.reinit();
    });

</script>

</body>
</html>
