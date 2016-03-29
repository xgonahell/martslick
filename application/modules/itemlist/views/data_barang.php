<!--Select2-->
<link href="<?php echo base_url()?>assets/css/select2.css" rel="stylesheet">
<link href="<?php echo base_url()?>assets/css/select2-bootstrap.css" rel="stylesheet">

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
            <li class="active"> Data Barang</li>
        </ol>
    </div>
</div>
<!-- page head end-->

<!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="panel-body">
            <a class="btn btn-sm btn-primary" href="<?php echo base_url('itemlist/pageAdd') ?>">
                <i class="fa fa-plus-square"></i> Tambah
            </a>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode</th>
                            <th>Deskripsi</th>
                            <th>Quantity</th>
                            <th>Harga</th>
                            <th>Harga Jual</th>
                            <th>Act</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</div>
<!--body wrapper end-->

<!-- MODAL ADD -->
<div class="modal fade" id="modalItem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Form Pengisian Barang</h4>
            </div>
            <div class="modal-body">

            <!--tab nav start-->
            <section class="isolate-tabs">
                <ul class="nav nav-tabs nav-justified">
                    <li class="active">
                        <a data-toggle="tab" href="#general">General</a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#metadata">Metadata</a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#images">Images</a>
                    </li>
                </ul>
                <div class="panel-body">
                    <div class="tab-content">
                        <div id="general" class="tab-pane active">
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label class="control-label col-md-1">Kategori</label>
                                    <div class="col-lg-4">
                                        <select class="form-control select2">
                                            <option></option>
                                                <option value="CT">Connecticut</option>
                                                <option value="DE">Delaware</option>
                                                <option value="FL">Florida</option>
                                                <option value="GA">Georgia</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword1" class="col-lg-1 col-sm-1 control-label">Kode</label>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control" id="inputPassword1" placeholder="Password">
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div id="metadata" class="tab-pane">
                            ini metadata
                        </div>

                        <div id="images" class="tab-pane">
                            ini images
                        </div>
                    </div>
                </div>
            </section>
            <!--tab nav end-->

            <div class="modal-footer">
                <button class="btn btn-success" type="button"> Confirm</button>
                <button data-dismiss="modal" class="btn btn-danger" type="button">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- MODAL ADD -->

<script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/js/datatables/media/js/jquery.js"></script>

<!--select2-->
<script src="<?php echo base_url()?>assets/js/select2.js"></script>
<!--select2 init-->
<script src="<?php echo base_url()?>assets/js/select2-init.js"></script>


<script type="text/javascript">
    function add_item(){
        save_method = 'add';
//        $('#formSize')[0].reset(); // reset form on modals
        $('#modalItem').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Item'); // Set Title to Bootstrap modal title
    }
</script>