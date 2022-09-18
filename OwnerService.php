<?php 
session_start();
require 'connect.php';
$service = mysqli_query($conn,"SELECT * FROM service a 
                        LEFT JOIN pelanggan b on a.id_pelanggan = b.id_pelanggan
                        LEFT JOIN montir c on a.id_montir = c.id_montir");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
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
            <a href="#"><?php echo $_SESSION['nama'];?></a>
        </div>
        <ul>
            <li><a href="OwnerPart.php">Lihat Data Spare Part</a></li>
            <li><a href="OwnerLihat.php">Lihat Data Transaksi</a></li>
            <li><a href="OwnerService.php">Lihat Data Service</a></li>
        </ul>
    </div>
    <div class="riwayat">
        <h2>Lihat Data Service</h2>
        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <td>Id</td>
                    <td>Pelanggan</td>
                    <td>Montir</td>
                    <td>Tanggal</td>
                    <td>Plat Kendaraan</td>
                    <td>Jenis Kendaraan</td>
                    <td>Masalah</td>
                    <td>Service</td>
                    <td>Harga</td>
                    <td>Bukti Bayar</td>
                    <td>Status</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($services = mysqli_fetch_array($service)){
                        echo "
                            <tr>
                                <td>".$services['id_service']."</td>
                                <td>".$services['nama_pelanggan']."</td>
                                <td>".$services['nama_montir']."</td>
                                <td>".$services['tanggal']."</td>
                                <td>".$services['plat_kendaraan']."</td>
                                <td>".$services['jenis_kendaraan']."</td>
                                <td>".$services['masalah']."</td>
                                <td>".$services['service']."</td>
                                <td>".$services['harga']."</td>
                                <td>".$services['bukti_bayar']."</td>
                                <td>".$services['status']."</td>
                            </tr>
                        ";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>