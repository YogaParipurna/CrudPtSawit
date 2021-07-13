<?php

function cek_data($user, $pass){
	$user = escape($user);
	$pass = escape($pass);

	$query = "SELECT * FROM admin WHERE user='$user' AND pass='$pass'";
	global $link;

	if ($result = mysqli_query($link, $query)) {
		if (mysqli_num_rows($result) != 0) {
			return true;
		}else{
			return false;
		}
	}
}

function tampil_admin(){
  $query = "SELECT user, email, gambar FROM admin";
  global $link;

	if ($result = mysqli_query($link, $query)) {
		if (mysqli_num_rows($result) or die('gagal menampilkan data')) {
			return $result;
	   }
  }
}

 ?>
