

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
			<?php echo form_open('penjualan/simpan') ?>
			  
			  <div class="form-group">
			    <label for="text">No. Transaksi</label>
			    <input type="text" name="no_transaksi" class="form-control" placeholder="No. Transaksi" readonly value="<?php echo $no_transaksi ?>">
			  </div>

			  <div class="form-group">
			    <label for="text">Tanggal Penjualan</label>
			    <input type="date" name="tgl_penjualan" class="form-control" >
			  </div>

			  <div class="form-group">
			    <label for="text">Nama Pelanggan</label>
			    <select class="form-control" name="id_pelanggan" id="id_pelanggan">
                        <option value="" selected="selected">--Nama pelanggan--</option>
                        <?php
                          $data =  $this->db->select("*")->from('tbl_pelanggan')->order_by('id_pelanggan', 'DESC')->get();
                          foreach($data->result() as $dt){
                        ?>
                         <option value="<?php echo $dt->id_pelanggan;?>"><?php echo $dt->nama_pelanggan;?></option>
                        <?php
                          }
                        ?>
                       </select>
			  </div>

			  <div class="form-group">
			    <label for="text">Total</label>
			    <input type="text" name="total" id="total" value="0" class="form-control" placeholder="Total Transaksi" readonly>
			  </div>
			  <button type="button" class="btn btn-md btn-info" data-toggle="modal" data-target="#myModal">Tambah Barang</button><br>

		<!-- table -->
		<div class="table-responsive">
			<table id="table" class="table table-striped table-bordered table-hover">
			    <thead>
			      <tr>
			        <th>Nama Barang</th>
			        <th>Qty</th>
			        <th>Harga Jual</th>
			        <th>Sub Total</th>
			        <th>Options</th>
			      </tr>
			    </thead>
			    <tbody id="table_barang">


			    </tbody>
			  </table>
		</div>
			  <button type="submit" class="btn btn-md btn-success">Simpan</button>
			  <button type="reset" class="btn btn-md btn-warning">Reset</button>
			<?php echo form_close() ?>
		</div>

			  </div>
			</div>
		</div>
	</div>
</div>
<div id="myModal" name="myModal" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Modal Header</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">


			  <div class="form-group">
			    <label for="text">Nama Barang</label>
			    <select class="form-control" name="id_barang" id="id_barang">
                        <option value="" selected="selected">--Nama Barang--</option>
                        <?php
                          $data =  $this->db->select("*")->from('tbl_barang')->order_by('id_barang', 'DESC')->get();
                          foreach($data->result() as $dt){
                        ?>
                         <option value="<?php echo $dt->id_barang;?>"><?php echo $dt->nama_barang;?></option>
                        <?php
                          }
                        ?>
                       </select>
                       </div>

			  <div class="form-group">
			    <label for="text">Harga Jual</label>
			    <input type="text" name="harga_jual" id="harga_jual" class="form-control" placeholder="Harga Jual" readonly>
			  </div>
			  <div class="form-group">
			    <label for="text">Qty</label>
			    <input type="text" name="qty" id="qty" class="form-control" placeholder="Qty">
			  </div>
			  <div class="form-group">
			    <label for="text">Sub Total</label>
			    <input type="text" name="sub_total" id="sub_total" class="form-control" placeholder="Sub Total" readonly>
			  </div>
			  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" name="simpan_detail" id="simpan_detail" class="btn btn-info" data-dismiss="modal">
            Simpan
        </button>
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
<script type="text/javascript">
	$(document).ready(function(){

  $("#id_barang").change(function(){
    cari_harga_barang();
  });

$("#qty").keyup(function(){
          var qty = $("#qty").val();
          var harga_jual = $("#harga_jual").val();
          var sub_total = harga_jual * qty;

          $('#sub_total').val(sub_total);
        });


	$("#simpan_detail").click(function(){

		var html = '';
		var id_barang=$("#id_barang option:selected").text();
		var v_id_barang=$("#id_barang").val();
    	var qty=$("#qty").val();
		var harga_jual=$("#harga_jual").val();
		var sub_total=$("#sub_total").val();
		 html += '<tr><input type="hidden" name="count_item[]" id="count_item[]"/>';
		 html += '<td class="center" id="id_barang_t">'+id_barang+'<input type="hidden" name="id_barang_t2[]" id="id_barang_t2[]" value="'+v_id_barang+'"/></td>';
     	html += '<td class="center" id="qty_t">'+qty+'<input type="hidden" name="qty_t2[]" id="qty_t2[]" value="'+qty+'"/></td>';
     	html += '<td class="center" id="harga_jual_t">'+harga_jual+'<input type="hidden" name="harga_jual_t2[]" id="harga_jual_t2[]" value="'+harga_jual+'"/></td>';
     	html += '<td class="center" id="sub_total_t">'+sub_total+'<input type="hidden" name="sub_total_t2[]" id="sub_total_t2[]" value="'+sub_total+'"/></td>';
     	html += '<td class="center"><a href="#" class="tooltip-error remove_barang" data-rel="tooltip" name="remove_barang" title="Delete"><span class="red"><i class="icon-trash bigger-120">Hapus</i></span></a></td></tr>';
         var total=$("#total").val();
         var total_baru = parseInt(sub_total) + parseInt(total) ;

		 $("#total").val(total_baru);
		 $('#table_barang').append(html);
		 reset_barang();
		 $("#myModal").modal('hide');
		});

		$(document).on('click', '.remove_barang', function(){

		    
            var total=$("#total").val();
            var sub_total=  $(this).closest('tr').find('td').eq(3).text();
         	var total_baru =parseInt(total)- parseInt(sub_total)  ;

		 	$("#total").val(total_baru);
		    $(this).closest('tr').remove();
	  });


  function reset_barang(){
		$("#id_barang").val('');
    $("#qty").val('');
    $("#harga_jual").val('');
		$("#sub_total").val('');
	}
function cari_harga_barang(){
  var id_barang = $("#id_barang").val();
  $.ajax({
    type  : "GET",
    url   : "<?php echo site_url(); ?>penjualan/harga",
    data  : "id_barang="+id_barang,
    dataType: "json",
    success : function(data){
        $('#harga_jual').val(data.harga_jual);
    }
  });
}

	});

</script>
</body>
</html>