<?php

function tampilkan(){

	$query  = "SELECT * FROM data_karyawan";
	return result($query);
}

function tampilkan_per_ktp($KTP){

	$query  = "SELECT * FROM data_karyawan WHERE KTP='$KTP'";
	return result($query);
}

function tampil_urut(){
	$query = "SELECT * FROM data_karyawan ORDER BY nama ASC";
	return result($query);
}

function cari_nama($cari){
	$query = "SELECT * FROM data_karyawan WHERE nama LIKE '%$cari%'";
	return result($query);
}

function result($query){
	global $link;

	if ($result = mysqli_query($link, $query) or die('gagal menampilkan data')) {

		return $result;

	}

}

function tambah_data($KTP, $nama,$notelp, $tahun_masuk, $gambar){
  $KTP = escape($KTP);
  $nama = escape($nama);
  $notelp = escape($notelp);
  $tahun_masuk = escape($tahun_masuk);
  $gambar = escape($gambar);



  $query = "INSERT INTO data_karyawan (KTP, nama, no_telp, tahun_masuk, gambar) VALUES
            ('$KTP','$nama','$notelp','$tahun_masuk','$gambar')";
  return run($query);
}

function edit_data($KTP, $nama, $notelp, $tahun_masuk, $gambar){
  $query = "UPDATE data_karyawan SET nama='$nama',no_telp='$notelp', tahun_masuk='$tahun_masuk', gambar='$gambar'
            WHERE KTP='$KTP';";
  return run($query);
}

function edit_tanpa_gambar($KTP, $nama, $notelp, $tahun_masuk){
  $query = "UPDATE data_karyawan SET nama='$nama', no_telp='$notelp', tahun_masuk='$tahun_masuk' 
            WHERE KTP='$KTP';";
  return run($query);
}

function hapus_data($KTP){
  $query = "DELETE FROM data_karyawan WHERE KTP='$KTP';";
  return run($query);
}

function run($query){
	global $link;

	if (mysqli_query($link, $query)) return true;
	else return false;
}

function escape($data){
	global $link;
	return mysqli_real_escape_string($link, $data);
}
 ?>
