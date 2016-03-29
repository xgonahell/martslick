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
            <li><a href="#">Purchase Order</a></li>
            <li class="active"> New</li>
        </ol>
    </div>
</div>
<!-- page head end-->

<!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <div class="table-responsive">
                    <header class="panel-heading">
                        Cart
                    </header>
                    <div class="panel-body">
                        <div class="panel">

                            <form class="form-inline" id="formAddtoCart" method="post" action="<?php echo base_url(); ?>po/addToCart">
                                <div class="form-group input-group col-md-1">
                                    <input type="text" class="form-control" name="poId" id="poId" placeholder="ID">
                                </div>
                                <div class="form-group">
                                    <select class="form-controlcustom select2 input-block" name="poMerkBarang" id="poMerkBarang" placeholder="--- Merk Barang ---">
                                        <option></option>
                                        <?php
                                            if(isset($merk)){
                                            foreach($merk as $row){
                                        ?>
                                        <option value="<?php echo $row->barmerk_id ?>"><?php echo $row->barmerk_nama ?></option>
                                        <?php } } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <select class="form-control select2" name="poKategoriBarang" id="poKategoriBarang" placeholder="--- Kategori Barang ---">
                                        <option></option>
                                        <?php
                                            if(isset($kategori)){
                                                foreach($kategori as $row){
                                        ?>
                                        <option value="<?php echo $row->bargori_id ?>"><?php echo $row->bargori_nama ?></option>
                                        <?php } } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <input id="poQuantity"
                                       type="text"
                                       placeholder="Quantity"
                                       value=""
                                       name="poQuantity"
                                       data-bts-min="1"
                                       data-bts-max="100"
                                       data-bts-init-val=""
                                       data-bts-step="1"
                                       data-bts-decimal="0"
                                       data-bts-step-interval="100"
                                       data-bts-force-step-divisibility="round"
                                       data-bts-step-interval-delay="500"
                                       data-bts-prefix=""
                                       data-bts-postfix=""
                                       data-bts-prefix-extra-class=""
                                       data-bts-postfix-extra-class=""
                                       data-bts-booster="true"
                                       data-bts-boostat="10"
                                       data-bts-max-boosted-step="false"
                                       data-bts-mousewheel="true"
                                       data-bts-button-down-class="btn btn-default"
                                       data-bts-button-up-class="btn btn-default"/>
                                </div>
                                
                                <div class="form-group">
                                    <input type="text" class="form-control" style="text-align:right;" name="poHargaBarang" id="poHargaBarang" placeholder="Harga Barang /pcs">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-success"><i class="fa fa-shopping-cart"></i> Add to cart</button>
                                </div>
                            </form>
                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">Merk</th>
                                <th class="text-center">Kategori</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-right">Harga</th>
                                <th class="text-right">Sub Total</th>
                                <th class="text-center">Act</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; $no=1; $total = 0;?>
                            <?php foreach($this->cart->contents() as $items): ?>
                            <?php echo form_hidden('rowid[]', $items['rowid']); ?>
                            <?php $total=$total+$items['price'] * $items['qty']; ?>
                            <tr class="gradeX">
                                <td><?php echo $items['id']; ?></td>
                                <td class="text-center"><?php echo $items['options']['merk']; ?></td>
                                <td class="text-center"><?php echo $items['name']; ?></td>
                                <td class="text-center"><?php echo $items['qty']; ?></td>
                                <td class="text-right"><?php echo currency_format($items['price']);  ?></td>
                                <td class="text-right">
                                    <?php echo currency_format($items['subtotal']); ?>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-xs btn-danger" href="<?php echo base_url(); ?>po/delFromCart/<?php echo $items['rowid'] ?>" class="delbutton" data-hover="tooltip" data-placement="right" title="Hapus"
                                        id="<?php echo $items['rowid'] ?>">
                                        <span class="fa fa-trash-o"></span></a>
                                </td>
                            </tr>
                            <?php $i++; $no++; ?>
                            <?php endforeach; ?>
                            <tr>
                                <th colspan="5" class="text-right">TOTAL PEMBAYARAN</th>
                                <th class="text-right"><?php echo currency_format($total); ?></th>
                                <th></th>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
            <header class="panel-heading">
                Detail
                <span class="tools pull-right">
                    <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                </span>
            </header>
            <div class="panel-body">
                <form class="form-horizontal" id="formPO" method="post" action="<?php echo site_url('po/fromCarttoDB') ?>">
                    <div class="form-group">
                        <label for="poheadTanggal" class="col-md-1 control-label">Tanggal </label>
                        <div class="col-lg-3">
                            <input type="text" name="poheadTanggal" class="form-control" id="poheadTanggal" value="<?php echo $timestamp ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="poheadInvoice" class="col-md-1 control-label">Invoice </label>
                        <div class="col-lg-3">
                            <input type="text" name="poheadInvoice" class="form-control" id="poheadInvoice" value="<?php echo $lastCode ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-1">Supplier</label>
                        <div class="col-lg-2">
                            <select class="form-control select2" name="poheadSupplier" id="poheadSupplier">
                                <option value=""></option>
                                <?php
                                    if(isset($list_supplier)){
                                    foreach($list_supplier as $row){
                                ?>
                                <option value="<?php echo $row->supplier_kode ?>"><?php echo $row->supplier_nama ?></option>
                                <?php } } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-1">Status PO</label>
                        <div class="col-lg-2">
                            <select class="form-control" name="poheadStatus" id="poheadStatus">
                                <option value=""></option>
                                <option value="1">Cash</option>
                                <option value="2">Kredit</option>
                            </select>
                        </div>
                    </div>

                    <input class="form-control" type="hidden" name="poTotalBayar" id="poTotalBayar" value="<?php echo $total; ?>">
                    <input class="form-control" type="hidden" name="poheadOperator" id="poheadOperator" value="<?php echo $creator; ?>">

                    <div class="form-group">
                        <label for="poheadInvoice" class="col-md-1 control-label"></label>
                        <div class="col-lg-2">
                        <button type="submit" class="btn btn-block btn-success"><i class="fa fa-shopping-cart"></i> Save</button>
                        </div>
                    </div>
                </form>
            </div>
            </section>
        </div>
    </div>
</div>
<!--body wrapper end-->

<script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/js/datatables/media/js/jquery.js"></script>

<!--select2-->
<script src="<?php echo base_url()?>assets/js/select2.js"></script>
<!--select2 init-->
<script src="<?php echo base_url()?>assets/js/select2-init.js"></script>

<!--touchspin spinner-->
<script src="<?php echo base_url()?>assets/js/touchspin.js"></script>

<!--spinner init-->
<script src="<?php echo base_url()?>assets/js/spinner-init.js"></script>

<script type="text/javascript">
    $(document).ready(function(){

    $("select[name='barangKategori']").click(function(){
        $("input[name='barangKode']").val( $(barangKategori).val() );
    });

    });
</script>