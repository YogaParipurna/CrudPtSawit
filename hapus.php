<?php

require_once "core/init.php";

$KTP = $_GET['KTP'];

$sql = tampilkan_per_ktp($KTP);
$data = mysqli_fetch_assoc($sql);
if(is_file("image/".$data['gambar'])){
unlink("image/".$data['gambar']);
}
if (isset($_GET['KTP'])) {
	if (hapus_data($_GET['KTP'])) {
		echo "<script> alert ('Artikel Berhasil Dihapus'); document.location='index.php'</script>";
	}else{
		echo "<script> alert ('Artikel Gagal Dihapus'); document.location='tampil.php'</script>";
	}
}

 ?>
