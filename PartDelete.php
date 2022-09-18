<?php
ob_start();
require 'connect.php';

$id_sparepart = $_GET['id_sparepart'];
$delete = mysqli_query($conn, "DELETE FROM sparepart WHERE id_sparepart = '$id_sparepart';");

header("Location: AdminPart.php");
ob_end_flush();
?>