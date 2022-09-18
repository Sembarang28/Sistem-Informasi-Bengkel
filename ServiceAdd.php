<?php 
session_start();
require 'connect.php';
ob_start();
$pelanggan = mysqli_query($conn, "SELECT * FROM pelanggan;");
$montir = mysqli_query($conn, "SELECT * FROM montir;");

if (isset($_POST['Submit'])){
    $result = mysqli_query($conn, "SELECT * FROM service");
    $num = mysqli_num_rows($result);
    $id = "SR";
    $id .= $num + 1;
    $date = date('Y-m-d');
    $id_pelanggan = $_POST['id_pelanggan'];
    $id_montir = $_POST['id_montir'];
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $nama_montir = $_POST['nama_montir'];
    $plat = $_POST['plat_kendaraan'];
    $jenis = $_POST['jenis_kendaraan'];
    $masalah = $_POST['masalah'];
    $service = $_POST['service'];
    $harga = $_POST['harga'];

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

    $status = "Pemesanan";


    $insert = mysqli_query($conn, "INSERT INTO service VALUES ('$id','$id_pelanggan','$id_montir','$date',
                            '$nama_pelanggan','$nama_montir','$plat','$jenis','$masalah','$service','$harga',
                            '$namaFileBaru','$status');");
    
    header("Location:AdminService.php");
    ob_end_flush();
}
?>
<!DOCTYPE html>
<head>
    <title>Tambah Service</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="row" style="margin: 50px;">
            <div class="col-md-12 text-center">
                <h4>TAMBAH SERVICE</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <form action="ServiceAdd.php" method="post" name="form1" enctype="multipart/form-data">
                    <table width="100%" class="table-bordered" cellpadding="10">
                        <tr>
                            <td>Id Pelanggan</td>
                            <td><input type="text" name="id_pelanggan" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Id Montir</td>
                            <td>
                                <select class="form-control" name="id_montir">
                                    <?php  
                                        while($montirs = mysqli_fetch_array($montir)){
                                            echo "
                                                <option value=".$montirs['id_montir'].">".$montirs['nama_montir']."</option>
                                            ";
                                        } 
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Pelanggan</td>
                            <td><input type="text" class="form-control" name="nama_pelanggan"></td>
                        </tr>
                        <tr>
                            <td>Nama Montir</td>
                            <td><input type="text" class="form-control" name="nama_montir"></td>
                        </tr>
                        <tr>
                            <td>Plat Kendaraan</td>
                            <td><input type="text" class="form-control" name="plat_kendaraan"></td>
                        </tr>
                        <tr>
                            <td>Jenis Kendaraan</td>
                            <td>
                                <select class="form-control" name="jenis_kendaraan">
                                    <option value="Mobil">Mobil</option>
                                    <option value="Motor">Motor</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Masalah</td>
                            <td><input type="text" class="form-control" name="masalah"></td>
                        </tr>
                        <tr>
                            <td>Service</td>
                            <td><input type="text" class="form-control" name="service"></td>
                        </tr>
                        <tr>
                            <td>Harga</td>
                            <td><input type="text" class="form-control" name="harga"></td>
                        </tr>
                        <tr>
                            <td>Bukti Bayar</td>
                            <td><input type="file" class="form-control" name="gambar"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><button type="submit" class="form-control btn btn-primary" name="Submit">Add</td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</body>
</html>