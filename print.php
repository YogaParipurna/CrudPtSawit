<?php

require_once "core/init.php";
require_once "view/header.php";

$KTP = $_GET['KTP'];

if (isset($KTP)) {
  $detail = tampilkan_per_ktp($KTP);
  while ($row = mysqli_fetch_assoc($detail)) {
    $KTP_detail         = $row['KTP'];
    $nama_detail        = $row['nama'];
    $tahun_masuk_detail = $row['tahun_masuk'];
    $notelp_detail      = $row['no_telp'];
    $gambar_detail      = $row['gambar'];
  }
}
 ?>
 <div class="container">
   <div class="row">
     <div class="col-sm-6">
       <h1>DETAIL PROFIL KARYAWAN</h1>
     </div>
   </div>
   <hr>
   <div class="row">
     <div class="panel panel-default">
       <div class="panel-heading">
         <div class="text-center">
           <img src="image/<?= $gambar_detail; ?>" class="img_circle">
         </div>
       </div>
       <div class="panel-body">
         <div class="table-responsive">
           <table class="table table-striped" style="font-size:18px">
             <tr>
               <th>NO KTP</th>
               <td>:</td>
               <td><?= $KTP_detail; ?></td>
             </tr>
             <tr>
               <th>Nama</th>
               <td>:</td>
               <td><?= $nama_detail; ?></td>
             </tr>
             <tr>
               <th>No Telepon</th>
               <td>:</td>
               <td><?= $notelp_detail; ?></td>
             </tr>
             <tr>
               <th>Tahun Masuk</th>
               <td>:</td>
               <td><?= $tahun_masuk_detail; ?></td>
             </tr>
             <tr>
               <th>Lama Kerja</th>
               <td>:</td>
               <td><?php $awal = date_create($tahun_masuk_detail);
                                  $akhir = date_create();
                                  $diff = date_diff($awal, $akhir);
                                  echo $diff->y . ' tahun '; 
                                  ?>
              </td>
             </tr>
           </table>
         </div>
       </div>
     </div>
   </div>
 </div>

 <?php
 require_once "view/footer.php";

  ?>
