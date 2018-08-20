<?php 
session_start();
$conn = mysqli_connect("localhost", "root", "", "pkl");
if (empty(isset($_SESSION['status']))) {
 header("location: /bcard");
}
elseif ($_SESSION['status'] == "Admin") {
}
elseif ($_SESSION['status'] == "Petugas") {
 header("location: /bcard/Petugas");
}   
if (isset($_GET['logout'])) {
 session_destroy();
 header("location: \Bcard");
}
elseif (isset($_GET['ubah'])) {
 $nik = $_GET['nik'];
 $ubah = "SELECT * FROM `card` where Nik = '$nik'";
 $execubah = mysqli_query($conn, $ubah);
 $hasil = mysqli_fetch_array($execubah);
 if ($hasil == "") {
  $_SESSION['gagal'] = "Data yang di cari gak ada sayang";
  unset($_SESSION['Sukses']);
}else {
  $_SESSION['Sukses'] = "Alhamdullilah Ternyata Datanya Ada";
  unset($_SESSION['gagal']);
}
}
elseif (isset($_GET['hapus'])) {
 $nik = $_GET['nik'];
 $hapus = "DELETE FROM `card` where Nik = '$nik'";
 $hasilhapus = mysqli_query($conn, $hapus) or die ( mysqli_error($conn));
 if ($hasilhapus) {
  $_SESSION['Sukses'] = "Sukses Menghapus Data nik = ".$nik;
  unset($_SESSION['gagal']);
  header('Refresh: 1; url=index.php');
}else {
  $_SESSION['gagal'] = "Gagal Menghapus Data";
  unset($_SESSION['Sukses']);
  header('Refresh: 1; url=index.php');
}
}
elseif (isset($_POST['tambah'])) {
  photo();
  $nik = $_POST['nik'];
  $nama = $_POST['nama'];
  $tempat = $_POST['tpl'];
  $Tanggal = $_POST['tl'];
  $status = $_POST['status'];
  $Pekerjaan = $_POST['Pekerjaan'];
  $alamat = $_POST['alamat'];
  $rt = $_POST['rt'];
  $rw = $_POST['rw'];
  $Kelurahan = $_POST['Kelurahan'];
  $Kabupaten = $_POST['Kabupaten'];
  $Provinsi = $_POST['Provinsi'];
  $jk = $_POST['jk'];
  $goldar = $_POST['goldar'];
  $agama = $_POST['agama'];
  $picture = "../uploads/".basename( $_FILES["fileToUpload"]["name"]);
  $insert = "INSERT INTO `card` (`Nik`, `Nama_Lengkap`, `Tempat_Lahir`, `Tanggal_Lahir`, `Status`, `Pekerjaan`, `Alamat`, `Rt`, `Rw`, `Kelurahan`, `Kabupaten/Kota`, `Provinsi`, `picture`, `goldar`, `Jenis_Kelamin`, `agama`) VALUES ('$nik', '$nama', '$tempat', '$Tanggal', '$status', '$Pekerjaan', '$alamat', '$rt', '$rw', '$Kelurahan', '$Kabupaten', '$Provinsi', '$picture', '$goldar', '$jk', '$agama')";
  $hasilinsert = mysqli_query($conn, $insert) or die ( mysqli_error($conn));
  if ($hasilinsert) {
   $_SESSION['Sukses'] = "Sukses menambahkan Data nik = ".$nik;
   unset($_SESSION['gagal']);
 }else {
   $_SESSION['gagal'] = "Gagal menambahkan Data";
   unset($_SESSION['Sukses']);
 }
}
elseif (isset($_POST['ubah'])) {
  if ($_FILES["fileToUpload"]["error"] > 0) {
    $picture = $_POST['x'];
  }else {
    photo();
    $picture = "../uploads/".basename( $_FILES["fileToUpload"]["name"]);
  }
  $nik = $_POST['nik'];
  $nama = $_POST['nama'];
  $tempat = $_POST['tpl'];
  $Tanggal = $_POST['tl'];
  $status = $_POST['status'];
  $Pekerjaan = $_POST['Pekerjaan'];
  $alamat = $_POST['alamat'];
  $rt = $_POST['rt'];
  $rw = $_POST['rw'];
  $Kelurahan = $_POST['Kelurahan'];
  $Kabupaten = $_POST['Kabupaten'];
  $Provinsi = $_POST['Provinsi'];
  $jk = $_POST['jk'];
  $goldar = $_POST['goldar'];
  $agama = $_POST['agama'];
  $insert = "UPDATE `card` SET `Nik` = '$nik', `Nama_Lengkap` = '$nama', `Tempat_Lahir` = '$tempat', `Tanggal_Lahir` = '$Tanggal', `Status` = '$status', `Pekerjaan` = '$Pekerjaan', `Alamat` = '$alamat', `Rt` = '$rt', `Rw` = '$rw', `Kelurahan` = '$Kelurahan', `Kabupaten/Kota` = '$Kabupaten', `Provinsi` = '$Provinsi', `picture` = '$picture', `goldar` = '$goldar', `Jenis_Kelamin` = '$jk', `agama` = '$agama' WHERE `card`.`Nik` = '$nik'";
  $hasilinsert = mysqli_query($conn, $insert) or die ( mysqli_error($conn));
  if ($hasilinsert) {
   $_SESSION['Sukses'] = "Sukses Ubah Data nik = ".$nik;
   unset($_SESSION['gagal']);
 }else {
   $_SESSION['gagal'] = "Gagal Ubah Data";
   unset($_SESSION['Sukses']);
 }
}
function photo()
{
  $target_dir = "../uploads/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    $_SESSION['gagal'] = "File is an image - " . $check["mime"] . ".";
    unset($_SESSION['Sukses']);
    $uploadOk = 1;
  } else {
    $_SESSION['gagal'] = "File is not an image.";
    unset($_SESSION['Sukses']);
    $uploadOk = 0;
  }
// Check if file already exists
  if (file_exists($target_file)) {
    $_SESSION['gagal'] = "Sorry, file already exists.";
    unset($_SESSION['Sukses']);
    $uploadOk = 0;
  }
// Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    $_SESSION['gagal'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  unset($_SESSION['Sukses']);
  $uploadOk = 0;
}
  // Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
 echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
} else {
 if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
  unset($_SESSION['gagal']);
  $_SESSION['Sukses'] = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
} else {
  $_SESSION['gagal'] = "Sorry, there was an error uploading your file.";
  unset($_SESSION['Sukses']);
}
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

<title>Admin - Bcard</title>
<style>
.Search {
  padding: 0;
}
.Search .col-md-3{
  padding: 0;
  float: right;
}
input[type="text"] {
  padding-left: 10px;
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
</head>
<body id="page-top">
<div class="background-image"></div>
<nav class="navbar navbar-expand navbar-dark bg-dark static-top">
<a class="navbar-brand mr-1" href="index.html">Bcard</a>
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
<!-- <a class="dropdown-item" href="#">Settings</a>
<a class="dropdown-item" href="#">Activity Log</a>
<div class="dropdown-divider"></div> -->
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
<span>Master Card</span></a>
</li>
</ul>
<div id="content-wrapper">
<div class="container-fluid">
<!-- Breadcrumbs-->
<ol class="breadcrumb">
<li class="breadcrumb-item">
<a href="#"></a>
</li>
<li class="breadcrumb-item active">Master Card</li>
</ol>
<?php if (isset($_SESSION['gagal'])) { echo "<div class='alert alert-danger'>".$_SESSION['gagal']."<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
<span aria-hidden='true'>&times;</span>
</button></div>"; } ?>
<?php if (isset($_SESSION['Sukses'])) { echo "<div class='alert alert-success'>".$_SESSION['Sukses']."<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
<span aria-hidden='true'>&times;</span>
</button></div>"; } ?>
<form method="POST" action="index.php" enctype="multipart/form-data" class="col-md-12">
<div class="row">
<div class="col-md-4">
<div class="form-group">
<label for="NIK">NIK</label>
<input value="<?php if(isset($_GET['ubah'])){ echo $hasil['Nik']; } ?>" type="number" min="1" max="9999999999" class="form-control" name="nik" <?php if(isset($_GET['ubah'])){ echo "Readonly"; } ?>>
</div>
<div class="form-group">
<label for="Nama">Nama Lengkap</label>
<input value="<?php if(isset($_GET['ubah'])){ echo $hasil['Nama_Lengkap']; } ?>"  type="text" class="form-control" name="nama" required>
</div>
<div class="form-group">
<label for="Tempat Lahir">Tempat Lahir</label>
<input value="<?php if(isset($_GET['ubah'])){ echo $hasil['Tempat_Lahir']; } ?>"  type="text" class="form-control" name="tpl" required>
</div>
<div class="form-group">
<label for="Tanggal Lahir">Tanggal Lahir</label>
<input value="<?php if(isset($_GET['ubah'])){ echo $hasil['Tanggal_Lahir']; } ?>"  type="date" class="form-control" name="tl" required>
</div>
<div class="form-group">
<label for="Status">Status</label>
<select class="form-control" name="status">
<option value="BELUM KAWIN" <?php if(isset($_GET['ubah'])){ if ($hasil['Status'] == 'BELUM KAWIN' ) echo 'selected' ; } ?>>BELUM KAWIN</option>
<option value="MENIKAH" <?php if(isset($_GET['ubah'])){ if ($hasil['Status'] == 'MENIKAH' ) echo 'selected' ; } ?>>MENIKAH</option>
<option></option>
</select>
</div>
<div class="form-group">
<label for="Pekerjaan">Pekerjaan</label>
<select class="form-control" name="Pekerjaan">
<option value='Belum / Tidak Bekerja' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Belum / Tidak Bekerja' ) echo 'selected' ; } ?>>Belum / Tidak Bekerja</option>
<option value='Mengurus Rumah Tangga' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Mengurus Rumah Tangga' ) echo 'selected' ; } ?>>Mengurus Rumah Tangga</option>
<option value='Pelajar / Mahasiswa' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Pelajar / Mahasiswa' ) echo 'selected' ; } ?>>Pelajar / Mahasiswa</option>
<option value='Pensiunan' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Pensiunan' ) echo 'selected' ; } ?>>Pensiunan</option>
<option value='Pegawai Negeri Sipil' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Pegawai Negeri Sipil' ) echo 'selected' ; } ?>>Pegawai Negeri Sipil</option>
<option value='Tentara Nasional Indonesia' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Tentara Nasional Indonesia' ) echo 'selected' ; } ?>>Tentara Nasional Indonesia</option>
<option value='Kepolisian RI' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Kepolisian RI' ) echo 'selected' ; } ?>>Kepolisian RI</option>
<option value='Perdagangan' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Perdagangan' ) echo 'selected' ; } ?>>Perdagangan</option>
<option value='Petani / Pekebun' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Petani / Pekebun' ) echo 'selected' ; } ?>>Petani / Pekebun</option>
<option value='Peternak' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Peternak' ) echo 'selected' ; } ?>>Peternak</option>
<option value='Nelayan / Perikanan' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Nelayan / Perikanan' ) echo 'selected' ; } ?>>Nelayan / Perikanan</option>
<option value='Industri' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Industri' ) echo 'selected' ; } ?>>Industri</option>
<option value='Konstruksi' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Konstruksi' ) echo 'selected' ; } ?>>Konstruksi</option>
<option value='Transportasi' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Transportasi' ) echo 'selected' ; } ?>>Transportasi</option>
<option value='Karyawan Swasta' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Karyawan Swasta' ) echo 'selected' ; } ?>>Karyawan Swasta</option>
<option value='Karyawan BUMN' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Karyawan BUMN' ) echo 'selected' ; } ?>>Karyawan BUMN</option>
<option value='Karyawan BUMD' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Karyawan BUMD' ) echo 'selected' ; } ?>>Karyawan BUMD</option>
<option value='Karyawan Honorer' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Karyawan Honorer' ) echo 'selected' ; } ?>>Karyawan Honorer</option>
<option value='Buruh Harian Lepas' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Buruh Harian Lepas' ) echo 'selected' ; } ?>>Buruh Harian Lepas</option>
<option value='Buruh Tani / Perkebunan' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Buruh Tani / Perkebunan' ) echo 'selected' ; } ?>>Buruh Tani / Perkebunan</option>
<option value='Buruh Nelayan / Perikanan' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Buruh Nelayan / Perikanan' ) echo 'selected' ; } ?>>Buruh Nelayan / Perikanan</option>
<option value='Buruh Peternakan' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Buruh Peternakan' ) echo 'selected' ; } ?>>Buruh Peternakan</option>
<option value='Pembantu Rumah Tangga' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Pembantu Rumah Tangga' ) echo 'selected' ; } ?>>Pembantu Rumah Tangga</option>
<option value='Tukang Cukur' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Tukang Cukur' ) echo 'selected' ; } ?>>Tukang Cukur</option>
<option value='Tukang Listrik' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Tukang Listrik' ) echo 'selected' ; } ?>>Tukang Listrik</option>
<option value='Tukang Batu' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Tukang Batu' ) echo 'selected' ; } ?>>Tukang Batu</option>
<option value='Tukang Kayu' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Tukang Kayu' ) echo 'selected' ; } ?>>Tukang Kayu</option>
<option value='Tukang Sol Sepatu' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Tukang Sol Sepatu' ) echo 'selected' ; } ?>>Tukang Sol Sepatu</option>
<option value='Tukang Las / Pandai Besi' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Tukang Las / Pandai Besi' ) echo 'selected' ; } ?>>Tukang Las / Pandai Besi</option>
<option value='Tukang Jahit' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Tukang Jahit' ) echo 'selected' ; } ?>>Tukang Jahit</option>
<option value='Penata Rambut' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Penata Rambut' ) echo 'selected' ; } ?>>Penata Rambut</option>
<option value='Penata Rias' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Penata Rias' ) echo 'selected' ; } ?>>Penata Rias</option>
<option value='Penata Busana' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Penata Busana' ) echo 'selected' ; } ?>>Penata Busana</option>
<option value='Mekanik' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Mekanik' ) echo 'selected' ; } ?>>Mekanik</option>
<option value='Tukang Gigi' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Tukang Gigi' ) echo 'selected' ; } ?>>Tukang Gigi</option>
<option value='Seniman' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Seniman' ) echo 'selected' ; } ?>>Seniman</option>
<option value='Tabib' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Tabib' ) echo 'selected' ; } ?>>Tabib</option>
<option value='Paraji' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Paraji' ) echo 'selected' ; } ?>>Paraji</option>
<option value='Perancang Busana' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Perancang Busana' ) echo 'selected' ; } ?>>Perancang Busana</option>
<option value='Penterjemah' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Penterjemah' ) echo 'selected' ; } ?>>Penterjemah</option>
<option value='Imam Masjid' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Imam Masjid' ) echo 'selected' ; } ?>>Imam Masjid</option>
<option value='Pendeta' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Pendeta' ) echo 'selected' ; } ?>>Pendeta</option>
<option value='Pastur' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Pastur' ) echo 'selected' ; } ?>>Pastur</option>
<option value='Wartawan' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Wartawan' ) echo 'selected' ; } ?>>Wartawan</option>
<option value='Ustadz / Mubaligh' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Ustadz / Mubaligh' ) echo 'selected' ; } ?>>Ustadz / Mubaligh</option>
<option value='Juru Masak' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Juru Masak' ) echo 'selected' ; } ?>>Juru Masak</option>
<option value='Promotor Acara' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Promotor Acara' ) echo 'selected' ; } ?>>Promotor Acara</option>
<option value='Anggota DPR-RI' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Anggota DPR-RI' ) echo 'selected' ; } ?>>Anggota DPR-RI</option>
<option value='Anggota DPD' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Anggota DPD' ) echo 'selected' ; } ?>>Anggota DPD</option>
<option value='Anggota BPK' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Anggota BPK' ) echo 'selected' ; } ?>>Anggota BPK</option>
<option value='Presiden' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Presiden' ) echo 'selected' ; } ?>>Presiden</option>
<option value='Wakil Presiden' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Wakil Presiden' ) echo 'selected' ; } ?>>Wakil Presiden</option>
<option value='Anggota Mahkamah Konstitusi' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Anggota Mahkamah Konstitusi' ) echo 'selected' ; } ?>>Anggota Mahkamah Konstitusi</option>
<option value='Anggota Kabinet / Kementerian' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Anggota Kabinet / Kementerian' ) echo 'selected' ; } ?>>Anggota Kabinet / Kementerian</option>
<option value='Duta Besar' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Duta Besar' ) echo 'selected' ; } ?>>Duta Besar</option>
<option value='Gubernur' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Gubernur' ) echo 'selected' ; } ?>>Gubernur</option>
<option value='Wakil Gubernur' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Wakil Gubernur' ) echo 'selected' ; } ?>>Wakil Gubernur</option>
<option value='Bupati' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Bupati' ) echo 'selected' ; } ?>>Bupati</option>
<option value='Wakil Bupati' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Wakil Bupati' ) echo 'selected' ; } ?>>Wakil Bupati</option>
<option value='Walikota' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Walikota' ) echo 'selected' ; } ?>>Walikota</option>
<option value='Wakil Walikota' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Wakil Walikota' ) echo 'selected' ; } ?>>Wakil Walikota</option>
<option value='Anggota DPRD Propinsi' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Anggota DPRD Propinsi' ) echo 'selected' ; } ?>>Anggota DPRD Propinsi</option>
<option value='Anggota DPRD Kabupaten / Kota' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Anggota DPRD Kabupaten / Kota' ) echo 'selected' ; } ?>>Anggota DPRD Kabupaten / Kota</option>
<option value='Dosen' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Dosen' ) echo 'selected' ; } ?>>Dosen</option>
<option value='Guru' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Guru' ) echo 'selected' ; } ?>>Guru</option>
<option value='Pilot' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Pilot' ) echo 'selected' ; } ?>>Pilot</option>
<option value='Pengacara' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Pengacara' ) echo 'selected' ; } ?>>Pengacara</option>
<option value='Notaris' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Notaris' ) echo 'selected' ; } ?>>Notaris</option>
<option value='Arsitek' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Arsitek' ) echo 'selected' ; } ?>>Arsitek</option>
<option value='Akuntan' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Akuntan' ) echo 'selected' ; } ?>>Akuntan</option>
<option value='Konsultan' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Konsultan' ) echo 'selected' ; } ?>>Konsultan</option>
<option value='Dokter' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Dokter' ) echo 'selected' ; } ?>>Dokter</option>
<option value='Bidan' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Bidan' ) echo 'selected' ; } ?>>Bidan</option>
<option value='Perawat' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Perawat' ) echo 'selected' ; } ?>>Perawat</option>
<option value='Apoteker' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Apoteker' ) echo 'selected' ; } ?>>Apoteker</option>
<option value='Psikiater / Psikolog' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Psikiater / Psikolog' ) echo 'selected' ; } ?>>Psikiater / Psikolog</option>
<option value='Penyiar Televisi' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Penyiar Televisi' ) echo 'selected' ; } ?>>Penyiar Televisi</option>
<option value='Penyiar Radio' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Penyiar Radio' ) echo 'selected' ; } ?>>Penyiar Radio</option>
<option value='Pelaut' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Pelaut' ) echo 'selected' ; } ?>>Pelaut</option>
<option value='Peneliti' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Peneliti' ) echo 'selected' ; } ?>>Peneliti</option>
<option value='Sopir' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Sopir' ) echo 'selected' ; } ?>>Sopir</option>
<option value='Pialang' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Pialang' ) echo 'selected' ; } ?>>Pialang</option>
<option value='Paranormal' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Paranormal' ) echo 'selected' ; } ?>>Paranormal</option>
<option value='Pedagang' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Pedagang' ) echo 'selected' ; } ?>>Pedagang</option>
<option value='Perangkat Desa' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Perangkat Desa' ) echo 'selected' ; } ?>>Perangkat Desa</option>
<option value='Kepala Desa' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Kepala Desa' ) echo 'selected' ; } ?>>Kepala Desa</option>
<option value='Biarawati' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Biarawati' ) echo 'selected' ; } ?>>Biarawati</option>
<option value='Wiraswasta' <?php if(isset($_GET['ubah'])){ if ($hasil['Pekerjaan'] == 'Wiraswasta' ) echo 'selected' ; } ?>>Wiraswasta</option>
</select>
</div>
<div class="form-group">
<label for="agama" >Agama</label>
<select class="form-control" name="agama">
<option value="ISLAM" <?php if(isset($_GET['ubah'])){ if ($hasil['agama'] == 'ISLAM' ) echo 'selected' ; } ?>>ISLAM</option>
<option value="KRISTEN" <?php if(isset($_GET['ubah'])){ if ($hasil['agama'] == 'KRISTEN' ) echo 'selected' ; } ?>>KRISTEN</option>
<option value="KATOLIK" <?php if(isset($_GET['ubah'])){ if ($hasil['agama'] == 'KATOLIK' ) echo 'selected' ; } ?>>KATOLIK</option>
<option value="BUDHA" <?php if(isset($_GET['ubah'])){ if ($hasil['agama'] == 'BUDHA' ) echo 'selected' ; } ?>>BUDHA</option>
<option value="HINDU" <?php if(isset($_GET['ubah'])){ if ($hasil['agama'] == 'HINDU' ) echo 'selected' ; } ?>>HINDU</option>
</select>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label for="NIK">Alamat</label>
<input value="<?php if(isset($_GET['ubah'])){ echo $hasil['Alamat']; } ?>"  type="text" class="form-control" name="alamat" required>
</div>
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label for="Nama">RT</label>
<input value="<?php if(isset($_GET['ubah'])){ echo $hasil['Rt']; } ?>"  type="text" class="form-control" name="rt" required>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="Nama">RW</label>
<input value="<?php if(isset($_GET['ubah'])){ echo $hasil['Rw']; } ?>"  type="text" class="form-control" name="rw" required>
</div>
</div> 
</div>  
<div class="form-group">      
<label for="Tempat Lahir">Kelurahan</label>
<input value="<?php if(isset($_GET['ubah'])){ echo $hasil['Kelurahan']; } ?>"  type="text" class="form-control" name="Kelurahan" required>
</div>
<div class="form-group">
<label for="Tanggal Lahir">Kabupaten/Kota</label>
<input value="<?php if(isset($_GET['ubah'])){ echo $hasil['Kabupaten/Kota']; } ?>"  type="text" class="form-control" name="Kabupaten" required>
</div>
<div class="form-group">
<label for="Status">Provinsi</label>
<input value="<?php if(isset($_GET['ubah'])){ echo $hasil['Provinsi']; } ?>"  type="text" class="form-control" name="Provinsi" required>
</div>
<div class="form-group">
<label for="Status">Golongan Darah</label>
<select name="goldar" class="form-control">
<option value="A" <?php if(isset($_GET['ubah'])){ if ($hasil['goldar'] == 'A' ) echo 'selected' ; } ?>>A</option>
<option value="B" <?php if(isset($_GET['ubah'])){ if ($hasil['goldar'] == 'B' ) echo 'selected' ; } ?>>B</option>
<option value="AB" <?php if(isset($_GET['ubah'])){ if ($hasil['goldar'] == 'AB' ) echo 'selected' ; } ?>>AB</option>
<option value="O" <?php if(isset($_GET['ubah'])){ if ($hasil['goldar'] == 'O' ) echo 'selected' ; } ?>>O</option>
</select>
</div>
<div class="form-group">
<label for="Status">Jenis Kelamin</label>
<select class="form-control" name="jk">
<option value="Laki-laki"  <?php if(isset($_GET['ubah'])){ if ($hasil['Jenis_Kelamin'] == 'Laki-laki' ) echo 'selected' ; } ?>>Laki-laki</option>
<option value="Perempuan"  <?php if(isset($_GET['ubah'])){ if ($hasil['Jenis_Kelamin'] == 'Perempuan' ) echo 'selected' ; } ?>>Perempuan</option>
</select>
</div>
</div>
<div class='col-md-4'>
<div class="form-group">
<?php if(isset($_GET['ubah'])){ 
 echo "<div class='text-center'>
 <label for='exampleInputFile'>Foto ".$hasil['Nama_Lengkap']."</label>
 <img src='".$hasil['picture']."' class='img-fluid' alt='Responsive image'>
 </div>
 ";
} 
else {
 echo "<label for='exampleInputFile'>Upload Gambar</label>
 <img src='' class='img-fluid'>
 ";
}
?>
<input type="file" name="fileToUpload" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp" <?php if(!isset($_GET['ubah'])){ echo 'required' ; }?>>
<input value="<?php if(isset($_GET['ubah'])){ echo $hasil['picture']; } ?>" type="text" hidden="hidden" name="x">
</div>
</div>
</div>
<div class="text-center">
<?php 
if(isset($_GET['ubah'])){
 echo "<button type='submit' name='ubah' class='btn btn-warning col-md-2 col-xs-12'>Ubah</button>";
} 
else {
 echo "<button name='tambah' type='submit' class='btn btn-primary col-md-2 col-xs-12'>Tambah</button> ";
}
?>
</div>
</form>
<br>
<!-- DataTables Example -->
<div class="card mb-3">
<div class="card-header">
<i class="fas fa-table"></i>
Data Table Card</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr>
<th>No</th>
<th>Nik</th>
<th>Nama_Lengkap</th>
<th>Tempat_Lahir</th>
<th>Tanggal_Lahir</th>
<th>Status</th>
<th>Pekerjaan</th>
<th>Alamat</th>
<th>RT</th>
<th>RW</th>
<th>Kelurahan</th>
<th>Kabupaten/Kota</th>
<th>Provinsi</th>
<th>Golongan Darah</th>      
<th>Jenis Kelamin</th>      
<th>Agama</th>      
<th>Aksi</th>
</tr>
</thead>
<tbody>
<?php 
$query = "SELECT * FROM `card`";
$exec = mysqli_query($conn, $query);
$no = 1;
while ($row = mysqli_fetch_array($exec)) {
  echo "<tr>
  <td>$no</td>
  <td>$row[0]</td>
  <td>$row[1]</td>
  <td>$row[2]</td>
  <td>$row[3]</td>
  <td>$row[4]</td>
  <td>$row[5]</td>
  <td>$row[6]</td>
  <td>$row[7]</td>
  <td>$row[8]</td>
  <td>$row[9]</td>
  <td>$row[10]</td>
  <td>$row[11]</td>
  <td>$row[13]</td>
  <td>$row[14]</td>
  <td>$row[15]</td>
  <td><a href='?hapus=&nik=$row[0]' class='btn btn-danger'>Hapus</a><a href='?ubah=&nik=$row[0]' class='btn btn-warning'>ubah</a></td>
  </tr>";
  $no++;
}
?>
</tbody>
</table>
</div>
</div>
<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>
<p class="small text-center text-muted my-5">
<em>More table examples coming soon...</em>
</p>
</div>
<!-- /.container-fluid -->
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
