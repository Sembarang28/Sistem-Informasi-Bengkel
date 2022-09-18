<?php 
session_start();
require 'connect.php';
$part = mysqli_query($conn, "SELECT * FROM sparepart");
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
    <div class="info">
        <h2>Informasi Sparepart</h2>
        <table class="table table-bordered">
            <thead>
                <tr class="text-center fw-bold">
                    <th scope="col">Id</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($parts = mysqli_fetch_array($part)){
                        echo "
                            <tr>
                                <td>".$parts['id_sparepart']."</td>
                                <td>".$parts['nama_barang']."</td>
                                <td>".$parts['stok']."</td>
                                <td>".$parts['harga']."</td>
                            </tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>