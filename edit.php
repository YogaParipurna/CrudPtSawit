<?php

require_once "core/init.php";
require_once "view/header.php";

$error = '';
$KTP = $_GET['KTP'];

if (isset($KTP)) {
  $detail = tampilkan_per_ktp($KTP);
  while ($row = mysqli_fetch_assoc($detail)) {
    $KTP_detail             = $row['KTP'];
    $nama_detail            = $row['nama'];
    $notelp_detail          = $row['no_telp'];
    $tahun_masuk_detail     = $row['tahun_masuk'];
    $gambar_detail          = $row['gambar'];
  }
}

function get_form(){
  global $KTP, $nama, $notelp, $tahunmasuk;
  $KTP          = $_POST['KTP'];
  $nama         = $_POST['nama'];
  $notelp       = $_POST['no_telp'];
  $tahunmasuk   = $_POST['tahun_masuk'];

}

if (isset($_POST['cek_foto'])) {
  get_form();
  $nama_gambar = $_FILES['gambar']['name'];
	$file_gambar = $_FILES['gambar']['tmp_name'];
	$directory	 = "image/$nama_gambar";
	if (move_uploaded_file($file_gambar, $directory)){

    $sql = tampilkan_per_KTP($KTP);
    $data = mysqli_fetch_assoc($sql);
    if(is_file("image/".$data['gambar'])){
      unlink("image/".$data['gambar']);
    }
    if (edit_data($KTP, $nama, $notelp, $tahunmasuk, $nama_gambar,)) {
      header('Location: index.php');
    }else {
      $error = 'Ada Masalah Saat Mengupdate Data';
    }
  } else {
    $error = 'Gagal Update Gambar';
  }
}else if (isset($_POST['update'])) {
  get_form();

  if (edit_tanpa_gambar($KTP, $nama,$notelp,$tahunmasuk )) {
    header('Location: index.php');
  } else {
    $error = 'Ada Masalah Saat Mengupdate Data';
  }
}
 ?>

 <div class="container" style="margin-top:50px; margin-bottom:50px;">
   <div class="row">
     <div class="col-md-6 col-md-offset-3">
       <div class="panel panel-default">
         <div class="panel-heading" style="background-color: #111128; color:white;">
           <h3 class="text-center">Edit Karyawan</h3>
         </div>
         <div class="panel-body">
           <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="KTP">No KTP</label> <br>
              <input type="text" class="form-control" name="KTP" size="37" readonly value="<?= $KTP_detail; ?>"> <br> <br>

             	<label for="nama">Nama Lengkap</label> <br>
             	<input type="text" class="form-control" name="nama" size="37" value="<?= $nama_detail; ?>"> <br> <br>

               <label for="no_telp">No Telepon</label> <br>
             	<input type="text" class="form-control" name="no_telp" size="37" value="<?= $notelp_detail; ?>"> <br> <br>

             	<label for="tahun_masuk">Tahun Masuk</label> <br>
               <input type="date" class="form-control" name="tahun_masuk" style="width: 19em" value="<?= $tahun_masuk_detail; ?>"> <br> <br>

             	<label for="exampleInputFile">Foto Profil</label> <br>
              <input type="checkbox" id="myCheck" class="form-check-input" onclick="myFunction()" name="cek_foto" value="true"> Ceklis jika ingin mengubah foto<br>
                <div id="input-file" style="display:none">
                  <input name="gambar" class="form-control-file" type="file" id="exampleInputFile"> <br> <br>
                </div>

                <script>
                  function myFunction() {
                      var checkBox = document.getElementById("myCheck");
                      var inputFile = document.getElementById("input-file");
                      if (checkBox.checked == true){
                          inputFile.style.display = "block";
                      } else {
                         inputFile.style.display = "none";
                      }
                  }
                </script>
              <div class="text-center" style="margin-top:20px">

                <div id="error"><?= $error  ?></div>

                <input type="submit" class="btn btn-success" name="update" value="Update">
                <a href="index.php"><input type="button" class="btn btn-danger" value="Batal" style="width:200px;"></a>
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
