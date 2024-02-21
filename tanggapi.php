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

if (isset($_POST['bsimpan'])) {
    $id_pengaduan = $_POST["id_pengaduan"];
    $tgl_tanggapan = $_POST["tgl_tanggapan"];
    $tanggapan = $_POST["tanggapan"];
    $insert = mysqli_query($koneksi, "INSERT INTO tanggapan(id_pengaduan, tgl_tanggapan, tanggapan) value('$id_pengaduan','$tgl_tanggapan','$tanggapan')");

    if ($insert) {
        $sukses = "Data Berhasil Disimpan!";
        header("location:datatanggapan.php");
    } else {
        $error = "Data Gagal Disimpan!";
    }
}

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
    <div class="container-fluid">
    <h3 class="mt-4 text-white"><i class="bi bi-flag-fill"></i>&nbsp;Tanggapi laporan </h3>
    <hr>
   <!---- Card ---->
   <?php
                include 'koneksi.php';
                $id_pengaduan = $_GET['id_pengaduan'];
                $update = mysqli_query($koneksi, "SELECT * from pengaduan WHERE id_pengaduan='$id_pengaduan'");
                foreach ($update as $row) {

                ?>
   <div class="card shadow mb-4">
  <div class="card-header bg-primary text-light">
    Data Pengaduan
  </div>
  <div class="card-body">

<div class="row">
<div class="col">
  <div class="mb-3">
  <label class="form-label">ID Pengaduan</label>
  <input type="number" name="tlp" class="form-control" placeholder="ID"  value="<?php echo $row['id_pengaduan']; ?>" readonly>
  </div>
  </div>

  <div class="col">
  <div class="mb-3">
  <label class="form-label">NIK</label>
  <input type="number" name="tlp" class="form-control" placeholder="NIK"  value="<?php echo $row['NIK']; ?>"readonly>
  </div>
  </div>
  
  
  <div class="col">
  <div class="mb-3">
  <label class="form-label">Tanggal</label>
  <input type="date" name="tgl" class="form-control" value="<?php echo $row['tgl_pengaduan']; ?>" readonly>
  </div>
  </div>

  <div class="mb-3">
<label class="form-label">Isi Lporan</label>
<textarea name="isi" class="form-control" placeholder="Masukan tanggapan" readonly><?php echo $row['isi_laporan']; ?></textarea>
</div>
</div>

  <div class="col">
  <div class="mb-3">
  <label class="form-label">Foto Pengaduan</label>
  <div class="input-group">
 <img src="img/foto_pengaduan/<?php echo $row['foto_pengaduan']; ?>" alt="Foto Pengaduan" style="max-width: 400px; max-height: 400;">
 </div>
 </div>
  </div>
</div>

      <?php
        }
      ?>
    
    </div> 
    <br>
   <div class="card shadow  mb-4">
  <div class="card-header bg-primary text-light">
    Beri Tanggapan
  </div>
  <div class="card-body">
    <div class="col-md-6 mx-auto">
      <form method="POST">
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
    </div>

<div class="row">
<input type="hidden" class="form-control" placeholder="ID Pengaduan" name="id_pengaduan" value="<?php echo $row['id_pengaduan']; ?>" readonly>

  <div class="col">
  <div class="mb-3">
  <label class="form-label">Tanggal</label>
  <input type="date" name="tgl_tanggapan" class="form-control">
  </div>
  </div>
</div>

<div class="mb-3">
<label class="form-label">Isi Tanggapan</label>
<textarea name="tanggapan" class="form-control" placeholder="Masukan tanggapan"></textarea>
</div>
       </div>
      <div class="card-footer">
       <button type="reset" class="btn btn-danger" >Reset</button>
       <button type="submit" name="bsimpan" class="btn btn-primary">Simpan</button>
      </div>
      </form>   
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