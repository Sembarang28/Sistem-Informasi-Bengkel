<?php
session_start();
require 'connect.php';
ob_start();
$result = mysqli_query($conn, "SELECT * FROM service");
$num = mysqli_num_rows($result);
$id = "SR";
$id .= $num + 1;
$id_pelanggan = $_SESSION['id'];
$nama_pelanggan = $_SESSION['nama'];
$date = date('Y-m-d');

if(isset($_POST['submit'])){
    $plat = $_POST['plat'];
    $jenis = $_POST['jenis'];
    $masalah = $_POST['masalah'];
    $insert = mysqli_query($conn, "INSERT INTO service VALUES ('$id', '$id_pelanggan', 'MO1', '$date', '$nama_pelanggan', '', 
                            '$plat', '$jenis', '$masalah', '', '', '', 'Pemesanan');");
    header("Location:UserBooking.php");
    ob_end_flush();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Pelanggan</title>
    <link rel="stylesheet" href="styleUser.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>
<body>
    <div class="header">
        <div class="brand">Bengkel Konoha</div>
        <a href="logout.php" class="logout">Logout</a>
    </div>
    <div class="header-blw">
        <div class="pelanggan">
            <i class='bx bxs-user-circle'></i>
            <a href="#"><?php echo $_SESSION["nama"]; ?></a>
        </div>
        <ul>
            <li><a href="UserInfo.php">Informasi Spare Part</a></li>
            <li><a href="UserBeli.php">Beli Spare Part</a></li>
            <li><a href="UserBooking.php">Booking Service</a></li>
            <li><a href="UserRiwayat.php">Riwayat Service</a></li>
            <li><a href="UserUbah.php">Ubah Password</a></li>
            <li><a href="UserProfil.php">Edit Profil</a></li>
        </ul>
    </div>
    <div class="booking">
        <form action="" method="POST">
            <h2>Booking Service</h2>
            <p>Plat Kendaraan</p>
            <input type="text" class="teks" name="plat" id="plat">
            <p>Jenis Kendaraan</p>
            <select class="form-control" name="jenis" id="jenis">
                <option value="Mobil">Mobil</option>
                <option value="Motor">Motor</option>
            </select>
            <p>Masalah Kendaraan</p>
            <input type="text" class="masalah" name="masalah" id="masalah">
            <center><button class="bookBtn" type="submit" name="submit">Booking</button></center>
        </form>
    </div>
</body>
</html>