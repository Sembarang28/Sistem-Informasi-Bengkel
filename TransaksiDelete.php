<?php
ob_start();
require 'connect.php';

$id_transaksi = $_GET['id_transaksi'];
$delete = mysqli_query($conn, "DELETE FROM transaksi WHERE id_transaksi = '$id_transaksi';");

header("Location: AdminTransaksi.php");
ob_end_flush();
?>