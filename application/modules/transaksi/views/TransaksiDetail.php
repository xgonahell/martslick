<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.css' ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/jquery-ui.css' ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
<link rel="stylesheet" href="<?php echo base_url('assets/datatables/dataTables.bootstrap.css') ?>"/>
<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-ui.min.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/validator/bootstrapValidator.js' ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>	
<script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js' ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/custom.css' ?>">

<div class="containter">
	<div class="row-fluid">
		<div class="col-md-8 col-md-offset-2">
			<h4 class="alert alert-info text-center">INVOICE</h4>
			    <dl class="dl-horizontal">
					<dt>No. Invoice :</dt> <dd><?php echo $data_transaksi->transaksi_invoice; ?></dd>
					<dt>Tanggal :</dt> <dd><?php echo date("d M Y", strtotime($data_transaksi->transaksi_date)); ?></dd>
					<dt>Pelanggan :</dt> <dd><?php echo $data_transaksi->transaksi_pelanggan; ?></dd>
					<dt>Pembayaran :</dt> <dd><?php echo $data_transaksi->transaksi_payment; ?></dd>
				</dl>
		        <table class="table table-hover">
		          <thead>
		           <tr>
		             <th>#</th>
		             <th>Kode Barang</th>
		             <th>Jenis</th>
		             <th class="text-center">Size</th>
		             <th class="text-center">Qty</th>
		             <th class="text-center">Harga</th>
		             <th class="text-center">Diskon</th>
		             <th>Subtotal</th>
		           </tr>
		          </thead>
		          <?php
		          	$no=1;
		          	if(isset($data_tradetail)){
		          		foreach($data_tradetail as $row){
		          ?>
		          <tbody>
		          <tr>
		            <td><?php echo $no++ ?></td>
		            <td><?php echo $row->tradetail_barang_kode ?></td>
		            <td><?php echo $row->tradetail_barang_jenis ?></td>
		            <td class="text-center"><?php echo substr($row->tradetail_barang_kode, -1) ?></td>
		            <td class="text-center"><?php echo $row->tradetail_qty_item ?></td>
		            <td class="text-center"><?php echo currency_format($row->tradetail_harga_barang_diskon) ?></td>
		            <td class="text-center"><?php echo $row->tradetail_diskon ?>%</td>
		            <td><?php echo currency_format($row->tradetail_harga_barang_diskon * $row->tradetail_qty_item) ?></td>
		          </tr>
		          <?php } } ?>
		          	<?php if ($data_transaksi->transaksi_payment == 'Cash'){ ?>
			    		<td colspan="7" class="text-right"><strong>Total Pembayaran</strong></td>
			    	<?php }else{ ?>
			    		<td colspan="7" class="text-right"><strong>Total Utang</strong></td>
			    	<?php } ?>
			    		<td><strong><?php echo currency_format($data_transaksi->transaksi_total_bayar) ?></strong></td>
		          </tbody>
		      </table>
		</div>
	</div>

	<div class="row-fluid">
		<div class="col-md-8 col-md-offset-2">
			<small>
				<strong>TOMATO-CLOTHS CENTRO</strong><br />
				Jl. Parakanmuncang No. 199<br />
				Kec. Cimanggung Kab. Sumedang<br />
				(Bypass Bandung Garut KM 27 - Bandung Timur)<br />
				Telp. 022-7783339 / 082126725258<br />
				www.tomato-cloths.com<br />
				Rek. BCA 847 003 8579 a/n Anton Rahardjo<br />
				<br />
				<p>
					*Terima kasih atas kepercayaan Anda<br />
					*Semoga apa yang kita kerjakan selalu dalam keberkahan<br />
					*Barang yang sudah dibeli tidak dapat ditukar
				</p>
			</small>
		</div>
	</div>
</div>