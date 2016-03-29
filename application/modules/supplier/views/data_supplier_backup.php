<h2 class="page-title"><span><?php echo $page_title?></span></h2>
<div class="row">
    <div class="alert alert-success alert-dismissible" id="green-alert-warna" role="alert" style="display: none">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <span id="infosukses"></span>
    </div>

    <div class="alert alert-danger alert-dismissible" id="red-alert" role="alert" style="display: none">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <span id="infodelete"></span>
    </div>

    <section class="widget">
        <div class="col-md-offset-0">
            <button class="btn btn-sm btn-primary" onclick="add_supplier()">
                <i class="glyphicon glyphicon-plus"> Tambah</i>
            </button>
        </div>
    </section>
    <section class="widget">
        <header>
            <h4>Data <span class="fw-semi-bold">Supplier</span></h4>
            <div class="widget-controls">
                <a data-widgster="expand" title="Expand" href="tables_dynamic.html#"><i class="glyphicon glyphicon-chevron-up"></i></a>
                <a data-widgster="collapse" title="Collapse" href="tables_dynamic.html#"><i class="glyphicon glyphicon-chevron-down"></i></a>
            </div>
        </header>
        <div class="body">
            <div class="mt">
                <table class="table table-striped table-bordered table-hover dt-responsive table-condensed nowrap" id="tableSupplier">
                    <thead>
                        <tr>
                            <th scope="col"> Kode </th>
                            <th scope="col"> Nama </th>
                            <th scope="col"> Alamat </th>
                            <th scope="col"> Kota </th>
                            <th scope="col"> Handphone </th>
                            <th scope="col" class="text-center"> Act </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<!-- START MODAL FORM SUPPLIER -->
<div class="modal fade bs-modal" id="modalSupplier" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Form Pendaftaran Supplier</h4>
            </div>
            <!-- BEGIN FORM-->
            <form action="#" class="form-horizontal form-row-seperated" id="formSupplier">
                <div class="modal-body">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-2">Kode</label>
                                <div class="col-md-2">
                                    <input type="text" name="supplierKode" id="supplierKode" value="" class="form-control" />
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
                                    <span class="help-block">Untuk memudahkan pengiriman, silahkan isi dengan lengkap</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2">Kota</label>
                                <div class="col-md-3">
                                    <input type="text" name="supplierKota" id="supplierKota" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2">Handphone</label>
                                <div class="col-md-4">
                                    <input type="text" name="supplierHP" id="supplierHP" class="form-control" />
                                </div>
                            </div>

                            <input type="hidden" name="supplierTimestamp" id="supplierTimestamp" value="<?php echo $timestamp ?>" class="form-control" />
                            <input type="hidden" name="supplierOperator" id="supplierOperator" value="<?php echo $creator ?>" class="form-control" />

                        </div>
                    <!-- END FORM-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="btnSave" onclick="save()">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- START MODAL FORM SUPPLIER -->
<script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/white/lib/datatables/media/js/jquery.js"></script>
<script type="text/javascript">
    var save_method; //for save method string
    var dataTablesSupplier;

    $(document).ready(function(){
        dataTablesSupplier = $('#tableSupplier').DataTable({
            "dom": 'f<"toolbar">T<"clear">rtp',

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
                        {"sClass": "text-center"},
                        ]

        });
    });

    function updateVal(){
        if($('input[name=supplierKode]').length > 0){
            $('input[name=supplierKode]').val('new val');
        }else{
            setTimeout(function(){ updateVal(); }, 200);
        }
    }
    updateVal();

// FUNCTION SIZE //
    function add_supplier(){
        save_method = 'add';
        $('#formSupplier')[0].reset(); // reset form on modals
        $('#modalSupplier').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Supplier'); // Set Title to Bootstrap modal title
    }

    function save(){
        var url;
        if(save_method == 'add'){
            url = "<?php echo site_url('supplier/addSupplierAjax')?>";
        }else{
            url = "<?php echo site_url('supplier/editSupplierAjax')?>";
        }

            $.ajax({
            url : url,
            type: "POST",
            data: $('#formSupplier').serialize(),
            dataType: "JSON",
            success: function(data){
               $('#modalSupplier').modal('hide');
               reload_table();
               reload_form();


//               if(save_method == 'add'){
//                   $("#green-alert-ukuran").show();
//                   $('#infosusksesukuran').html(' <strong>Sukses!</strong> Ukuran  <strong>'+$('#barsizePrefix').val()+'</strong> berhasil ditambahkan.');
//                   $("#green-alert-ukuran").fadeTo(10000, 500).fadeOut(1000, function(){
//                       $("#green-alert-ukuran").hide();
//                    });
//                }else{
//                   $("#green-alert-ukuran").show();
//                   $('#infosusksesukuran').html(' <strong>Sukses!</strong> Ukuran telah berhasil diubah menjadi  <strong>'+$('#barsizePrefix').val()+'</strong>.');
//                   $("#green-alert-ukuran").fadeTo(10000, 500).fadeOut(1000, function(){
//                       $("#green-alert-ukuran").hide();
//                    });
//                }
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error adding / update data');
            }
        });
    }



    function reload_table(){
        dataTablesSupplier.ajax.reload(null,false); //reload datatable ajax
    }

    function edit_size(barsize_id){
      save_method = 'update';
      $('#formSize')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('itemconfig/ajax_edit/')?>/" + barsize_id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
           
            $('[name="barsizeID"]').val(data.id);
            $('[name="barsizeID"]').val(data.barsize_id);
            $('[name="barsizeWorkflow"]').val(data.barsize_workflow);
            $('[name="barsizePrefix"]').val(data.barsize_prefix);
            
            $('#modalSize').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit size'); // Set title to Bootstrap modal title
            
        },
        error: function (jqXHR, textStatus, errorThrown){
            alert('Error get data from ajax');
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
               $('#modalSize').modal('hide');
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
// FUNCTION SIZE //

</script>