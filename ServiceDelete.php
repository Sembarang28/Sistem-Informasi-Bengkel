<?php
ob_start();
require 'connect.php';

$id_service = $_GET['id_service'];
$delete = mysqli_query($conn, "DELETE FROM service WHERE id_service = '$id_service';");

header("Location: AdminService.php");
ob_end_flush();
?>