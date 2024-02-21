<?php
//koneksi database
$server = "localhost";
$user = "root";
$password = "";
$database = "lapor_hafizh";

//koneksi
$koneksi = mysqli_connect($server, $user, $password, $database) or die(mysqli_error($koneksi));

//variabel
$sukses="";
$error=""; 

   //bsimpan
  if(isset($_POST['bsimpan'])){
    $nik = $_POST["tnik"];
    $nama = $_POST["tnama"];
    $telp = $_POST["tlp"];
    $tgl_adu = $_POST["tgl"];
    $isi = $_POST["isi"];
    $foto_pengaduan = $_FILES['foto']['name'];
    $temp_file = $_FILES['foto']['tmp_name'];
    $folder = "img/foto_pengaduan/".$foto_pengaduan;
    move_uploaded_file($temp_file, $folder);

  $masyarakat = mysqli_query($koneksi, "insert into masyarakat (NIK, nama, telp)
                                   value ('$_POST[tnik]',
                                         '$_POST[tnama]',
                                         '$_POST[tlp]')
                                   ");
$pengaduan = mysqli_query($koneksi, "INSERT INTO pengaduan(NIK, tgl_pengaduan, isi_laporan, foto_pengaduan) values('$nik','$tgl_adu','$isi','$foto_pengaduan')");

//uji jika sukses
if($masyarakat && $pengaduan){
 $sukses = "Data Berhasil Disimpan!";
 } else {
 $error = "Data Gagal Disimpan!";
 }
 } 

?>


<!doctype html>
<html lang="en" data-bs-theme="dark">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

     <!--- botsrap icon--->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <title>Portal Pengaduan Masyarakat Jawir</title>
    <link rel="icon" type="image/x-icon" href="img/naz.png">
    <style>
  @import url('https://fonts.googleapis.com/css2?family=Poor+Story&display=swap');
  * {
    font-family: 'Poor Story', system-ui;
  }
  </style>
  </head>
  <body>
    <!--- Navbar --->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Portal Pengaduan Masyarakat</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="dev.html">Developer</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <!---- navbar --->
      <!---- container --->
    <div class="container">
    <h3 class="mt-4 text-white"><i class="bi bi-flag-fill"></i>&nbsp;Pengaduan Masyarakat </h3>
    <hr>
   <!---- tabel ---->
   <div class="card mt-4">
  <div class="card-header bg-primary text-light">
    Data Pengaduan
  </div>
  <div class="card-body">
    <div class="col-md-6 mx-auto">
      <form method="POST">
        <div class="input-group mb-3">
          <input type="text" name ="tcari" class="form-control" placeholder="Masukan Kata Kunci Yang Ingin Dicari">
          <button class="btn btn-primary" name="bcari" type="submit"><i class="bi bi-search"></i>&nbsp;</button>
          <button href="index.php" class="btn btn-danger" nama="breset" type="submit"><i class="bi bi-arrow-clockwise"></i>&nbsp;</button>
      </div>
      <?php
     if ($sukses){
     ?>
     <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong><?php echo $sukses; ?></strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
     <?php
     }
     if($error){
      ?>
   <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong><?php echo $error; ?></strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>
     <?php
     }
     ?>
      </form>
    </div>

<!-- Button trigger modal -->
<button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalt"><i class="bi bi-plus-lg"></i>&nbsp;
  Buat Aduan
</button>

<div class="table-responsive">
                                <table class="table table-bordered table-striped" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                           <th>No.</th>
                                            <th>Tgl Pengaduan</th>
                                            <th>Isi Laporan</th>
                                            <th>Foto Pengaduan</th>
                                            <th>Tanggapan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'koneksi.php';
                                        $urut = 1;

                                        if(isset($_POST['bcari'])){
                                          $keyword = $_POST['tcari'];
                                          $q = "select * from pengaduan where id_pengaduan like '%$keyword%' or tgl_pengaduan like '%$keyword%' or isi_laporan like '%$keyword%'";
                                         }else{
                                           $q = "select * from pengaduan";
                                         }

                                       $input = mysqli_query($koneksi,$q);

                                        foreach ($input as $row) {
                                            echo "<tr>
                                                <td>" . $urut++ . "</td>
                                                <td>" . $row['tgl_pengaduan'] . "</td>
                                                <td>" . $row['isi_laporan'] . "</td> 
                                                <td><img src='img/foto_pengaduan/" . $row['foto_pengaduan'] . "' alt='Foto Pengaduan' style='max-width: 100px; max-height: 100px;'></td>                                    
                                                <td>";

                                            // Mengambil data tanggapan berdasarkan ID pengaduan
                                            $query_tanggapan = mysqli_query($koneksi, "SELECT tanggapan FROM tanggapan WHERE id_pengaduan = '" . $row['id_pengaduan'] . "'");

                                            // Mengecek apakah ada tanggapan
                                            if ($tanggapan = mysqli_fetch_assoc($query_tanggapan)) {
                                                echo $tanggapan['tanggapan'];   
                                            } else {
                                                echo "Belum Ditanggapi";
                                            }

                                            echo "</td>
                                                </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>

<!-- Modal -->
<div class="modal fade" id="modalt" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Form Pengaduan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" enctype="multipart/form-data">
      <div class="modal-body">
<div class="mb-3">
<label class="form-label">NIK</label>
<input type="text" name="tnik" class="form-control" placeholder="Masukan NIK">
</div>

<div class="mb-3">
<label class="form-label">Nama</label>
<input type="text" name="tnama" class="form-control" placeholder="Masukan Nama">
</div>

<div class="row">
  <div class="col">
  <div class="mb-3">
  <label class="form-label">No Telepon</label>
  <input type="number" name="tlp" class="form-control" placeholder="No.Telepon">
  </div>
  </div>
  
  
  <div class="col">
  <div class="mb-3">
  <label class="form-label">Tanggal</label>
  <input type="date" name="tgl" class="form-control">
  </div>
  </div>
</div>

<div class="mb3">
<label class="form-label">Foto</label>
<div class="input-group">
  <input type="file" class="form-control" name="foto">
</div>
</div>
<br>
<div class="mb-3">
<label class="form-label">Isi Laporan</label>
<textarea name="isi" class="form-control" placeholder="Masukan Laporan"></textarea>
</div>

       </div>
      <div class="modal-footer">
       <button type="reset" class="btn btn-danger" >Reset</button>
       <button type="submit" name="bsimpan" class="btn btn-primary">Simpan</button>
      </div>
    </form>
    </div>
  </div>
</div>
  </div>
  </div>

</div>
<!--- container --->


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>