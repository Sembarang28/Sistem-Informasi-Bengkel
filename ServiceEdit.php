<?php 
session_start();
require 'connect.php';
ob_start();
$pelanggan = mysqli_query($conn, "SELECT * FROM pelanggan;");
$montir = mysqli_query($conn, "SELECT * FROM montir;");
$id = $_GET['id_service'];
$result = mysqli_query($conn, "SELECT * FROM service WHERE id_service = '$id';");
while ($results = mysqli_fetch_array($result)){
    $Id_pelanggan = $results['id_pelanggan'];
    $Nama_pelanggan = $results['nama_pelanggan'];
    $Id_montir = $results['id_montir'];
    $Nama_montir = $results['nama_montir'];
    $Plat = $results['plat_kendaraan'];
    $Jenis = $results['jenis_kendaraan'];
    $Masalah = $results['masalah'];
    $Service = $results['service'];
    $Harga = $results['harga'];
    $Bukti_bayar = $results['bukti_bayar'];
    $Status = $results['status'];
}

if (isset($_POST['Submit'])){
    $id_service = $_POST['id_service'];
    $id_pelanggan = $_POST['id_pelanggan'];
    $nama_pelanggan =$_POST['nama_pelanggan'];
    $id_montir = $_POST['id_montir'];
    $nama_montir = $_POST['nama_montir'];
    $plat = $_POST['plat_kendaraan'];
    $jenis = $_POST['jenis_kendaraan'];
    $masalah = $_POST['masalah'];
    $service = $_POST['service'];
    $harga = $_POST['harga'];
    $bukti_bayar = $_POST['bukti_bayar'];
    $status = $_POST['status'];

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

    $update = mysqli_query($conn, "UPDATE service SET id_montir = '$id_montir', nama_montir = '$nama_montir', 
                            masalah = '$masalah', service = '$service', harga = '$harga', bukti_bayar = '$namaFileBaru', 
                            status = '$status'
                            WHERE id_service = '$id_service';");
    
    header("Location:AdminService.php");
    ob_end_flush();
}
?>
<!DOCTYPE html>
<head>
    <title>Edit Service</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="row" style="margin: 50px;">
            <div class="col-md-12 text-center">
                <h4>EDIT SERVICE</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <form action="ServiceEdit.php?id_service<?php echo $id ?>" method="post" name="form1" enctype="multipart/form-data">
                    <table width="100%" class="table-bordered" cellpadding="10">
                        <tr>
                            <td>Id Service</td>
                            <td><input type="text" readonly="" name="id_service" class="form-control" value="<?php echo $id;?>"></td>
                        </tr>
                        <tr>
                            <td>Id Pelanggan</td>
                            <td><input type="text" readonly="" name="id_pelanggan" class="form-control" value="<?php echo $Id_pelanggan; ?>"></td>
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
                            <td><input type="text" class="form-control" name="nama_pelanggan" readonly="" value="<?php echo $Nama_pelanggan; ?>"></td>
                        </tr>
                        <tr>
                            <td>Nama Montir</td>
                            <td><input type="text" class="form-control" name="nama_montir" value="<?php echo $Nama_montir; ?>"></td>
                        </tr>
                        <tr>
                            <td>Plat Kendaraan</td>
                            <td><input type="text" class="form-control" name="plat_kendaraan" readonly="" value="<?php echo $Plat; ?>"></td>
                        </tr>
                        <tr>
                            <td>Jenis Kendaraan</td>
                            <td><input type="text" class="form-control" name="jenis_kendaraan" readonly="" value="<?php echo $Jenis; ?>"></td>
                        </tr>
                        <tr>
                            <td>Masalah</td>
                            <td><input type="text" class="form-control" name="masalah" value="<?php echo $Masalah; ?>"></td>
                        </tr>
                        <tr>
                            <td>Service</td>
                            <td><input type="text" class="form-control" name="service" value="<?php echo $Service; ?>"></td>
                        </tr>
                        <tr>
                            <td>Harga</td>
                            <td><input type="text" class="form-control" name="harga" value="<?php echo $Harga;?>"></td>
                        </tr>
                        <tr>
                            <td>Bukti Bayar</td>
                            <td><input type="file" class="form-control" name="gambar" value="<?php echo $Bukti_bayar ?>"></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                <select name="status" class="form-control">
                                    <option value="Pemesanan">Pemesanan</option>
                                    <option value="Dalam Pengerjaan">Dalam Pengerjaan</option>
                                    <option value="Pembayaran">Pembayaran</option>
                                    <option value="Selesai">Selesai</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" class="form-control btn btn-primary" name="Submit" value="Edit"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</body>
</html>