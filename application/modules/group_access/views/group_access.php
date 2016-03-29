
<h2 class="page-title"><?php echo $page_title ?></span></h2>
<div class="row">
    <div class="col-md-12">
        <section class="widget">
            <header>
                <h4>
                    &nbsp;</span>
                </h4>
                <div class="widget-controls">
                    <a data-toggle="modal" title="Add another menu" href="#large" onclick="datamodal('Tambah User Group')"><i class="glyphicon glyphicon-plus"></i></a>
                </div>
            </header>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>

                            <th> Group Name </th>
                            <th colspan="3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list_group as $lg): ?>
                            <tr>
                                <td><?php echo $lg->usrgroup_nama; ?></td>
                                <td>
                                    <a href="#akses" title="Hak akses" data-toggle="modal" onClick="getModule('<?php echo $lg->usrgroup_id; ?>');"><i class="fa fa-key"></i></a>
                                </td>
                                <td>
                                    <a title="Edit" data-toggle="modal" href="#large" onClick="datamodal('Edit Group', '<?php echo $lg->usrgroup_id; ?>', '<?php echo $lg->usrgroup_nama; ?>')">
                                        <i class="fa fa-wrench"></i>
                                    </a>
                                </td>
                                <td>
                                    <a data-toggle="modal" href="#large2" title="Delete" onClick="set_delete_id('<?php echo $lg->usrgroup_id; ?>')"><i class="fa fa-remove"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>

<input type="hidden" data-toggle="modal" id="group_id" name="group_id"/>

<!-- START MODAL ADD -->


<div id="akses" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title" id="modal_title">Grant Access</h4>
            </div>
            <div class="modal-body">
                <div class="scroller" data-always-visible="1" data-rail-visible1="1" >
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-hover">

                                <tr>
                                    <td><b>Module</b></td>
                                    <td><b>Aksi</b></td>
                                </tr>

                                <tbody class="module_body">

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!--<button type="button" data-dismiss="modal" class="btn red">Close</button>
                <button type="button" class="btn green" data-dismiss="modal" id="btnSave" onClick="save()">Save changes</button>-->
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="large2" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Confirmation</h4>
            </div>
            <div class="modal-body">Are you sure want to delete this data?</div>
            <div class="modal-footer">
                <button type="button" class="btn red" data-dismiss="modal">No</button>
                <button type="button" class="btn green" data-dismiss="modal" onClick="delete_data()">Yes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div id="large" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title" id="modal_title"></h4>
            </div>
            <div class="modal-body">
                <div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1">
                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group form-md-line-input">
                                
                                <label for="form_control_1">Group Name</label>
                                <input type="text" class="form-control" name="group_name" id="group_name">
                                <span class="help-block">The group name you desire</span>
                            </div>
                        </div>
                        <div class="col-md-6">

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn red">Close</button>
                <button type="button" class="btn green" data-dismiss="modal" id="btnSave" onClick="save()">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL ADD -->


<script type="text/javascript">

    function set_delete_id(group_id = '')
    {
        $('#group_id').val(group_id);
    }

    function delete_data()
    {
        window.location = "<?php echo base_url() ?>group_access/delete/" + $('#group_id').val();
    }

    function datamodal(title = '', group_id = '', group_name = '')
    {
        $('#group_name').val('');
        $('#group_id').val('');

        if (title != '')
        {
            $('#modal_title').html(title);

        }

        if (group_id != '')
        {
            $('#group_id').val(group_id);
        }
        
        if(group_name != '')
        {
            $('#group_name').val(group_name);
        }
    }

    function save()
    {
        var group_id = $('#group_id').val();
        var group_name = $('#group_name').val();
        
        $.ajax({
            method: "POST",
            url: "<?php echo base_url() ?>group_access/save",
            data: {group_id:group_id, group_name:group_name},
            dataType: 'json',
            success: function (m)
            {
                console.log(m);
                if (m.success == true)
                {
                    window.location.reload();
                } else
                {

                }
            },
            error: function (e) {
                console.log(e.statusText);
            }
        });
    }


    function getModule(group_id)
    {
        $('.module_body').empty();
        $.ajax({
            method: "POST",
            url: "<?php echo base_url() ?>group_access/get_module",
            data: {group_id: group_id},
            dataType: 'json',
            success: function (m)
            {

                $.each(m.data, function (key) {
                    var element = "";
                    element += '<tr><td>' + m.data[key].module_name + '</td><td>';
                    if (m.data[key].status == '1')
                    {
                        element += '<input type="checkbox" class="state_access" checked="checked" onChange="upstate($(this),' + m.data[key].module_id + ', ' + group_id + ')"/>';
                    } else
                    {
                        element += '<input type="checkbox" class="state_access" onChange="upstate($(this),' + m.data[key].module_id + ', ' + group_id + ')"/>';
                    }

                    element += '</td></tr>';
                    $('.module_body').append(element);
                });
            },
            error: function (e) {
                console.log(e.statusText);
            }
        });
    }

    function upstate(e, mid, gid)
    {
        var st = "";
        if (e.is(':checked'))
            st = "1";
        else
            st = "0";

        $.ajax({
            method: "POST",
            url: "<?php echo base_url() ?>group_access/upstate",
            data: {group_id: gid, module_id:mid, state:st},
            dataType: 'json',
            success: function (m)
            {
                
            },
            error: function (e) {
                //console.log(e.statusText);
            }
        });

    }



</script>