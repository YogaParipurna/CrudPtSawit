<?php

require_once "core/init.php";
require_once "view/header_admin.php";

$error = '';

if (isset($_POST['submit'])) {
	$user  = $_POST['user'];
	$pass  = $_POST['pass'];

	if (!empty(trim($user)) && !empty(trim($pass))) {

		if (cek_data($user, $pass)) {
      session_start();
      $_SESSION['user'] = $user;
			$_SESSION['status'] = "login";
			header('Location: index.php');
		}else{
			header('Location: login_admin.php');
		}
	}else{
		$error = 'Username & Password wajib diisi';
	}
}
 ?>

 <div class="container">
   <div class="row">
     <div class="col-md-4 col-md-offset-4">
       <div class="panel panel-info" style="margin-top:150px; margin-bottom:50px;">
         <div class="panel-heading" style="background-color:#111128; color:white;">
             <h3 class="text-center">Login Admin Here</h3>
         </div>
         <div class="panel-body">
           <form action="" method="post">
             <div class="form-group">
               <label for="nama"><h5>Username</h5></label> <br>
               <input type="text" name="user" class="form-control" placeholder="Username" required> <br> <br>

               <label for="password"><h5>Password</h5></label> <br>
               <input type="password" name="pass" class="form-control" placeholder="*******" required> <br> <br>
               
               <div id="error"><?= $error  ?></div>
               

               <div class="text-center">
                 <input type="submit" name="submit" class="btn btn-primary" value="Login" style="background-color:#111128; color:white; width:200px;">
               </div>
               <li style="color: #000000;">Username : Yoga Paripurna</li>
               <li style="color: #000000;">Password : 039</li>
             </div>
           </form>
         </div>
       </div>
     </div>
   </div>
 </div>