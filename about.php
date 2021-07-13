<?php

require_once "core/init.php";
require_once "view/header.php";

$tentang = tampil_admin();
while ($row = mysqli_fetch_assoc($tentang)) {
  $nama_user   = $row['user'];
  $email_user  = $row['email'];
  $gambar_user = $row['gambar'];
}
 ?>
 <div class="container">
   <div class="row">
     <div class="col-sm-6">
       <h1>Tentang Admin</h1>
     </div>
   </div>
   <hr>
   <div class="row">
       <div class="panel panel-default" style="margin-bottom:50px">
         <div class="panel-heading">
           <div class="text-center">
             <img src="image/<?= $gambar_user; ?>" class="img_circle">
           </div>
         </div>
         <div class="panel-body">
           <div class="text-center">
             <h2><?= $nama_user; ?></h2>
           </div>
           <div class="text-center" style="color:blue;">
             <h4><u><em><?= $email_user; ?></em></u></h4>
           </div>
         </div>
       </div>
   </div>
 </div>

 <?php
 require_once "view/footer.php";

  ?>
