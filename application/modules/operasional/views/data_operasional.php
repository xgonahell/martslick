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
            <li class="active"> Operasional</li>
        </ol>
    </div>
</div>
<!-- page head end-->

<!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="panel-body">
            <button class="btn btn-success" onclick="add_operasional()">
                <i class="glyphicon glyphicon-plus"></i>
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="table">
                <table id="tableOperasional" class="table">
                        <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Tanggal</th>
                            <th>Deskripsi</th>
                            <th>Nominal</th>
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
<div class="modal fade" id="modalOperasional" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Data Pengeluaran Operasional</h3>
            </div>
            <!-- BEGIN FORM-->
            <div class="modal-body form">
            <form action="#" class="form-horizontal" id="formAddOperasional">
             <input type="hidden" value="" name="" id="" /> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-2">Kode</label>
                            <div class="col-lg-3">
                                <input type="text" class="form-control" name="oprKode" id="oprKode" value="<?php echo $oprKode ?>" aria-describedby="basic-addon1" readonly />
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-md-2">Deskripsi</label>
                            <div class="col-sm-8">
                                <textarea id="description" rows="4" name="oprDesc" id="oprDesc" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2">Nominal</label>
                            <div class="col-md-3">
                                <input type="text" name="oprNominal" id="oprNominal" class="form-control" />
                            </div>
                        </div>
                    </div>

                   
                    <input class="form-control" type="hidden" name="oprCreator" id="oprCreator" value="<?php echo $creator; ?>">
                    <input class="form-control" type="hidden" name="oprTimestamp" id="oprTimestamp" value="<?php echo $timestamp; ?>">
        
                    <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="btnSave" onclick="save()">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
  <!-- End Bootstrap modal -->

<!-- START MODAL FORM Operasional -->
<script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/js/datatables/media/js/jquery.js"></script>
<script type="text/javascript">

    var save_method; //for save method string
    var table;

    $(document).ready(function(){
    $("#oprDesc").focus();

    table = $('#tableOperasional').DataTable({
            "dom": 'f<"toolbar">T<"clear">rtpiH',
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('operasional/ajax_list')?>",
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
                        {"sClass": "text-center"},
                        ]

        });
    });


// FUNCTION Operasional //
    function add_operasional(){
        save_method = 'add';
        $('#formAddOperasional')[0].reset(); // reset form on modals
        $('#modalOperasional').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Operasional'); // Set Title to Bootstrap modal title
    }

    function save(){
        var url;
        if(save_method == 'add'){
            url = "<?php echo site_url('operasional/ajax_add')?>";
        }else{
            url = "<?php echo site_url('operasional/editOperasionalAjax')?>";
        }

            $.ajax({
            url : url,
            type: "POST",
            data: $('#formAddOperasional').serialize(),
            dataType: "JSON",
            success: function(data){
               reload_table();
               $('#modalOperasional').modal('hide');
               $('#formAddOperasional')[0].reset();
               $("#oprKode").focus();
               

            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error adding / update data');
            }
        });
    }

    function reload_table(){
        table.ajax.reload(null,false); //reload datatable ajax
    }

    function edit_operasional(oprKode){
      save_method = 'update';
      $('#formAddOperasional')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('operasional/ajax_edit/')?>/" + opr_kode,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
           
            $('[name="oprKode"]').val(data.id);
            $('[name="oprKode"]').val(data.opr_kode);
            $('[name="oprTimestamp"]').val(data.opr_createdat);
            $('[name="oprDesc"]').val(data.opr_desc);
            $('[name="oprNominal"]').val(data.opr_nominal);
            
            $('#modalOperasional').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Operasional'); // Set title to Bootstrap modal title
            
        },
        error: function (jqXHR, textStatus, errorThrown){
            alert('Error get data from ajax');
        }
    });
    }

    function updateOperasional(){
        var url;
            url = "<?php echo site_url('operasional/editOperasionalAjax')?>";
            $.ajax({
            url : url,
            type: "POST",
            data: $('#formAddOperasional').serialize(),
            dataType: "JSON",
            success: function(data){
               $('#modalOperasional').modal('hide');
                reload_table();
                $('#formAddOperasional')[0].reset();
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error adding / update data');
            }
        });
    }

    function delete_operasional(opr_kode){
        if(confirm('Are you sure delete this data?')){
        // ajax delete data to database
            $.ajax({
            url : "<?php echo site_url('operasional/ajax_delete')?>/" + opr_kode,
            type: "POST",
            dataType: "JSON",
            success: function(data){
               //if success reload ajax table
               $('#modalOperasional').modal('hide');
               reload_table();

               $("#red-alert").show();
               $('#infodelete').html(' <strong>Sukses!</strong> Data <strong>'+opr_kode+'</strong> berhasil dihapus.');
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
// FUNCTION Operasional //

</script>