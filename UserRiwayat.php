<?php
session_start();
require 'connect.php';
ob_start();
$id = $_SESSION['id'];
$service = mysqli_query($conn, "SELECT * FROM service a 
                        LEFT JOIN pelanggan b on a.id_pelanggan = b.id_pelanggan
                        LEFT JOIN montir c on a.id_montir = c.id_montir WHERE a.id_pelanggan = '$id';");

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
            <a href="#"><?php echo $_SESSION["nama"];?></a>
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
    <div class="riwayat">
        <h2>Riwayat Service</h2>
        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <th scope="col">Id</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Montir</th>
                    <th scope="col">Plat</th>
                    <th scope="col">Jenis</th>
                    <th scope="col">Servis</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Status</th>
                    <th scope="col">Bukti Bayar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($services = mysqli_fetch_array($service)){
                        echo "
                            <tr>
                                <td>".$services['id_service']."</td>
                                <td>".$services['tanggal']."</td>
                                <td>".$services['nama_montir']."</td>
                                <td>".$services['plat_kendaraan']."</td>
                                <td>".$services['jenis_kendaraan']."</td>
                                <td>".$services['service']."</td>
                                <td>".$services['harga']."</td>
                                <td>".$services['status']."</td>";
                                $bayar = $services['bukti_bayar'];
                                $id_service = $services['id_service'];
                                if (!$bayar) {
                                    echo 
                                        "<td>
                                            <form action='' method='post' enctype='multipart/form-data'>
                                                <input type='file' name='gambar' id='gambar'> <br> <br>
                                                <input type='hidden' name='id' id='id' value='$id_service'>
                                                <center><input class='btn btn-primary' type='submit' name='submit' value='Upload'></center>
                                            </form>
                                        </td>";
                                } else {
                                    echo "
                                        <td>
                                            <img src='img/$bayar' width='250'>
                                        </td>";
                                }
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php 
if (isset($_POST['submit'])){
    $id = $_POST['id'];
    $namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

	if( $error === 4 ) {
		echo "<script>
				alert('pilih gambar terlebih dahulu!');
			  </script>";
	}

	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
		echo "<script>
				alert('yang anda upload bukan gambar!');
			  </script>";
	}

	if( $ukuranFile > 1000000 ) {
		echo "<script>
				alert('ukuran gambar terlalu besar!');
			  </script>";
	}

	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    $update = mysqli_query($conn, "UPDATE service SET bukti_bayar = '$namaFileBaru' WHERE id_service = '$id';");
    header("Location: UserRiwayat.php");
    ob_end_flush();
}
?>