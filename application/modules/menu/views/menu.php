<h2 class="page-title"><?php echo $page_title?></span></h2>
<div class="row">
    <div class="col-md-12">
    <section class="widget">
        <div class="col-md-offset-0">
            <a class="btn btn-xs btn-primary" data-toggle="modal" href="#large" onclick="datamodal('Tambah menu')">
                <span class='glyphicon glyphicon-plus'></span> Tambah menu
            </a>
        </div>
    </section>
        <section class="widget">
            <header>
                <!--<h4>
                    Table <span class="fw-semi-bold">Styles</span>
                </h4>-->
                <div class="widget-controls">


                </div>
            </header>
            <div class="">
                <table class="table table-hover dt-responsive nowrap" id="martsTableMenu">
                    <thead>
                        <tr>
                            <th> Nama Module </th>
                            <th> Controller </th>
                            <th> Parent </th>
                            <th> Order </th>
                            <th> Status </th>
                            <th>Aksi</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list_menu as $l): ?>
                            <tr>
                                <td><?php echo $l->module_name; ?></td>
                                <td><?php echo $l->module_controller; ?></td>
                                <td><?php echo $l->module_parent; ?></td>
                                <!--<td><?php echo $l->module_order; ?></td>-->
                                <td>
                                    <a href="<?php echo base_url() ?>menu/set_order/up/<?php echo $l->module_id ?>"><i class="fa fa-caret-square-o-up"></i></a>
                                    <?php echo $l->module_order ?>
                                    <a href="<?php echo base_url() ?>menu/set_order/down/<?php echo $l->module_id ?>"><i class="fa fa-caret-square-o-down"></i></a>
                                </td>
                                <td><?php if ($l->module_active_flag == '1'): ?><span class="label label-sm label-success"> Enabled </span><?php else: ?><span class="label label-sm label-danger"> Disabled </span><?php endif; ?></td>
                                <td>
                                    <?php if ($l->module_controller != "menu"): ?>
                                        <?php if ($l->module_active_flag == '1'): ?>
                                            <a href="<?php echo base_url() ?>menu/set_active/0/<?php echo $l->module_id ?>" title="Disable"><i class="fa fa-toggle-on"></i></a>
                                        <?php else: ?>
                                            <a href="<?php echo base_url() ?>menu/set_active/1/<?php echo $l->module_id ?>" title="Enable"><i class="fa fa-toggle-off"></i></a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a title="Edit" data-toggle="modal" href="#large" onClick="datamodal('Ubah menu', '<?php echo $l->module_name; ?>', '<?php echo $l->module_controller; ?>', '<?php echo $l->module_parent_id; ?>', '<?php echo $l->module_active_flag ?>', '<?php echo $l->module_id ?>')">
                                        <i class="fa fa-wrench"></i>
                                    </a>
                                </td>
                                <td>
                                    <a data-toggle="modal" href="#large2" title="Delete" onClick="set_delete_id('<?php echo $l->module_id ?>')"><i class="fa fa-remove"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>

<input type="hidden" data-toggle="modal" id="module_id" name="module_id"/>

<!-- START MODAL ADD -->
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
                                <input type="text" class="form-control" name="module_name" id="module_name">
                                <label for="form_control_1">Module Name</label>
                                <span class="help-block">The module name you desire</span>
                            </div>
                            <div class="form-group form-md-line-input">
                                <input type="text" class="form-control" name="module_controller" id="module_controller">
                                <label for="form_control_1">Module Controller</label>
                                <span class="help-block">This sould be the uri for your page</span>
                            </div>

                        </div>
                        <div class="col-md-6">

                            <div class="form-group form-md-line-input">
                                <select class="form-control" name="module_parent" id="module_parent">
                                    <option value=""></option>
                                    <?php foreach ($list_parent as $lp): ?>
                                        <option value="<?php echo $lp->module_id ?>"><?php echo $lp->module_name ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="form_control_1">Module Parent</label>
                                <span class="help-block">Fill it, if you want to make it a submenu</span>
                            </div>
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

<!-- Init DataTable Responsive Table -->
    <script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/white/lib/datatables/media/js/jquery.js"></script>
        <script type="text/javascript" language="javascript" class="init">

            $(document).ready(function() {
            $('#martsTableMenu').DataTable( {
                 
                  "aoColumnDefs": [
                    { "bSortable": false, "aTargets": [ 5, 6, 7 ] } ],
                  "order": [[ 3, "asc" ]],
                  "paging":   false,
                  "info": false,
                  "searching": false

                 } );
            } );

         </script>
<!-- End of Init DataTable Responsive Table -->
<script type="text/javascript">

    function set_delete_id($module_id = '')
    {
        $('#module_id').val($module_id);
    }

    function delete_data()
    {
        window.location = "<?php echo base_url() ?>menu/delete/" + $('#module_id').val();
    }

    function datamodal(title = '', module_name = '', module_controller = '', module_parent = '', module_active_flag = '', module_id = '')
    {
        $('#module_name').val('');
        $('#module_controller').val('');
        $('#module_parent').val('');
        $('#module_id').val('');

        if (title != '')
        {
            $('#modal_title').html(title);

        }

        if (module_id != '')
        {
            $('#module_id').val(module_id);
        }

        if (module_name != '')
        {
            $('#module_name').val(module_name);
        }
        if (module_controller != '')
        {
            $('#module_controller').val(module_controller);
        }

        if (module_parent != '')
        {
            $('#module_parent').val(module_parent);
        }
    }

    function save()
    {
        var module_id = $('#module_id').val();
        var module_name = $('#module_name').val();
        var module_controller = $('#module_controller').val();
        var module_parent = $('#module_parent').val();
        $.ajax({
            method: "POST",
            url: "<?php echo base_url() ?>menu/save",
            data: {module_id: module_id, module_name: module_name, module_controller: module_controller, module_parent: module_parent},
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
</script>



