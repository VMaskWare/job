<!doctype html>
<html lang="en" data-bs-theme="dark">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

     <!--- botsrap icon--->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

    <title>CRUD TEST</title>
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
          <a class="nav-link " aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="login.php">Login</a>
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
    <div class="card-container" align="center">
    <h3 class="mt-4"><i class="bi bi-file-earmark-plus"></i>&nbsp;Login Admin </h3>
    <hr class="w-50">
    <div class="card" style="width: 18rem;">
    <div class="card-body">
    <h5 class="card-title">Login Untuk Lanjutkan</h5>
      <form action="proseslogin.php" method="POST">
      <div class="mt-1 mb-3" align="left">
      <label for="namelabel" class="form-label">Username</label>
      <input type="text" class="form-control mt-1" name="username">
     </div>
     <div class="mt-1 mb-3" align="left">
      <label for="passwordlabel" class="form-label">Password</label>
      <input type="password" class="form-control mt-1" name="password">
     </div>
     <button type="submit" class="btn btn-sm btn-primary">Login</button>
     <button type="reset" class="btn btn-sm btn-secondary">Reset</button>
     <br>

     </form>
     </div>
     <p class="fs-6 text-danger">Hanya admin yang bisa login</p>
  </div>
  </div>
  </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>