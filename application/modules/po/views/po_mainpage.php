<link href="<?php echo base_url() ?>assets/js/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">

<!-- page head start-->
<div class="page-head">
    <h3 class="m-b-less">
        <?php echo $page_title; ?>
    </h3>
    <!--<span class="sub-title">Welcome to Static Table</span>-->
    <div class="state-information">
        <ol class="breadcrumb m-b-less bg-less">
            <li><a href="#">Home</a></li>
            <li><a href="#">Pengeluaran</a></li>
            <li class="active"> Purchase Order</li>
        </ol>
    </div>
</div>
<!-- page head end-->

<!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="panel-body">
            <a class="btn btn-sm btn-primary"  href="<?php echo base_url('po/newpo') ?>">
                <i class="fa fa-plus-square"></i> Tambah
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="table">
                <table id="tablePo" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>                        
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Invoice</th>
                                <th class="text-right">Pembayaran</th>
                                <th class="text-center">Pembayaran PO</th>
                                <th class="text-center">Status Barang</th>
                                <th class="text-left">Act</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--body wrapper end-->

<script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/js/datatables/media/js/jquery.js"></script>

<script type="text/javascript">
$(document).ready(function(){
    // DATATABLES PO //
        $('#tablePo').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('po/ajax_list')?>",
                "type": "POST"
            },

            //Set column definition initialisation properties.
            "columnDefs": [
            { 
              "targets": [ -1 ], //last column
              "orderable": false, //set not orderable
            },
            ],
            "aoColumns": [
                        {"sClass": "text-center"},
                        {"sClass": "text-center"},
                        {"sClass": "text-center"},
                        {"sClass": "text-right"},
                        {"sClass": "text-center"},
                        {"sClass": "text-center"},
                        {"sClass": "text-left"},
                        ]
        });
    // DATATABLES PO //
});
</script>