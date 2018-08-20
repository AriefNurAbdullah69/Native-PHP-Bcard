<?php 
if (isset($_GET['nik'])) {
 $nik = $_GET['nik'];
 $conn = mysqli_connect("localhost", "root", "", "pkl");
 $ubah = "SELECT * FROM `card` where Nik = '$nik'";
 $execubah = mysqli_query($conn, $ubah);
 $hasil = mysqli_fetch_array($execubah);
}
?>
<!doctype html>
<html lang="en">
<head>
 <!-- Required meta tags -->
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

 <!-- Bootstrap CSS -->
 <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

 <!-- Custom fonts for this template-->
 <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

 <!-- Page level plugin CSS-->
 <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

 <!-- Custom styles for this template-->
 <link href="../css/sb-admin.css" rel="stylesheet">
 <title>KTP</title>
 <style>
 td {
  font-size: 25px;
  }p {
   font-size: 25px;
  }
 </style>
</head>
<body>
 <script>window.print()</script>
 <div class="row">
  <div class="col-md-12">
   <h1 class="text-center">KARTU TANDA PENDUDUK</h1>
   <h1 class="text-center">REPUBLIK INDONESIA</h1>
   <br>
  </div>
  <div class="col-md-8">
   <table class="col-md-12">
    <tr>
     <td>NIK</td>
     <td>:</td>
     <td><?php if(isset($_GET['nik'])){ echo strtoupper(($hasil['Nik'])); } ?></td>
    </tr>
    <tr>
     <td>Nama</td>
     <td>:</td>
     <td><?php if(isset($_GET['nik'])){ echo strtoupper(($hasil['Nama_Lengkap'])); } ?></td>
    </tr>
    <tr>
     <td>Tempat/Tgl Lahir</td>
     <td>:</td>
     <td><?php if(isset($_GET['nik'])){ echo strtoupper(($hasil['Tempat_Lahir']).",".(date('d-m-Y', strtotime($hasil['Tanggal_Lahir'])))); } ?></td>
    </tr>
    <tr>
     <td>Janis Kelamin</td>
     <td>:</td>
     <td><?php if(isset($_GET['nik'])){ echo strtoupper(($hasil['Jenis_Kelamin'])); } ?></td>
    </tr>
    <tr>
     <td>Gol. Darah</td>
     <td>:</td>
     <td><?php if(isset($_GET['nik'])){ echo strtoupper(($hasil['goldar'])); } ?></td>
    </tr>
    <tr>
     <td>Alamat</td>
     <td>:</td>
     <td><?php if(isset($_GET['nik'])){ echo strtoupper(($hasil['Alamat'])); } ?></td>
    </tr>
    <tr>
     <td>RT/RW</td>
     <td>:</td>
     <td><?php if(isset($_GET['nik'])){ echo strtoupper(($hasil['Rt'])."/".($hasil['Rw'])); } ?></td>
    </tr>
    <tr>
     <td>Kel/Desa</td>
     <td>:</td>
     <td><?php if(isset($_GET['nik'])){ echo strtoupper(($hasil['Kelurahan'])); } ?></td>
    </tr>
    <tr>
     <td>Kecamatan</td>
     <td>:</td>
     <td><?php if(isset($_GET['nik'])){ echo strtoupper(($hasil['Kabupaten/Kota'])); } ?></td>
    </tr>
    <tr>
     <td>Agama</td>
     <td>:</td>
     <td><?php if(isset($_GET['nik'])){ echo strtoupper(($hasil['agama'])); } ?></td>
    </tr>
    <tr>
     <td>Status Perkawinan</td>
     <td>:</td>
     <td><?php if(isset($_GET['nik'])){ echo strtoupper(($hasil['Status'])); } ?></td>
    </tr>
    <tr>
     <td>Pekerjaan</td>
     <td>:</td>
     <td><?php if(isset($_GET['nik'])){ echo strtoupper(($hasil['Pekerjaan'])); } ?></td>
    </tr>
    <tr>
     <td>Kewarganegaraan</td>
     <td>:</td>
     <td>INDONESIA</td>
    </tr>
    <tr>
     <td>Berlaku Hingga</td>
     <td>:</td>
     <td>SEUMUR HIDUP</td>
    </tr>
   </table>
  </div>
  <div class="col-md-4">
   <img src="<?php if(isset($_GET['nik'])){ echo strtoupper(($hasil['picture'])); } ?>" class="img-fluid" alt="Responsive image">
   <div class="text-center">
    <p>BANDUNG</p>
    <p><?php if(isset($_GET['nik'])){ echo date("d-m-Y"); } ?></p>
   </div>
  </div>
 </div>
 <!-- Optional JavaScript -->
 <!-- jQuery first, then Popper.js, then Bootstrap JS -->
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