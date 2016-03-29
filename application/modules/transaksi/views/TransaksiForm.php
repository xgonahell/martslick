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
            <li><a href="#">Transaksi</a></li>
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

                            <form class="form-inline" id="formTransaksiAddToCart" method="post" action="<?php echo base_url(); ?>transaksi/TransaksiAddToCart">
                                    <div class="col-md-1"></div>
                                <div class="form-group col-md-2">
                                    <input type="text" name="transaksiBarang" id="transaksiBarang" class="form-control" />
                                </div>

                                <div class="form-group col-md-2">
                                    <input type="text" name="transaksiKategoriBarang" id="transaksiKategoriBarang" class="form-control" />
                                </div>


                                <div class="form-group col-md-2">
                                    <input id="transaksiQty"
                                       type="text"
                                       placeholder="--- Quantity ---"
                                       value=""
                                       name="transaksiQty"
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
                                
                                <div class="form-group input-group col-md-5 pull left">
                                    <input type="text" class="form-control" name="transaksiHarga" id="transaksiHarga" placeholder="Harga Barang /pcs">
                                    <div class="input-group-btn"><button type="submit" class="btn btn-success">Add to Cart</button></div>
                                </div>
                            </form>
                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="col-md-1">#</th>
                                <th class="col-md-2">Barang</th>
                                <th class="col-md-2">Kategori</th>
                                <th class="col-md-2">Quantity</th>
                                <th class="col-md-2">Harga</th>
                                <th class="col-md-2">Sub Total</th>
                                <th class="col-md-1">Act</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; $no=1; $total = 0;?>
                            <?php foreach($this->cart->contents() as $transaksi): ?>
                            <?php echo form_hidden('rowid[]', $transaksi['rowid']); ?>
                            <?php $total=$total+$transaksi['subtotal']; ?>
                            <tr class="gradeX">
                                <td><?php echo $no; ?></td>
                                <td><?php echo $transaksi['id']; ?></td>
                                <td><?php echo $transaksi['name']; ?></td>
                                <td><?php echo $transaksi['qty']; ?></td>
                                <td><?php echo $transaksi['price'];  ?></td>
                                <td>
                                    <?php echo currency_format($transaksi['subtotal']); ?>
                                </td>
                                <td>
                                    <a class="btn btn-xs btn-danger btn-block" href="<?php echo base_url(); ?>transaksi/delFromCart/<?php echo $transaksi['rowid'] ?>" class="delbutton" data-hover="tooltip" data-placement="right" title="Hapus"
                                        id="<?php echo $transaksi['rowid'] ?>">
                                        <span class="glyphicon glyphicon-trash"></span></a>
                                </td>
                            </tr>
                            </tbody>
                            <?php $i++; $no++; ?>
                            <?php endforeach; ?>
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
                <form class="form-horizontal" id="formAddTransaksi" method="post" action="<?php echo site_url(); ?>transaksi/InsertTransaksi">
                        <div class="form-group">
                            <label for="transaksiPayment" class="col-md-1 control-label">Payment</label>
                            <div class="col-lg-3">
                                <select class="form-control select2" name="transaksiPayment" id="transaksiPayment">
                                    <option value=""></option>
                                    <option value="Cash">Cash</option>
                                    <option value="Utang">Utang</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="transaksiDate" class="col-md-1 control-label">Tanggal </label>
                            <div class="col-lg-3">
                                <input type="text" name="transaksiDate" class="form-control" id="transaksiDate" value="<?php echo $timestamp ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="transaksiInvoice" class="col-md-1 control-label">Invoice </label>
                            <div class="col-lg-3">
                                <input type="text" name="transaksiInvoice" id="transaksiInvoice" value="<?php echo $transaksiInvoice ?>" class="form-control" aria-describedby="basic-addon1" readonly />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="transaksiPelanggan" class="col-md-1 control-label">Nama Pelanggan</label>
                            <div class="col-lg-3">
                                <input type="text" class="form-control" name="transaksiPelanggan" id="transaksiPelanggan">
                            </div>                       
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1">No Handphone</label>
                            <div class="col-lg-3">
                                <input type="text" class="form-control select2" name="transaksiHpPelanggan" id="transaksiHpPelanggan">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1">Total Pembayaran</label>
                            <div class="col-lg-3">
                                <input type="text" class="form-control" value="<?php echo $this->cart->format_number($total); ?>" name="transaksiTotalBayarDisplay" id="transaksiTotalBayarDisplay" aria-describedby="basic-addon1" readonly />
                            </div>
                        </div>

                        <input type="hidden" class="form-control" value="<?php echo $total; ?>" name="transaksiTotalBayar" id="transaksiTotalBayar" aria-describedby="basic-addon1" />

                        <input class="form-control" type="hidden" name="transaksiCreator" id="transaksiCreator" value="<?php echo $creator; ?>">
                        <input class="form-control" type="hidden" name="transaksiTimestamp" id="transaksiTimestamp" value="<?php echo $timestamp; ?>">

                        <div class="col-lg-offset-1 col-lg-10">
                            <button type="submit" id="simpan" class="btn btn-success">Simpan</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
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

    $(document).ready(function(){

    $("body").tooltip({ selector: '[data-toggle=tooltip]' });
    $("[data-hover='tooltip']").tooltip();

    $(function (){
        $("#lookup").dataTable();
    });

    $(document).on('click', '.pilih', function (e){
        if ($(this).attr('data-totalqty') == 0){
            alert("Quantity barang tidak mencukupi!");
        }else{
        document.getElementById("transaksiBarang").value = $(this).attr('data-kodebarang');
        document.getElementById("transaksiType").value = $(this).attr('data-jenisbarang');
        document.getElementById("transaksiHarga").value = $(this).attr('data-hargabarang');
        document.getElementById("transaksiQty_rep").value = $(this).attr('data-totalqty');
        }
    });

    $(document).on('click', '.pilih-pelanggan', function (e){
        document.getElementById("transaksiPelanggan").value = $(this).attr('data-kodepelanggan');
        document.getElementById("transaksiHpPelanggan").value = $(this).attr('nope-pelanggan');
        $('#modalCariPelanggan').modal('hide');
    });

    $(document).on('submit', '#formTransaksiAddtoCart', function (e){
        var qty = parseInt($("#transaksiQty").val());
        var qty_stok = parseInt($("#transaksiQty_rep").val());

        if(qty > qty_stok){
            e.preventDefault();
            alert("Jumlah yang anda masukkan melebihi quantity yang tersedia");
        }

        var ambil = document.forms["formTransaksiAddtoCart"]["transaksiQty"].value;
        if(ambil == null || ambil == "" || ambil == 0 || ambil < 1){
            e.preventDefault();
            alert("Quantity tidak valid");
        }        

/*        var tradiskon = parseInt($("#transaksiDiskon").val());
        if(tradiskon > 30){
            e.preventDefault();
            alert("Maksimal diskon adalah 30%. Silahkan masukkan kembali");
        }*/
    });

    
    <!-- =========================================== CREATE VALIDATOR =========================================== -->
    $('#formAddTransaksi').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            transaksiInvoice: {
                group: '.col-sm-2',
                validators: {
                    notEmpty: {
                        message: 'tidak boleh kosong'
                    }                    
                }
            },
            transaksiPelanggan: {
                group: '.col-sm-2',
                validators: {
                    notEmpty: {
                        message: 'tidak boleh kosong'
                    }
                }
            },
            transaksiHpPelanggan: {
                group: '.col-sm-2',
                validators: {
                    notEmpty: {
                        message: 'tidak boleh kosong'
                    },
                    numeric: {
                        message: 'harus berisi angka'
                    },
                    stringLength: {
                        min: 11,
                        message: 'Nomor tidak valid'
                    }
                }
            },
            transaksiPayment: {
                group: '.col-sm-2',
                validators: {
                    notEmpty: {
                        message: 'tidak boleh kosong'
                    }
                }
            },
            transaksiTotalBayarDisplay: {
                group: '.col-sm-2',
                validators: {
                    notEmpty: {
                        message: 'tidak boleh kosong'
                    }
                }
            }
        }
    });
    $('#reset').click(function() {
        $('#formAddTransaksi').data('bootstrapValidator').resetForm(true);
    });
    <!-- =========================================== CREATE VALIDATOR =========================================== -->
});

</script>