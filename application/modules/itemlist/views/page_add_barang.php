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
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Barang</a></li>
            <li class="active"> Data Barang</li>
        </ol>
    </div>
</div>
<!-- page head end-->

<!--body wrapper start-->
<div class="wrapper">
    <!--tab nav start-->
    <section class="isolate-tabs">
        <ul class="nav nav-tabs">
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
                    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url('itemlist/add') ?>" >
                        <div class="form-group">
                            <label class="control-label col-md-1">Kategori</label>
                            <div class="col-lg-3">
                                <select class="form-control select2" name="barangKategori" id="barangKategori">
                                    <option></option>
                                    <?php
                                        if(isset($kategori)){
                                        foreach($kategori as $row){
                                    ?>
                                        <option value="<?php echo $row->bargori_prefix.$lastCode ?>"><?php echo $row->bargori_nama ?></option>
                                    <?php } } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="barangKode" class="col-lg-1 col-sm-1 control-label">Kode</label>
                            <div class="col-lg-3">
                                <input type="text" class="form-control" name="barangKode" id="barangKode">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="barangDeskripsi" class="col-lg-1 col-sm-1 control-label">Deskripsi</label>
                            <div class="col-lg-3">
                                <textarea name="barangDeskripsi" id="barangDeskripsi" class="form-control" id="" cols="30" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="barangQty" class="col-lg-1 col-sm-1 control-label">Quantity</label>
                            <div class="col-lg-2">
                                <input type="number" class="form-control" name="barangQty" id="barangQty" value="1">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="barangHargaBeli" class="col-lg-1 col-sm-1 control-label">Harga Beli</label>
                            <div class="col-lg-2">
                                <input type="text" class="form-control" name="barangHargaBeli" id="barangHargaBeli">
                            </div>
                            <label class="col-lg-0 col-sm-0 control-label">Masukkan harga /pcs</label>
                        </div>
                        <div class="form-group">
                            <label for="barangHargaJual" class="col-lg-1 col-sm-1 control-label">Harga Jual</label>
                            <div class="col-lg-2">
                                <input type="text" class="form-control" name="barangHargaJual" id="barangHargaJual">
                            </div>
                            <label class="col-lg-0 col-sm-0 control-label">Masukkan harga /pcs</label>
                        </div>
                        <input type="hidden" class="form-control" name="barangCreator" id="barangCreator" value="<?php echo $creator; ?>">
                        <input type="hidden" class="form-control" name="barangTimestamp" id="barangTimestamp" value="<?php echo $timestamp; ?>">
                        <div class="form-group">
                            <div class="col-lg-offset-1 col-lg-10">
                                <button type="submit" class="btn btn-primary">Simpan</button>
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
</div>

<script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/js/datatables/media/js/jquery.js"></script>

<!--select2-->
<script src="<?php echo base_url()?>assets/js/select2.js"></script>
<!--select2 init-->
<script src="<?php echo base_url()?>assets/js/select2-init.js"></script>

<script type="text/javascript">
    $(document).ready(function(){

    $("select[name='barangKategori']").click(function(){
        $("input[name='barangKode']").val( $(barangKategori).val() );
    });

    });
</script>