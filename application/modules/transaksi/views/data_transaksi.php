<!--Select2-->
<link href="<?php echo base_url()?>assets/css/select2.css" rel="stylesheet">
<link href="<?php echo base_url()?>assets/css/select2-bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/js/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">

<!-- page head start-->
<div class="page-head">
    <h3 class="m-b-less">
        <?php echo $page_title; ?>
    </h3>
    <!--<span class="sub-title">Welcome to Static Table</span>-->
    <div class="state-information">
        <ol class="breadcrumb m-b-less bg-less">
            <li><a href="#">Pengeluaran</a></li>
            <li class="active"> Transaksi</li>
        </ol>
    </div>
</div>
<!-- page head end-->

<!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="panel-body">
            <a class="btn btn-sm btn-primary"  href="<?php echo base_url('transaksi/TransaksiBaru') ?>">
                <i class="fa fa-plus-square"></i> Tambah
            </a>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <table id="tableTransaksi" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Invoice</th>
                        <th>Tanggal</th>
                        <th>Info Pembayaran</th>
                        <th>Pelanggan</th>
                        <th>Harga</th>
                        <th>Act</th>
                    </tr>
                    </thead>
                    <tbody>                        
                    </tbody>
                </table>
            </section>
        </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
          <form action="#" class="form-horizontal form-row-seperated">

          </form>
      </div>
    </div>
</div>

<script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/js/datatables/media/js/jquery.js"></script>

<!--select2-->
<script src="<?php echo base_url()?>assets/js/select2.js"></script>
<!--select2 init-->
<script src="<?php echo base_url()?>assets/js/select2-init.js"></script>


<script type="text/javascript">
    
    var save_method; //for save method string
    var table;
    $(document).ready(function(){
    $("#oprDesc").focus();


    table = $('#tableTransaksi').DataTable({ 
        "dom": 'f<"toolbar">T<"clear">rtpiH',
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('transaksi/ajax_list')?>",
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
                        {"sClass": "text-left"},
                        {"sClass": "text-left"},
                        {"sClass": "text-left"},
                        {"sClass": "text-left"},
                        {"sClass": "text-left"},
                        {"sClass": "text-center"},
                        ]

      });
    });

    function reload_table(){
        table.ajax.reload(null,false); //reload datatable ajax
    }

    function add_item(){
        save_method = 'add';
//        $('#formSize')[0].reset(); // reset form on modals
        $('#modalTransaksi').modal('show'); // show bootstrap modal
        $('.modal-title').text('New Transaksi'); // Set Title to Bootstrap modal title
    }

</script>