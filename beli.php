<?php
require 'connect.php';
session_start();
ob_start();

$id_sparepart = $_GET['id_sparepart'];
$part = mysqli_query($conn, "SELECT * FROM sparepart WHERE id_sparepart = '$id_sparepart'");
while ($parts = mysqli_fetch_array($part)){
    $id_sparepart = $parts['id_sparepart'];
    $nama_barang = $parts['nama_barang'];
    $stok = $parts['stok'];
    $harga = $parts ['harga'];
}

$id = $_SESSION["id"];
$orang = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id_pelanggan = '$id'");
while ($people = mysqli_fetch_array($orang)){
    $nama = $people['nama_pelanggan'];
}

$transaksi = mysqli_query($conn, "SELECT * FROM transaksi");
$num = mysqli_num_rows($transaksi);
$id_transaksi = "TR";
$id_transaksi .= $num + 1;

$insert = mysqli_query($conn, "INSERT INTO transaksi VALUES ('$id_transaksi', '$id', '$id_sparepart', '$nama', '$nama_barang', '1', '$harga', '');");
header("Location: UserBeli.php");
ob_end_flush();

?>