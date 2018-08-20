<?php 
session_start();
$conn = mysqli_connect("localhost", "root", "", "pkl");
if (empty(isset($_SESSION['status']))) {
 header("location: /bcard");
}
elseif ($_SESSION['status'] == "Admin") {
 header("location: /bcard/Admin");
}
elseif ($_SESSION['status'] == "Petugas") {
}   
if (isset($_GET['logout'])) {
 session_destroy();
 header("location: \Bcard");
} 

if (isset($_GET['logout'])) {
 session_destroy();
 header("location: \Bcard");
}
elseif (isset($_POST['cari'])) {
 $nik = $_POST['cari'];
 $ubah = "SELECT * FROM `card` where Nik = '$nik'";
 $execubah = mysqli_query($conn, $ubah);
 $hasil = mysqli_fetch_array($execubah);
 if ($hasil == "") {
  $_SESSION['gagal'] = "Data Yang Anda Cari Tidak di temukan";
  unset($_SESSION['Sukses']);
}else {
  $_SESSION['Sukses'] = "Data Berhasil di temukan";
  unset($_SESSION['gagal']);
}
}
elseif (isset($_POST['cetak'])) {
 $nik = $_POST['nik'];
 header("location: /bcard/Print/?nik=".$nik);
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
 <title>Petugas - Bcard</title>
 <style>
 input[type="text"] {
  padding-left: 10px;
}
.Search {
  padding: 0;
}
.Search .col-md-3{
  padding: 0;
  float: right;
}
</style>
<style type="">
.background-image {
  width: 1200px;
  height: 800px;
  background-image: url("../img/background.jpeg");
  background-position: center 150px;
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: 400px;
  position: fixed;
  left: 0;
  right: 0;
  -webkit-filter: opacity(20%); /* Safari 6.0 - 9.0 */
  filter: opacity(20%);
  display: block;
  z-index: -999;
}
.wrapper {
  z-index: 99;
}
</style>
<!-- Bootstrap core CSS-->
<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom fonts for this template-->
<link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

<!-- Page level plugin CSS-->
<link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

<!-- Custom styles for this template-->
<link href="../css/sb-admin.css" rel="stylesheet">
</head>
<body id="page-top">
  <div class="background-image"></div>
  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
    <a class="navbar-brand mr-1" href="#">Bcard</a>
    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
     <i class="fas fa-bars"></i>
   </button>
   <!-- Navbar Search -->
   <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
   </form>

   <!-- Navbar -->
   <ul class="navbar-nav ml-auto ml-md-0">
     <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
       <i class="fas fa-user-circle fa-fw"></i>
     </a>
     <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
       <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
     </div>
   </li>
 </ul>
</nav>
<div id="wrapper">
  <!-- Sidebar -->
  <ul class="sidebar navbar-nav">
   <li class="nav-item active">
    <a class="nav-link" href="tables.html">
     <i class="fas fa-fw fa-table"></i>
     <span>Search Card</span></a>
   </li>
 </ul>
 <div id="content-wrapper">
  <div class="container-fluid">
   <!-- Breadcrumbs-->
   <ol class="breadcrumb">
    <li class="breadcrumb-item">
     <a href="#"></a>
   </li>
   <li class="breadcrumb-item active">Search Card</li>
 </ol>
 <!-- input -->
 <div class="row">
  <form action="" method="POST" class="col-md-12 Search">
   <div class="input-group col-md-3">
    <input name="cari" type="text" class="form-control" placeholder="NIK" aria-label="Search" aria-describedby="basic-addon2">
    <div class="input-group-append">
     <button class="btn btn-primary">
      <i class="fas fa-search"></i>
    </button>
  </div>
</div>
</form>
</div>
<hr>
<?php if (isset($_SESSION['gagal'])) { echo "<div class='alert alert-danger'>".$_SESSION['gagal']."<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
<span aria-hidden='true'>&times;</span>
</button></div>"; } ?>
<?php if (isset($_SESSION['Sukses'])) { echo "<div class='alert alert-success'>".$_SESSION['Sukses']."<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
<span aria-hidden='true'>&times;</span>
</button></div>"; } ?>
<form action="" method="post" class="col-md-12">
  <div class="row">
   <div class="col-md-4">
    <div class="form-group">
     <label for="NIK">NIK</label>
     <input value="<?php if(isset($_POST['cari'])){ echo $hasil['Nik']; } ?>" type="text" class="form-control" name="nik" readonly>
   </div>
   <div class="form-group">
     <label for="Nama">Nama Lengkap</label>
     <input value="<?php if(isset($_POST['cari'])){ echo $hasil['Nama_Lengkap']; } ?>"  type="text" class="form-control" name="nama" readonly>
   </div>
   <div class="form-group">
     <label for="Tempat Lahir">Tempat Lahir</label>
     <input value="<?php if(isset($_POST['cari'])){ echo $hasil['Tempat_Lahir']; } ?>"  type="text" class="form-control" name="tpl" readonly>
   </div>
   <div class="form-group">
     <label for="Tanggal Lahir">Tanggal Lahir</label>
     <input value="<?php if(isset($_POST['cari'])){ echo $hasil['Tanggal_Lahir']; } ?>"  type="text" class="form-control" name="tl" readonly>
   </div>
   <div class="form-group">
     <label for="Status">Status</label>
     <input value="<?php if(isset($_POST['cari'])){ echo $hasil['Status']; } ?>"  type="text" class="form-control" name="status" readonly>
   </div>
   <div class="form-group">
     <label for="Pekerjaan">Pekerjaan</label>
     <input value="<?php if(isset($_POST['cari'])){ echo $hasil['Pekerjaan']; } ?>"  type="text" class="form-control" name="Pekerjaan" readonly>
   </div>
   <div class="form-group">
     <label for="Agama">Agama</label>
     <input value="<?php if(isset($_POST['cari'])){ echo $hasil['agama']; } ?>"  type="text" class="form-control" name="agama" readonly>
   </div>
 </div>
 <div class="col-md-4">
  <div class="form-group">
   <label for="NIK">Alamat</label>
   <input value="<?php if(isset($_POST['cari'])){ echo $hasil['Alamat']; } ?>"  type="text" class="form-control" name="alamat" readonly>
 </div>
 <div class="row">
   <div class="col-md-6">
    <div class="form-group">
     <label for="rt">RT</label>
     <input value="<?php if(isset($_POST['cari'])){ echo $hasil['Rt']; } ?>"  type="text" class="form-control" name="rt" readonly>
   </div>
 </div>
 <div class="col-md-6">
  <div class="form-group">
   <label for="rw">RW</label>
   <input value="<?php if(isset($_POST['cari'])){ echo $hasil['Rw']; } ?>"  type="text" class="form-control" name="rw" readonly>
 </div>
</div> 
</div>  
<div class="form-group">      
 <label for="Kelurahan">Kelurahan</label>
 <input value="<?php if(isset($_POST['cari'])){ echo $hasil['Kelurahan']; } ?>"  type="text" class="form-control" name="tpl" readonly>
</div>
<div class="form-group">
 <label for="Kabupaten">Kabupaten/Kota</label>
 <input value="<?php if(isset($_POST['cari'])){ echo $hasil['Kabupaten/Kota']; } ?>"  type="text" class="form-control" name="tl" readonly>
</div>
<div class="form-group">
 <label for="Provinsi">Provinsi</label>
 <input value="<?php if(isset($_POST['cari'])){ echo $hasil['Provinsi']; } ?>"  type="text" class="form-control" name="status" readonly>
</div>
<div class="form-group">
 <label for="Golongan Darah">Golongan Darah</label>
 <input value="<?php if(isset($_POST['cari'])){ echo $hasil['goldar']; } ?>"  type="text" class="form-control" name="Golongan Darah" readonly>
</div>
<div class="form-group">
 <label for="Jenis Kelamin">Jenis Kelamin</label>
 <input value="<?php if(isset($_POST['cari'])){ echo $hasil['Jenis_Kelamin']; } ?>"  type="text" class="form-control" name="Jenis Kelamin" readonly>
</div>
</div>
<div class='col-md-4'>
  <div class="form-group">
   <?php if(isset($hasil['picture'])){ 
    echo "<div class='text-center'>
    <label for='exampleInputFile'>Foto ".$hasil['Nama_Lengkap']."</label>
    <img src='".$hasil['picture']."' class='img-fluid' alt='Responsive image'>
    </div>
    ";
  } 
  else {
    echo "<div class='text-center'>
    <label for='exampleInputFile'>Foto</label>
    </div>
    ";
  }
  ?>
</div>
</div>
</div>
<br>
<div class="text-center">
 <button type="submit" name="cetak" class="btn btn-primary col-md-2 col-xs-12" <?php if(!isset($hasil['Nik'])){ echo "disabled='disabled'"; } ?>>Cetak</button>       
 <button type="riset" class="btn btn-secondary col-md-2 col-xs-12">Batal</button>      
</div>
</form>
</div>
<!-- /.container-fluid -->
<br>
<!-- Sticky Footer -->
<footer class="sticky-footer">
 <div class="container my-auto">
  <div class="copyright text-center my-auto">
   <span>Copyright © Your Website 2018</span>
 </div>
</div>
</footer>
</div>
<!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
 <i class="fas fa-angle-up"></i>
</a>
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog" role="document">
  <div class="modal-content">
   <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
     <span aria-hidden="true">×</span>
   </button>
 </div>
 <div class="modal-footer">
  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
  <a class="btn btn-primary" href="?logout">Logout</a>
</div>
</div>
</div>
</div>
<!-- Bootstrap core JavaScript-->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Page level plugin JavaScript-->
<script src="../vendor/datatables/jquery.dataTables.js"></script>
<script src="../vendor/datatables/dataTables.bootstrap4.js"></script>

<!-- Custom scripts for all pages-->
<script src="../js/sb-admin.min.js"></script>

<!-- Demo scripts for this page-->
<script src="../js/demo/datatables-demo.js"></script>
</body>
</html>
