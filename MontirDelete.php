<?php
ob_start();
require 'connect.php';

$id_montir = $_GET['id_montir'];
$delete = mysqli_query($conn, "DELETE FROM montir WHERE id_montir = '$id_montir';");

header("Location: AdminMontir.php");
ob_end_flush();
?>