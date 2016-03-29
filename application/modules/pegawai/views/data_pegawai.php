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
            <li class="active"> Pegawai</li>
        </ol>
    </div>
</div>
<!-- page head end-->

<!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="panel-body">
            <button class="btn btn-sm btn-primary" onclick="add_user()">
                <i class="fa fa-plus-square"></i> Tambah
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="table">
                <table id="tableUser" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>User</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Kota</th>
                            <th>Handphone</th>
                            <th>Act</th>
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

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modalUser" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Form Data Pegawai</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="formAddUser" class="form-horizontal">
          <input type="hidden" value="" name="id"/> 
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-2">User</label>
              <div class="col-md-4">
                <input name="userUsername" placeholder="User Name" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-2">Password</label>
              <div class="col-md-5">
                <input name="userPasswordx" placeholder="Password" class="form-control" type="password">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-2">Komfirmasi Password</label>
              <div class="col-md-5">
                <input name="userPassword" placeholder="Komfirmasi Password" class="form-control" type="password">
              </div>
            </div>
            <div class="form-group">
                       <label class="control-label col-md-2">User Group</label>
                            <div class="col-lg-5">
                                <select class="form-control select2" name="userGroup" id="userGroup">
                                    <option></option>
                                    <?php
                                        if(isset($group)){
                                        foreach($group as $row){
                                    ?>
                                        <option value="<?php echo $row->usrgroup_id?>"><?php echo $row->usrgroup_nama ?></option>
                                    <?php } } ?>
                                </select>
                       </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-2">Nama Pegawai</label>
              <div class="col-md-5">
                <input name="userNama" placeholder="Nama Pegawai" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2">Alamat</label>
                <div class="col-sm-8">
                 <textarea id="description" rows="3" name="userAlamat" id="userAlamat" class="form-control"></textarea>
                 <span class="help-block">Untuk memudahkan pendataan, silahkan isi dengan lengkap</span>
                </div>
            </div>            
            <div class="form-group">
              <label class="control-label col-md-2">Kota</label>
              <div class="col-md-3">
                <input name="userKota" placeholder="Kota"class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-2">Handphone</label>
              <div class="col-md-4">
                <input name="userHp" placeholder="Handphone" class="form-control" type="text">
              </div>
            </div>
          </div>
          <input class="form-control" type="hidden" name="userCreator" id="userCreator" value="<?php echo $creator; ?>">
          <input class="form-control" type="hidden" name="userTimestamp" id="userTimestamp" value="<?php echo $timestamp; ?>">
    

          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <!-- End Bootstrap modal -->

<script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/js/datatables/media/js/jquery.js"></script>
<script type="text/javascript">

    var save_method; //for save method string
    var table;
    $(document).ready(function() {

     // DATATABLES PEGAWAI //
        table = $('#tableUser').DataTable({ 
        
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('pegawai/ajax_list')?>",
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

    function add_user()
    {
      save_method = 'add';
      $('#formAddUser')[0].reset(); // reset form on modals
      $('#modalUser').modal('show'); // show bootstrap modal
      $('.modal-title').text('Add User'); // Set Title to Bootstrap modal title
    }

    function edit_user(user_username)
    {
      save_method = 'update';
      $('#formAddUser')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('pegawai/ajax_edit/')?>/" + user_username,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
           
            $('[name="userUsername"]').val(data.id);
            $('[name="userUsername"').val(data.user_username);
            $('[name="userPassword"]').val(data.user_passwordx);
            $('[name="userPasswordx"]').val(data.user_passwordx);
            $('[name="userGroup"]').val(data.user_group_kode)
            $('[name="userNama"]').val(data.user_nama);
            $('[name="userAlamat"]').val(data.user_alamat);
            $('[name="userKota"]').val(data.user_kota);
            $('[name="userHp"]').val(data.user_hp);
            
            $('#modalUser').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Pegawai'); // Set title to Bootstrap modal title
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }

    function cancel(){
        $('#formAddUser')[0].reset();
    }


    function reload_table()    {
      table.ajax.reload(null,false); //reload datatable ajax 
    }

    function save(){
      var url;
        if(save_method == 'add') 
            {
            url = "<?php echo site_url('pegawai/ajax_add')?>";
            }
            else
            {
            url = "<?php echo site_url('pegawai/editUserAjax')?>";
            }             
            // ajax adding data to database
            $.ajax({
            url : url,
            type: "POST",
            data: $('#formAddUser').serialize(),
            dataType: "JSON",
            success: function(data){
               //if success close modal and reload ajax table
               reload_table();
               $('#modalUser').modal('hide');
                $('#formAddUser')[0].reset();
                $("#userUsername").focus();
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error adding / update data');
            }
        });
    }

    function updateUser(){
        var url;
            url = "<?php echo site_url('pegawai/editUserAjax')?>";
            $.ajax({
            url : url,
            type: "POST",
            data: $('#formAddUser').serialize(),
            dataType: "JSON",
            success: function(data){
               $('#modalUser').modal('hide');
                reload_table();
                $('#formAddUser')[0].reset();
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert('Error adding / update data');
            }
        });
    }

    function delete_user(user_username)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data to database
          $.ajax({
            url : "<?php echo site_url('pegawai/ajax_delete')?>/"+user_username,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               //if success reload ajax table
               $('#modalUser').modal('hide');
               reload_table();
               
               $("#red-alert").show();
               $('#infodelete').html(' <strong>Sukses!</strong> Ukuran  <strong>'+user_username+'</strong> berhasil dihapus.');
               $("#red-alert").fadeTo(10000, 500).fadeOut(1000, function(){
                   $("#red-alert").hide();
                });
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
         
      }
    }

</script>