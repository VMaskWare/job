<?php
session_start();
include "koneksi.php";

$pass = ($_POST['password']);
$username = mysqli_escape_string($conn,$_POST['username']);
$password = mysqli_escape_string($conn,$pass);

$login = mysqli_query($conn, "select * from petugas where username = '$username' and password = '$password'");
$data = mysqli_fetch_array($login);

if ($data){
$_SESSION['username'] = $data['username'];
$_SESSION['password'] = $data['password'];

header("location:datatanggapan.php");
}else{
 echo "<script>alert('Maaf gagal login, mohon cek kembali.');
 document.location='login.php';</script>";
}
?>