

<!DOCTYPE html>
<html>
<head>
	<title> Dashboard </title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="container" style="margin-top: 80px">
	<div class="row">
		<div class="col-md-3">
			<div class="list-group">
			  <a href="#" class="list-group-item active" style="text-align: center;background-color: black;border-color: black">
			    ADMINISTRATOR
			  </a>
			  <a href="<?php echo base_url() ?>dashboard" class="list-group-item"><i class="fa fa-dashboard"></i> Dashboard</a>
			  <a href="<?php echo base_url() ?>barang" class="list-group-item"><i class="fa fa-book"></i> Barang</a>
			  <a href="<?php echo base_url() ?>pelanggan" class="list-group-item"><i class="fa fa-folder"></i> Pelanggan</a>
			  <a href="<?php echo base_url() ?>penjualan" class="list-group-item"><i class="fa fa-comments-o"></i> Komentar</a>
			  <a href="<?php echo base_url() ?>dashboard/logout" class="list-group-item"><i class="fa fa-sign-out"></i> Logout</a>
			</div>
		</div>
		<div class="col-md-9">
			<div class="panel panel-default">
			  <div class="panel-heading">
			    <h3 class="panel-title"><i class="fa fa-book"></i> <?php echo $title ?></h3>
			  </div>
			  <div class="panel-body">

		<div class="col-md-12">
			<?php echo form_open('penjualan/update') ?>
			  
			  <div class="form-group">
			    <label for="text">No. Transaksi</label>
			    <input type="text" name="no_transaksi" value="<?php echo $data_penjualan->no_transaksi ?>" class="form-control" placeholder="No. Transaksi" readonly>
			    <input type="hidden" value="<?php echo $data_penjualan->id_pesanan_penjualan ?>" name="id_pesanan_penjualan">
			  </div>

			  <div class="form-group">
			    <label for="text">Tanggal Penjualan</label>
			    <input type="date" name="tgl_penjualan" class="form-control" value="<?php echo $data_penjualan->tgl_penjualan ?>" readonly>
			  </div>

			  <div class="form-group">
			    <label for="text">Nama Pelanggan</label>
			    <input type="text" name="nama_pelanggan" value="<?php echo $data_penjualan->nama_pelanggan ?>" class="form-control" readonly>
			  </div>

			  <div class="form-group">
			    <label for="text">Total</label>
			    <input type="text" name="total" value="<?php echo $data_penjualan->total ?>" class="form-control" readonly>
			  </div>
			  
			<?php echo form_close() ?>

		<!-- table -->
		<div class="table-responsive">
			<table id="table" class="table table-striped table-bordered table-hover">
			    <thead>
			      <tr>
			        <th>No.</th>
			        <th>Barang</th>
			        <th>Qty</th>
			        <th>Harga Jual</th>
			        <th>Sub Total</th>
			      </tr>
			    </thead>
			    <tbody>

			    <?php
			    	$no = 1; 
			    	foreach($penjualan as $hasil){ 
			    ?>
			      
			      <tr>
			        <td><?php echo $no++ ?></td>
			        <td><?php echo $hasil->nama_barang ?></td>
			        <td><?php echo $hasil->qty ?></td>
			        <td><?php echo $hasil->harga_jual ?></td>
			        <td><?php echo $hasil->sub_total ?></td>
			      </tr>

			    <?php } ?>

			    </tbody>
			  </table>
		</div>
		</div>

			  </div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script>
	$('#table').DataTable( {
    autoFill: true
} );
</script>
</body>
</html>