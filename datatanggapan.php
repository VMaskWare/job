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

?>


<!doctype html>
<html lang="en"  data-bs-theme="dark">
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
          <a class="nav-link active" aria-current="page" href="datatanggapan.php">Data Pengaduan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="tanggapan.php">Data Tanggapan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link"  data-bs-toggle="modal" data-bs-target="#logout">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <!---- navbar --->
      <!---- container --->
    <div class="container">
    <h3 class="mt-4 text-white"><i class="bi bi-flag-fill"></i>&nbsp;Data Pengaduan </h3>
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

    <div class="table-responsive">
                                <table class="table table-bordered table-striped" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>ID Pengaduan</th>
                                            <th>NIK</th>
                                            <th>Tgl Pengaduan</th>
                                            <th>Isi Laporan</th>
                                            <th>Foto Pengaduan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'koneksi.php';
                                        $urut = 1;

                                        if(isset($_POST['bcari'])){
                                          $keyword = $_POST['tcari'];
                                          $q = "select * from pengaduan where NIK like '%$keyword%' or id_pengaduan like '%$keyword%' or tgl_pengaduan like '%$keyword%' or isi_laporan like '%$keyword%'";
                                         }else{
                                           $q = "select * from pengaduan";
                                         }

                                        $input = mysqli_query($koneksi, $q);

                                        foreach ($input as $row) {
                                            // Mengecek apakah ID Pengaduan sudah ada dalam tabel tanggapan
                                            $cek_tanggapan = mysqli_query($conn, "SELECT * FROM tanggapan WHERE id_pengaduan = '" . $row['id_pengaduan'] . "'");
                                            $link = mysqli_num_rows($cek_tanggapan) > 0 ? 'tanggapan.php' : 'tanggapi.php';
                                        
                                            echo "<tr>
                                                <td>" . $urut++ . "</td>
                                                <td>" . $row['id_pengaduan'] . "</td>
                                                <td>" . $row['NIK'] . "</td>
                                                <td>" . $row['tgl_pengaduan'] . "</td>
                                                <td>" . $row['isi_laporan'] . "</td>
                                                <td><img src='img/foto_pengaduan/" . $row['foto_pengaduan'] . "' alt='Foto Pengaduan' style='max-width: 100px; max-height: 100px;'></td>    
                                                <td><a href='$link?id_pengaduan=$row[id_pengaduan]'>" . (mysqli_num_rows($cek_tanggapan) > 0 ? '<button class="btn btn-sm btn-secondary"><i class="bi bi-eye-fill"></i>&nbsp;Lihat tanggapan</button>' : '<button class="btn btn-sm btn-primary"><i class="bi bi-flag"></i>&nbsp;Beri tanggapan</button>') . "</a></td>
                                                </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

<!-- Modal -->
<div class="modal fade" id="modalt" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Form Pengaduan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST">
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

<div class="mb-3">
<label class="form-label">Isi Lporan</label>
<textarea name="isi" class="form-control" placeholder="Masukan Nama"></textarea>
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

  <div class="modal" id="logout" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Kamu yakin untuk log out ?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Klik lanjutkan untuk log out.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a href="logout.php"><button  type="button" class="btn btn-primary">Lanjutkan</button></a>
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