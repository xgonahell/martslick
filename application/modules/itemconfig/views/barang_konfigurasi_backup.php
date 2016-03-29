<style>
.span3 {  
    height: 300px !important;
    overflow: scroll;
}
</style>
<h2 class="page-title"><?php echo $page_title?></span></h2>
<div class="row">
    <section class="widget">
        <header>
            <h4>
                Konfigurasi Warna dan Ukuran
            </h4>
            <div class="widget-controls">
                <a title="Options" href="index.html#"><i class="glyphicon glyphicon-cog"></i></a>
                <a data-widgster="close" title="Close" href="index.html#"><i class="glyphicon glyphicon-remove"></i></a>
            </div>
            <span>
            </span>
        </header>
        <div class="body">
            <ul id="myTab" class="nav nav-tabs">
                <li class="active"><a href="#warna" data-toggle="tab">Warna</a></li>
                <li><a href="#ukuran" data-toggle="tab">Ukuran</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade in active" id="warna">
                    <div class="body">
                        <div class="form-group">
                            <button class="btn btn-sm btn-primary" onclick="add_warna()">
                                <i class="glyphicon glyphicon-plus"></i>
                            </button>
                        </div>
                            <table class="table table-hover dt-responsive table-condensed nowrap" id="tableWarna">
                                <thead>
                                    <tr>
                                        <th width="65%">Warna</th>
                                        <th class="text-center">Jml</th>
                                        <th class="text-center">Act</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                    </div>
                </div>

                <div class="tab-pane fade in" id="ukuran">
                    <div class="body">
                        <div class="form-group">
                            <button class="btn btn-sm btn-info" onclick="add_ukuran()">
                                <i class="glyphicon glyphicon-plus"></i>
                            </button>
                        </div>
                        <div class="span3">
                            <table class="table table-hover dt-responsive table-condensed nowrap" id="tableUkuran">
                                <thead>
                                    <tr>
                                        <th width="65%">Ukuran</th>
                                        <th class="text-center">Jml</th>
                                        <th class="text-center">Act</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(isset($ukuran)){
                                        foreach($ukuran as $row){
                                    ?>
                                    <tr>
                                        <td width="65%"> <?php echo $row->barsize_prefix ?> </td>
                                        <td class="text-center"> <span class="badge badge-info badge-roundless"> 28 </span> </td>
                                        <td class="text-center">
                                            <a class="btn btn-xs red" href="<?php echo base_url();?>itemconfig/deleteUkuran/<?php echo $row->barsize_id ?>" onclick="return confirm('Apakah anda yakin akan menghapus ukuran ?')">
                                                <span class="fa fa-trash-o"></span>
                                            </a>
                                            <a class="btn btn-xs green" data-toggle="modal" href="">
                                                <span class="fa fa-pencil"></span>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php } } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- START MODAL ADD WARNA -->
<div class="modal fade bs-modal" id="modalWarna" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Form penambahan Warna</h4>
            </div>
            <!-- BEGIN FORM-->
            <form action="#" class="form-horizontal form-row-seperated" id="formAddWarna">
                <div class="modal-body">
                    <input type="hidden" value="" name="barwarKode"/> 
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-2">Warna</label>
                                <div class="col-md-4">
                                    <input type="text" name="barwarNama" id="barwarNama" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2">Prefix</label>
                                <div class="col-md-4">
                                    <input type="text" name="barwarPrefix" id="barwarPrefix" class="form-control" />
                                </div>
                            </div>
                        </div>
                    <!-- END FORM-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="btnSave" onclick="save()">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- END MODAL ADD WARNA -->
    <script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/white/lib/datatables/media/js/jquery.js"></script>

<script type="text/javascript">
    var save_method; //for save method string
    var table;

    $(document).ready(function(){
        table = $('#tableWarna').DataTable({
            "dom": 'f<"toolbar">T<"clear">rtp',

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
                        ]

        });
    });

    function add_warna(){
      save_method = 'add';
      $('#formAddWarna')[0].reset(); // reset form on modals
      $('#modalWarna').modal('show'); // show bootstrap modal
      $('.modal-title').text('Add Warna'); // Set Title to Bootstrap modal title
    }

    function save(){
        var url;
        if(save_method == 'add'){
            url = "<?php echo site_url('itemconfig/addWarnaAjax')?>";
        }else{
            url = "<?php echo site_url('itemconfig/editWarnaAjax')?>";
        }

       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            data: $('#formAddWarna').serialize(),
            dataType: "JSON",
            success: function(data){
               $('#modalWarna').modal('hide');
               reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error adding / update data');
            }
        });
    }

    function reload_table(){
      table.ajax.reload(null,false); //reload datatable ajax 
    }

    function edit_warna(barwar_kode){
      save_method = 'update';
      $('#formAddWarna')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('itemconfig/ajax_edit/')?>/" + barwar_kode,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
           
            $('[name="barwarKode"]').val(data.id);
            $('[name="barwarKode"]').val(data.barwar_kode);
            $('[name="barwarNama"]').val(data.barwar_nama);
            $('[name="barwarPrefix"]').val(data.barwar_prefix);
            
            $('#modalWarna').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Person'); // Set title to Bootstrap modal title
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }

    function delete_warna(barwar_kode){
        if(confirm('Are you sure delete this data?')){
        // ajax delete data to database
            $.ajax({
            url : "<?php echo site_url('itemconfig/ajax_delete')?>/" + barwar_kode,
            type: "POST",
            dataType: "JSON",
            success: function(data){
               //if success reload ajax table
               $('#modalWarna').modal('hide');
               reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error adding / update data');
            }
        });
      }
    }
</script>