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
            <li><a href="#">Barang</a></li>
            <li class="active"> Kategori Barang</li>
        </ol>
    </div>
</div>
<!-- page head end-->

<!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="col-sm-6">
            <section class="panel">
                <header class="panel-heading ">
                    Kategori Barang
                <span class="tools pull-right">
                    <a class="fa fa-repeat box-refresh" href="javascript:;"></a>
                    <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                </span>
                </header>
                <div class="panel-body">
                    <div class="panel">
                        <form class="form-inline" id="formKategori" action="#">
                            <div class="form-group">
                                <input type="text" class="form-control" name="kategoriNama" id="kategoriNama" placeholder="Nama Kategori">
                            </div>
                            <div class="form-group">
                                <input type="text" name="kategoriPrefix" class="form-control" id="kategoriPrefix" placeholder="Prefix Kategori" title="Prefix ini digunakan untuk elemen kode barang" data-placement="right" data-toggle="tooltip">
                            </div>
                            <button type="button" class="btn btn-success"  onclick="save()">Simpan</button>
                        </form>
                    </div>
                    <div class="panel">
                            <table id="tabelKategori" class="table table-responsive">
                            <thead>
                            <tr>
                                <th>Kategori</th>
                                <th>Prefix</th>
                                <th>Jumlah Barang</th>
                                <th>Act</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            </table>
                    </div>
                </div>
            </section>
        </div>

        <div class="col-sm-6">
            <section class="panel">
                <header class="panel-heading ">
                    Merk Barang
                <span class="tools pull-right">
                    <a class="fa fa-repeat box-refresh" href="javascript:;"></a>
                    <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                </span>
                </header>
                <div class="panel-body">
                    <div class="panel">
                        <form class="form-inline" id="formMerk" action="#">
                            <div class="form-group">
                                <input type="text" class="form-control" name="merkNama" id="merkNama" placeholder="Merk Item">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="merkPrefix" id="merkPrefix" placeholder="Prefix Merk" title="Prefix ini digunakan untuk elemen kode barang" data-placement="right" data-toggle="tooltip">
                            </div>
                            <button type="button" class="btn btn-success"  onclick="saveMerk()">Simpan</button>
                        </form>
                    </div>
                    <div class="panel">
                            <table id="tabelMerk" class="table table-responsive">
                            <thead>
                            <tr>
                                <th>Merk</th>
                                <th>Prefix</th>
                                <th>Jumlah Barang</th>
                                <th>Act</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<!--body wrapper end-->

<!-- START MODAL EDIT KATEGORI -->
<div class="modal fade bs-modal" id="modalEditKategori" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Form edit kategori</h4>
            </div>
            <!-- BEGIN FORM-->
            <form action="#" class="form-horizontal form-row-seperated" id="formEditKategori">
                <div class="modal-body">
                    <input type="hidden" value="" name="kategoriEditId"/> 
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-2">Kategori</label>
                                <div class="col-md-4">
                                    <input type="text" name="kategoriEditNama" id="kategoriEditNama" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2">Prefix</label>
                                <div class="col-md-4">
                                    <input type="text" name="kategoriEditPrefix" id="kategoriEditPrefix" class="form-control" />
                                </div>
                            </div>
                            <input type="hidden" name="kategoriEditTimestamp" id="kategoriEditTimestamp" value="<?php echo $timestamp ?>" class="form-control" />
                            <input type="hidden" name="kategoriEditCreator" id="kategoriEditCreator" value="<?php echo $creator ?>" class="form-control" />
                        </div>
                    <!-- END FORM-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="btnSave" onclick="updateKategori()">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END MODAL EDIT KATEGORI -->

<!-- START MODAL EDIT MERK -->
<div class="modal fade bs-modal" id="modalEditMerk" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Form edit kategori</h4>
            </div>
            <!-- BEGIN FORM-->
            <form action="#" class="form-horizontal form-row-seperated" id="formEditMerk">
                <div class="modal-body">
                    <input type="hidden" value="" name="merkEditId"/> 
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-2">Kategori</label>
                                <div class="col-md-4">
                                    <input type="text" name="merkEditNama" id="merkEditNama" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2">Prefix</label>
                                <div class="col-md-4">
                                    <input type="text" name="merkEditPrefix" id="merkEditPrefix" class="form-control" />
                                </div>
                            </div>
                            <input type="hidden" name="merkEditTimestamp" id="merkEditTimestamp" value="<?php echo $timestamp ?>" class="form-control" />
                            <input type="hidden" name="merkEditCreator" id="merkEditCreator" value="<?php echo $creator ?>" class="form-control" />
                        </div>
                    <!-- END FORM-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="btnSave" onclick="updateMerk()">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END MODAL EDIT MERK -->

<script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/js/datatables/media/js/jquery.js"></script>

<script type="text/javascript">
    var save_method; //for save method string
    var table;
//    var tableMerk;
    
    $(document).ready(function(){
    $("#kategoriNama").focus();

    // DATATABLES KATEGORI //
        table = $('#tabelKategori').DataTable({
            "dom": 'f<"toolbar">T<"clear">rtpiH',
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('itemconfig/ajax_list')?>",
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
                        {"sClass": "text-center"},
                        {"sClass": "text-center"},
                        {"sClass": "text-center"},
                        ]

        });
        setInterval( function() {
            table.ajax.reload(null, false);
        }, 5000)
    // DATATABLES KATEGORI //

    // DATATABLES MERK //
        tableMerk = $('#tabelMerk').DataTable({
            "dom": 'f<"toolbar">T<"clear">rtpiH',
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('itemconfig/ajax_list_merk')?>",
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
                        {"sClass": "text-center"},
                        {"sClass": "text-center"},
                        {"sClass": "text-center"},
                        ]

        });
        setInterval( function() {
            tableMerk.ajax.reload(null, false);
        }, 5000)
    // DATATABLES MERK //
    
    });

    // FUNCTION KATEGORI //
    function edit_kategori(bargori_id){
        save_method = 'update';
        $('#formEditKategori')[0].reset(); // reset form on modals

          //Ajax Load data from ajax
          $.ajax({
            url : "<?php echo site_url('itemconfig/ajax_edit/')?>/" + bargori_id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('[name="kategoriEditId"]').val(data.id);
                $('[name="kategoriEditId"]').val(data.bargori_id);
                $('[name="kategoriEditNama"]').val(data.bargori_nama);
                $('[name="kategoriEditPrefix"]').val(data.bargori_prefix);
                
                $('#modalEditKategori').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Kategori'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }

    function cancel(){
        $('#formKategori')[0].reset();
    }

    function reload_table(){
      table.ajax.reload(null,false); //reload datatable ajax 
    }

    function save(){
        var url;
            url = "<?php echo site_url('itemconfig/addKategori')?>";
            $.ajax({
            url : url,
            type: "POST",
            data: $('#formKategori').serialize(),
            dataType: "JSON",
            success: function(data){
            reload_table();
                $('#formKategori')[0].reset();
                $("#kategoriNama").focus();
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error adding / update data');
            }
        });
    }

    function updateKategori(){
        var url;
            url = "<?php echo site_url('itemconfig/editKategoriAjax')?>";
            $.ajax({
            url : url,
            type: "POST",
            data: $('#formEditKategori').serialize(),
            dataType: "JSON",
            success: function(data){
               $('#modalEditKategori').modal('hide');
                reload_table();
                $('#formEditKategori')[0].reset();
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error adding / update data');
            }
        });
    }

    function delete_kategori(bargori_id){
        if(confirm('Are you sure delete this data?')){
            $.ajax({
            url : "<?php echo site_url('itemconfig/ajax_delete')?>/" + bargori_id,
            type: "POST",
            dataType: "JSON",
            success: function(data){
               reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error adding / update data');
            }
        });
      }
    }
    // FUNCTION KATEGORI //

    // FUNCTION MERK //
   function edit_merk(barmerk_id){
       save_method = 'update';
       $('#formEditMerk')[0].reset(); // reset form on modals

         // Ajax Load data from ajax
         $.ajax({
           url : "<?php echo site_url('itemconfig/ajax_edit_merk/')?>/" + barmerk_id,
           type: "GET",
           dataType: "JSON",
           success: function(data){
               $('[name="merkEditId"]').val(data.id);
               $('[name="merkEditId"]').val(data.barmerk_id);
               $('[name="merkEditNama"]').val(data.barmerk_nama);
               $('[name="merkEditPrefix"]').val(data.barmerk_prefix);
                
               $('#modalEditMerk').modal('show'); // show bootstrap modal when complete loaded
               $('.modal-title').text('Edit Merk'); // Set title to Bootstrap modal title
           },
           error: function (jqXHR, textStatus, errorThrown){
               alert('Error get data from ajax');
           }
       });
   }

   // function cancel(){
   //     $('#formKategori')[0].reset();
   // }

    function reload_table_merk(){
      tableMerk.ajax.reload(null,false); //reload datatable ajax 
    }

    function saveMerk(){
        var url;
            url = "<?php echo site_url('itemconfig/addMerk')?>";
            $.ajax({
            url : url,
            type: "POST",
            data: $('#formMerk').serialize(),
            dataType: "JSON",
            success: function(data){
            reload_table_merk();
                $('#formMerk')[0].reset();
                $("#merkNama").focus();
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error adding / update data');
            }
        });
    }

    function updateMerk(){
        var url;
            url = "<?php echo site_url('itemconfig/editMerkAjax')?>";
            $.ajax({
            url : url,
            type: "POST",
            data: $('#formEditMerk').serialize(),
            dataType: "JSON",
            success: function(data){
               $('#modalEditMerk').modal('hide');
                reload_table_merk();
                $('#formEditMerk')[0].reset();
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error adding / update data');
            }
        });
    }

    function delete_merk(barmerk_id){
        if(confirm('Are you sure delete this data?')){
            $.ajax({
            url : "<?php echo site_url('itemconfig/ajax_delete_merk')?>/" + barmerk_id,
            type: "POST",
            dataType: "JSON",
            success: function(data){
               reload_table_merk();
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error adding / update data');
            }
        });
      }
    }
    // FUNCTION MERK //
</script>