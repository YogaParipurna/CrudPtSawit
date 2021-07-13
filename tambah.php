<?php

require_once "core/init.php";
require_once "view/header.php";

$error = '';
// membuat query max
$carikode = mysqli_query($link, "SELECT max(ktp) FROM data_karyawan") or die (mysqli_error());

// menjadikannya array
$datakode = mysqli_fetch_array($carikode);



if (isset($_POST['submit'])) {
  $KTP         = $_POST['ktp'];
  $nama        = $_POST['nama'];
  $notelp      = $_POST['no_telp'];
  $tahun_masuk = $_POST['tahun_masuk'];
  $nama_gambar = $_FILES['gambar']['name'];
	$file_gambar = $_FILES['gambar']['tmp_name'];
	$directory	 = "image/$nama_gambar";
	move_uploaded_file($file_gambar, $directory);

  if (tambah_data($KTP, $nama, $notelp, $tahun_masuk, $nama_gambar)) {
    header('Location: index.php');
  }else {
    $error = 'Ada Masalah Saat Menambahkan Data';
  }
}
 ?>

 <div class="container" style="margin-top:50px; margin-bottom:50px;">
   <div class="row">
     <div class="col-md-6 col-md-offset-3">
       <div class="panel panel-default">
         <div class="panel-heading" style="background-color: #111128; color:white;">
           <h3 class="text-center">Tambah Karyawan</h3>
         </div>
         <div class="panel-body">
           <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="ktp">Nomer KTP</label> <br>
              <input type="text" class="form-control" name="ktp" size="37" value=""> <br> <br>

             	<label for="nama">Nama Lengkap</label> <br>
             	<input type="text" class="form-control" name="nama" size="37" value=""> <br> <br>

               <label for="no_telp">No Telepon</label> <br>
             	<input type="text" class="form-control" name="no_telp" size="37" value=""> <br> <br>

             	<label for="tahun_masuk">Tahun Masuk</label> <br>
             	<input type="date" name="tahun_masuk" class="form-control" required><br> <br>

             	<label for="exampleInputFile">Foto Profil</label> <br>
             	<input name="gambar" class="form-control-file" type="file" id="exampleInputFile"> <br> <br>

              <div id="error"><?= $error  ?></div>

              <div class="text-center">
                <input type="submit" class="btn btn-default" name="submit" value="Submit">
              </div>
            </div>
           </form>
         </div>
       </div>
     </div>
   </div>
 </div>

 <?php
 require_once "view/footer.php";

  ?>
