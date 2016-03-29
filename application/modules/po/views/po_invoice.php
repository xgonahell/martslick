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
            <li><a href="#">Pengeluaran</a></li>
            <li><a href="#">Purchase Order</a></li>
            <li class="active"> Invoice</li>
        </ol>
    </div>
</div>
<!-- page head end-->

<!--body wrapper start-->
<div class="wrapper">
    <div class="panel invoice">
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-4">
                    <div class="invoice-logo">
                        <img src="<?php echo base_url() ?>assets/img/invoice-logo.png" alt=""/>
                    </div>
                </div>
                <div class="col-xs-4">
                    <h1>FAKTUR</h1>
                </div>
                <div class="col-xs-4">
                    <div class="total-purchase">
                        Nomor Faktur
                    </div>
                    <div class="amount">
                        <?php echo '#'.$getInvoices->po_invoice ?>
                    </div>
                </div>
            </div>

            <br/>
            <br/>
            <br/>
            <div class="row">
                <div class="col-xs-4">

                    <address>
                        <strong>ALAMAT TOKO</strong>
                        <br>Jl. Raya Kosambi
                        <br>
                        No. 254
                        <br>
                        Blok AB5
                        <br/>
                        P: +622 768 8456
                    </address>
                </div>
                <div class="col-xs-4">
                    <strong>
                        Kepada
                    </strong>
                    <br/><?php echo $getInvoices->supplier_nama ?>
                    <br/><?php echo $getInvoices->supplier_alamat ?>
                    <br/><?php echo $getInvoices->supplier_kota ?>
                    <br/>Tel: <?php echo $getInvoices->supplier_hp ?>
                </div>
                <div class="col-xs-4 inv-info">
                    <strong>DETAIL FAKTUR</strong>
                    <br/> <span> Nomor Faktur</span>  <?php echo '#'.$getInvoices->po_invoice ?>
                    <br/><span> Tanggal Transaksi</span> <?php echo date("d M Y", strtotime($getInvoices->po_createdat)); ?>
                    <br/> <span> Status Faktur</span>  <?php if($getInvoices->po_status=='1'){echo 'Cash';}elseif($getInvoices->po_status=='2'){echo 'Kredit';}else{echo 'Error';} ?>
                </div>
            </div>
            <br/>
            <br/>
            <br/>

            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>MERK</th>
                    <th class="hidden-xs">KATEGORI</th>
                    <th class="text-center">QUANTITY</th>
                    <th class="text-right">HARGA</th>
                    <th class="text-right">SUBTOTAL</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <?php
                        $no=1;
                            if(isset($detailInvoice)){
                            foreach($detailInvoice as $row){
                    ?>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row->barmerk_nama; ?></td>
                    <td><?php echo $row->bargori_nama; ?></td>
                    <td class="text-center"><?php echo $row->po_detail_qty; ?></td>
                    <td class="text-right"><?php echo currency_format($row->po_detail_price); ?></td>
                    <td class="text-right"><?php echo currency_format($row->po_detail_qty * $row->po_detail_price); ?></td>
                </tr>
                    <?php } } ?>
                </tbody>
            </table>
            <br/>
            <br/>

            <div class="row">
                <div class="col-xs-8">
                    <h4><strong>CATATAN</strong></h4>
                    <ul class="list-unstyled">
                        <li>
                            1. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        </li>
                        <li>
                            2. Quisque iaculis sem nec eros placerat congue.
                        </li>
                        <li>
                            3. Donec eget magna sodales, condimentum sapien in, suscipit dui.
                        </li>
                        <li>
                            4. Nullam sed leo ornare dolor sodales tempus.
                        </li>
                    </ul>
                </div>
                <div class="col-xs-4">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <td>
                                <strong>TOTAL PEMBAYARAN</strong>
                            </td>
                            <td class="text-right"><strong><?php echo 'Rp. '.currency_format($getInvoices->po_total_bayar); ?></strong></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <br/>
            <br/>
            <br/>
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-right">
                        <a href="#" class="btn btn-success">Cetak Faktur</a>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<!--body wrapper end-->

<script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/js/datatables/media/js/jquery.js"></script>

<!--select2-->
<script src="<?php echo base_url()?>assets/js/select2.js"></script>
<!--select2 init-->
<script src="<?php echo base_url()?>assets/js/select2-init.js"></script>


<script type="text/javascript">
    function add_item(){
        save_method = 'add';
//        $('#formSize')[0].reset(); // reset form on modals
        $('#modalPO').modal('show'); // show bootstrap modal
        $('.modal-title').text('New Purchase Order'); // Set Title to Bootstrap modal title
    }
</script>