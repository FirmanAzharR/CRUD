<?php include 'class.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>CRUD dengan PHP</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<h1 class="text-secondary" style="text-align: center; margin-top: 30px">CRUD dengan PHP</h1>
		<hr>
		<button type="button" id="add" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Tambah Produk</button>
		<hr>
		<table class="table table-bordered table-striped">
			<thead class="bg-light" align="center">
				<tr>
					<th>No</th>
					<th>Nama Produk</th>
					<th>Keterangan</th>
					<th>Harga</th>
					<th>Jumlah</th>
					<th>Opsi</th>
				</tr>
			</thead>
			<tbody>
				<?php $allproduk = $produk->selectAllProduk(); ?>
				<?php foreach ($allproduk as $key => $value): ?>
					<tr align="center" id="<?php echo $value['id_produk'] ?>">
						<td><?php echo $key+1 ?></td>
						<td data-target="namaproduk"><?php echo $value['nama_produk'] ?></td>
						<td data-target="keterangan"><?php echo $value['keterangan'] ?></td>
						<td data-target="harga"><?php echo $value['harga'] ?></td>
						<td data-target="jumlah"><?php echo $value['jumlah'] ?></td>
						<td>
							<button data-role="edit" data-id="<?php echo $value['id_produk'] ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i>&nbsp;Edit</button>
							<button data-role="delete" data-id="<?php echo $value['id_produk'] ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;Delete</button>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="addProduk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Add Produk</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="post">
						<input type="hidden" id="idproduk" name="idproduk">
						<input class="form-control" type="text" name="nama" id="nama" placeholder="Nama Produk"><br>
						<input class="form-control" type="text" name="ket" id="ket" placeholder="Keterangan"><br>
						<input class="form-control" type="number" name="jml" id="jml" placeholder="Jumlah"><br>
						<input class="form-control" type="number" name="hrg" id="hrg" placeholder="Harga">
						<hr>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" name="simpan"id="simpan" class="btn btn-primary">Simpan</button>
						<?php 
						if(isset($_POST['simpan'])){

							$add=$produk->addProduk($_POST['nama'],$_POST['ket'],$_POST['hrg'],$_POST['jml']);
							if($add!=false){
								echo "<meta http-equiv='refresh' content='0'>";
							}else{
								echo "<script>alert('input kosong')</script>";
							}
						}

						if(isset($_POST['update'])){

							$update=$produk->updateProduk($_POST['idproduk'],$_POST['nama'],$_POST['ket'],$_POST['hrg'],$_POST['jml']);
							if($update!=false){
								echo "<meta http-equiv='refresh' content='0'>";
							}else{
								echo "<script>alert('gagal update')</script>";
							}
						}
						?>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="modal" id="delete-modal">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-body">
					<h5 align="center" id="delete-name"></h5>
					<hr>
					<center>
						<form method="post">
							<input type="hidden" id="deleteid" name="deleteid">
							<button type="submit" name="hapus" id="hapus" class="btn btn-danger">Hapus</button>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
						</form>
						<?php 
						if(isset($_POST['hapus'])){

							$delete=$produk->deleteProduk($_POST['deleteid']);
							if($delete!=false){
								echo "<meta http-equiv='refresh' content='0'>";
							}else{
								echo "<script>alert('gagal delete')</script>";
							}
						}
						?>
					</center>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$("input").attr('autocomplete', 'off');

		$(document).on('click','button[data-role=edit]',function(){
			var id = $(this).data('id');
			var namaproduk = $("#"+id).children('td[data-target=namaproduk]').text();
			var keterangan = $("#"+id).children('td[data-target=keterangan]').text();
			var harga = $("#"+id).children('td[data-target=harga]').text();
			var jumlah = $("#"+id).children('td[data-target=jumlah]').text();
			$('#idproduk').val(id);
			$('#nama').val(namaproduk);
			$('#ket').val(keterangan);
			$('#hrg').val(harga);
			$('#jml').val(jumlah);
			$("#simpan").attr("name", "update");
			$("h5").text("Edit Produk");
			$("#addProduk").modal('toggle');
		});

		$('#add').click(function(){
			$('#idproduk').val('');
			$('#nama').val('');
			$('#ket').val('');
			$('#hrg').val('');
			$('#jml').val('');
			$("#simpan").attr("name", "simpan");
			$("h5").text("Add Produk");
			$("#addProduk").modal('toggle');
		});

		$(document).on('click','button[data-role=delete]',function(){
			var id = $(this).data('id');
			var namaproduk = $("#"+id).children('td[data-target=namaproduk]').text();
			$('#deleteid').val(id);
			$('#delete-name').text("Hapus Produk "+namaproduk+" ini?");
			$("#delete-modal").modal('toggle');
		});
	</script>
</body>
</html>

<?php 
function rupiah($angka){
	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	return $hasil_rupiah;
}
?>