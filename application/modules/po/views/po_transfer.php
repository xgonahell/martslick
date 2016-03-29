<!-- page head start-->
<div class="page-head">
    <h3 class="m-b-less">
        <?php echo $page_title; ?>
    </h3>
    <!--<span class="sub-title">Welcome to Static Table</span>-->
    <div class="state-information">
        <ol class="breadcrumb m-b-less bg-less">
            <li><a href="#">Pengeluaran</a></li>
            <li class="active"> Purchase Order</li>
            <li class="active"> Transfer</li>
        </ol>
    </div>
</div>
<!-- page head end-->

<!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <div class="table">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Kategori</th>
                            <th class="text-center">Merk</th>
                            <th class="text-center">Kode</th>
                            <th class="text-center">Harga PO</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Harga Jual</th>
                        </tr>
                        </thead>
                        <tbody>
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url('po/transferToBarang'); ?>">
                            <?php
                                $no=1;
                                    if(isset($po_item)){
                                    foreach($po_item as $row){
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td>
                                    <input type="text" class="form-control" name="barangKategori[]" id="barangKategori" value="<?php echo $row->bargori_nama ?>">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="barangMerk[]" id="barangMerk" value="<?php echo $row->barmerk_nama ?>">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="barangKode[]" id="barangKode" value="<?php echo $row->bargori_prefix.$po_transfer ?>">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="barangHargaBeli[]" id="barangHargaBeli" value="<?php echo $row->po_detail_price ?>">
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="barangQty[]" id="barangQty" value="<?php echo $row->po_detail_qty ?>">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="barangHargaJual[]" id="barangHargaJual">
                                    <input type="hidden" class="form-control" name="barangCreatedat[]" id="barangCreatedat" value="<?php echo $timestamp ?>">
                                    <input type="hidden" class="form-control" name="barangCreatedby[]" id="barangCreatedby" value="<?php echo $creator ?>">
                                </td>
                            </tr>
                            <?php } } ?>
                            <tr>
                                <td colspan="7">
                                    <button type="submit" class="btn btn-block btn-success"><i class="fa fa-shopping-cart"></i> Transfer</button>
                                </td>
                            </tr>
                        </form>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</div>
<!--body wrapper end-->

<script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/js/datatables/media/js/jquery.js"></script>