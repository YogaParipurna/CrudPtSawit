<?php

require_once "core/init.php";
require_once "view/header.php";

// fungsi Paging
$halaman = 6;
$page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
$mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
$result = tampilkan();
$total = mysqli_num_rows($result);
$pages = ceil($total/$halaman);
$query = mysqli_query($link,"SELECT * FROM data_karyawan LIMIT $mulai, $halaman")or die(mysql_error);

function rupiah($nilai, $pecahan = 0) {
    return number_format($nilai, $pecahan, ',', '.');
}

if (isset($_GET['cari'])) {
	$list_karyawan = cari_nama($_GET['cari']);
}
session_start();
if($_SESSION['status'] !="login"){
	header("location:login_admin.php");
}

 ?>
  <div class="container-fluid" style="margin:10px;">
      <div class="row">
        <div class="col-md-8">
          <h1>Hi, Selamat Datang <?= $_SESSION['user']; ?></h1>
        </div>
      </div>
      <hr>
      <div class="row" style="margin-top:50px;">
          <h4 class="text-center">Data Karyawan PT. SAWIT BAHAGIA 2021</h4>
      </div>

      <div class="row">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <td></td>
              <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>No.KTP</th>
                <th>No Telepon</th>
                <th>Tahun Masuk</th>
                <th>Jumlah Masa Kerja</th>
                <th>Tools</th>
              </tr>
            </thead>
            <?php
              $no = $mulai+1;
              while ($row = mysqli_fetch_assoc($query)) :?>
            <tr>
              <td><?= $no; ?></td>
              <td><a href="detail.php?KTP=<?= $row['KTP']; ?>"><?= $row['nama'];  ?></td>
              <td><?= $row['KTP']; ?></td>
              <td><?= $row['no_telp']; ?></td>
              <td><?= $row['tahun_masuk']; ?></td>
              <td><?php $awal = date_create($row['tahun_masuk']);
                                  $akhir = date_create();
                                  $diff = date_diff($awal, $akhir);
                                  echo $diff->y . ' tahun '; 
                                  ?>
              </td>
              <td><a class="btn btn-info btn-sm" href="detail.php?KTP=<?= $row['KTP']; ?>"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></a>
                  <a class="btn btn-success btn-sm" href="edit.php?KTP=<?= $row['KTP']; ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                  <a class="btn btn-danger btn-sm" onclick="return confirm('Yakin akan menghapus data ini?')" href="hapus.php?KTP=<?= $row['KTP']; ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
              </td>
            </tr>
            <?php
              $no++;
              endwhile; ?>
          </table>
        </div>
        <div class="text-center">
          <ul class="pagination">
            <?php for ($i=1; $i<=$pages ; $i++){ ?>
            <li><a href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php } ?>
          </ul>
        </div>
      </div>
  </div>

<?php
require_once "view/footer.php";

 ?>
