<?php 

$con = new mysqli("localhost","root","","arkademy");

class produk{
	public $koneksi;

	function __construct($con){
		$this->koneksi=$con;
	}

	function selectAllProduk(){
		$query = $this->koneksi->query("SELECT*FROM produk ORDER BY id_produk DESC")or die(mysqli_error($this->koneksi));
		while($item=$query->fetch_assoc()){
			$data[]=$item;
		}
		return $data;
	}

	function addProduk($nama_produk,$keterangan,$harga,$jumlah){
		if ($nama_produk!==''&$keterangan!==''&$harga!=''&$jumlah!=='') {
			$query = $this->koneksi->query("INSERT INTO produk(nama_produk,keterangan,harga,jumlah) VALUES('$nama_produk','$keterangan','$harga','$jumlah')")or die(mysqli_error($this->koneksi));
			return true;
		}else{
			return false;
		}

	}

	function updateProduk($id,$nama_produk,$keterangan,$harga,$jumlah){
		$update = $this->koneksi->query("UPDATE produk SET nama_produk='$nama_produk',keterangan='$keterangan',harga='$harga',jumlah='$jumlah' WHERE id_produk='$id'") or die(mysqli_error($this->koneksi));
		if ($update) {
			return true;
		}else{
			return false;
		}
	}

	function deleteProduk($id){
		$delete=$this->koneksi->query("DELETE FROM produk WHERE id_produk='$id'")  or die(mysqli_error($this->koneksi));
		if ($delete) {
			return true;
		}else{
			return false;
		}
	}
}

$produk = new produk($con);

?>