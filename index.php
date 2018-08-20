<?php 
session_start();
$conn = mysqli_connect("localhost", "root", "", "pkl");
if (isset($_POST['login'])) {
 $Username = $_POST['Username'];
 $password = $_POST['Password'];
 $query = "SELECT * FROM `user/login` where Username = '$Username' and Password = '$password'";
 $exec = mysqli_query($conn, $query);
 $array = mysqli_fetch_array($exec);
 if ($array['Username'] == $Username & $array['Password'] == $password) {
  $_SESSION['Username'] = $array['Username'];
  $_SESSION['status'] = $array['Status'];
  if ($_SESSION['status'] == "Petugas") {
   header("location: /bcard/Petugas");
  }
  elseif ($_SESSION['status'] == "Admin") {
   header("location: /bcard/Admin");
  }
 } else {
  echo "<script>alert('Username Atau Password Salah')</script>";
 }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <meta name="description" content="">
 <meta name="author" content="">
 <title>Login</title>
 <!-- Bootstrap core CSS-->
 <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
 <!-- Custom fonts for this template-->
 <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
 <!-- Custom styles for this template-->
 <link href="css/sb-admin.css" rel="stylesheet">
 <style type="text/css">
   body {
    background-image: url("img/background.jpeg"), url("img/background.jpeg");
    background-position: right, left;
    background-repeat: no-repeat, no-repeat;
    background-color: #fff;
    background-size: 80vh, 80vh;
   }
 </style>
</head>
<body>
 <div class="container">
  <div class="card card-login mx-auto mt-5">
   <div class="card-header">Login</div>
   <div class="card-body">
    <form method="post" action="">
     <div class="form-group">
      <div class="form-label-group">
       <input type="text" id="inputEmail" class="form-control" placeholder="Username" required="required" autofocus="autofocus" name="Username">
       <label for="inputEmail">Username</label>
      </div>
     </div>
     <div class="form-group">
      <div class="form-label-group">
       <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="required" name="Password">
       <label for="inputPassword">Password</label>
      </div>
     </div>
     <div class="form-group">
      <div class="checkbox">
       <label>
        <input type="checkbox" value="remember-me">
        Remember Password
       </label>
      </div>
     </div>
     <button class="btn btn-primary btn-block" name="login">Login</button>
    </form>
   </div>
  </div>
 </div>
 <!-- Bootstrap core JavaScript-->
 <script src="vendor/jquery/jquery.min.js"></script>
 <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
 <!-- Core plugin JavaScript-->
 <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>
</html>
