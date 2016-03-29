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
            <li class="active"> Supplier</li>
        </ol>
    </div>
</div>
<!-- page head end-->

<!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="panel-body">
            <button class="btn btn-sm btn-primary" onclick="add_supplier()">
                <i class="fa fa-plus-square"></i> Tambah
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="table">
                <table id="tableSupplier" class="table">
                        <thead>
                        <tr>
                            <th>Code</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Kota</th>
                            <th>Handphone</th>
                            <th>E-Mail</th>
                            <th>Act</th>
                        </tr>
                        </thead>
                        <tbody>                                                              
                        </tbody>
                </table>
            </div>
        </div>
    </div>
      <div class="row">
        <div class="col-lg-12">
            <form action="#" class="form-horizontal form-row-seperated">

            </form>
        </div>
    </div>
</div>

<!-- Bootstrap modal -->
<div class="modal fade" id="modalSupplier" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Form Data Supplier</h3>
            </div>
            <!-- BEGIN FORM-->
            <div class="modal-body form">
            <form action="#" class="form-horizontal" id="formAddSupplier">
             <input type="hidden" value="" name="" id="" /> 
                      <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-2">Code</label>
                                <div class="col-md-4">
                                    <input type="text" name="supplierKode" id="supplierKode" value="<?php echo $supplierKode ?>" class="form-control" aria-describedby="basic-addon1" readonly />
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="control-label col-md-2">Nama</label>
                                <div class="col-md-5">
                                    <input type="text" name="supplierNama" id="supplierNama" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2">Alamat</label>
                                <div class="col-sm-8">
                                    <textarea id="description" rows="4" name="supplierAlamat" id="supplierAlamat" class="form-control"></textarea>
                                    <span class="help-block">Untuk memudahkan pendataan, silahkan isi dengan lengkap</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2">Kota</label>
                                <div class="col-md-3">
                                    <input type="text" name="supplierKota" id="supplierKota" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2">E-Mail</label>
                                <div class="col-md-3">
                                    <input type="email" name="supplierEmail" id="supplierEmail" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2">Handphone</label>
                                <div class="col-md-4">
                                    <input type="number" name="supplierHP" id="supplierHP" class="form-control" />
                                </div>
                            </div>
                     </div>

                    <input class="form-control" type="hidden" name="supplierCreator" id="supplierCreator" value="<?php echo $creator; ?>">
                    <input class="form-control" type="hidden" name="supplierTimestamp" id="supplierTimestamp" value="<?php echo $timestamp; ?>">
        
                    <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="btnSave" onclick="save()">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
  <!-- End Bootstrap modal -->

<!-- START MODAL FORM SUPPLIER -->
<script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/js/datatables/media/js/jquery.js"></script>
<script type="text/javascript">

    var save_method; //for save method string
    var table;
    $(document).ready(function(){
        table = $('#tableSupplier').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('supplier/ajax_list')?>",
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
                        {"sClass": "text-left"},
                        {"sClass": "text-center"},
                        ]

        });
    });


// FUNCTION Supplier //
    function add_supplier(){
        save_method = 'add';
        $('#formAddSupplier')[0].reset(); // reset form on modals
        $('#modalSupplier').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Supplier'); // Set Title to Bootstrap modal title
    }

    function save(){
        var url;
        if(save_method == 'add'){
            url = "<?php echo site_url('supplier/ajax_add')?>";
        }else{
            url = "<?php echo site_url('supplier/editSupplierAjax')?>";
        }

            $.ajax({
            url : url,
            type: "POST",
            data: $('#formAddSupplier').serialize(),
            dataType: "JSON",
            success: function(data){
               reload_table();
               $('#modalSupplier').modal('hide');
               $('#formAddSupplier')[0].reset();
               $("#supplierKode").focus();
               

            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error adding / update data');
            }
        });
    }

    function reload_table(){
        table.ajax.reload(null,false); //reload datatable ajax
    }

    function edit_supplier(supplier_kode){
      save_method = 'update';
      $('#formAddSupplier')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('supplier/ajax_edit/')?>/" + supplier_kode,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
           
            $('[name="supplierKode"]').val(data.id);
            $('[name="supplierKode"]').val(data.supplier_kode);
            $('[name="supplierNama"]').val(data.supplier_nama);
            $('[name="supplierAlamat"]').val(data.supplier_alamat);
            $('[name="supplierKota"]').val(data.supplier_kota);
            $('[name="supplierHP"]').val(data.supplier_hp);
            $('[name="supplierEmail"]').val(data.supplier_email);
            
            $('#modalSupplier').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Supplier'); // Set title to Bootstrap modal title
            
        },
        error: function (jqXHR, textStatus, errorThrown){
            alert('Error get data from ajax');
        }
    });
    }

    function updateSupplier(){
        var url;
            url = "<?php echo site_url('supplier/editSupplierAjax')?>";
            $.ajax({
            url : url,
            type: "POST",
            data: $('#formAddSupplier').serialize(),
            dataType: "JSON",
            success: function(data){
               $('#modalSupplier').modal('hide');
                reload_table();
                $('#formAddSupplier')[0].reset();
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error adding / update data');
            }
        });
    }

    function delete_supplier(supplier_kode){
        if(confirm('Are you sure delete this data?')){
        // ajax delete data to database
            $.ajax({
            url : "<?php echo site_url('supplier/ajax_delete')?>/" + supplier_kode,
            type: "POST",
            dataType: "JSON",
            success: function(data){
               //if success reload ajax table
               $('#modalSupplier').modal('hide');
               reload_table();

               $("#red-alert").show();
               $('#infodelete').html(' <strong>Sukses!</strong> Ukuran  <strong>'+supplier_kode+'</strong> berhasil dihapus.');
               $("#red-alert").fadeTo(10000, 500).fadeOut(1000, function(){
                   $("#red-alert").hide();
                });
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error adding / update data');
            }
        });
      }
    }
// FUNCTION SUPPLIER //

</script>