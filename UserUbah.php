<?php 
session_start();
require 'connect.php';
ob_start();
$id = $_SESSION['id'];

if (isset($_POST['submit'])){
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];

    if($pass1 == $pass2) {
        $update = mysqli_query($conn, "UPDATE pelanggan SET password = '$pass1' WHERE id_pelanggan = '$id';");

        header("Location: UserRiwayat.php");
        ob_end_flush();
    } else {
        header("Location:UserUbah.php");
    }
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
</head>
<body>
    <div class="header">
        <div class="brand">Bengkel Konoha</div>
        <a href="logout.php" class="logout">Logout</a>
    </div>
    <div class="header-blw">
        <div class="pelanggan">
            <i class='bx bxs-user-circle'></i>
            <a href="#"><?php echo $_SESSION['nama']?></a>
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
            <h2>Ubah Password</h2>
            <p>Masukkan Password Baru</p>
            <input type="text" class="teks" name="pass1">
            <p>Konfirmasi Password Baru</p>
            <input type="text" class="teks" name="pass2">
            <center><button class="bookBtn" name="submit" type="submit">Ubah Password</button></center>
        </form>
    </div>
</body>
</html>