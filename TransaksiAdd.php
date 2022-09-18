<?php 
session_start();
require 'connect.php';
ob_start();

if (isset($_POST['Submit'])){
    $transaksi = mysqli_query($conn, "SELECT * FROM transaksi");
    $num = mysqli_num_rows($transaksi);
    $id_transaksi = "TR";
    $id_transaksi .= $num + 1;
    $id_pelanggan = $_POST['id_pelanggan'];
    $id_sparepart = $_POST['id_sparepart'];
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $nama_barang = $_POST['nama_barang'];
    $qty = $_POST['qty'];
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


    $insert = mysqli_query($conn, "INSERT INTO transaksi VALUES ('$id_transaksi', '$id_pelanggan','$id_sparepart',
                            '$nama_pelanggan', '$nama_barang', '$qty', '$harga', '$namaFileBaru');");
    
    header("Location:AdminTransaksi.php");
    ob_end_flush();
}
?>
<!DOCTYPE html>
<head>
    <title>Tambah Transaksi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="row" style="margin: 50px;">
            <div class="col-md-12 text-center">
                <h4>TAMBAH TRANSAKSI</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <form action="" method="post" name="form1" enctype="multipart/form-data">
                    <table width="100%" class="table-bordered" cellpadding="10">
                        <tr>
                            <td>Id Pelanggan</td>
                            <td><input type="text" name="id_pelanggan" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Id Sparepart</td>
                            <td><input type="text" name="id_sparepart" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Nama Pelanggan</td>
                            <td><input type="text" class="form-control" name="nama_pelanggan"></td>
                        </tr>
                        <tr>
                            <td>Nama Barang</td>
                            <td><input type="text" class="form-control" name="nama_barang"></td>
                        </tr>
                        <tr>
                            <td>Qty</td>
                            <td><input type="text" class="form-control" name="qty"></td>
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