<?php 
session_start();
require 'connect.php';
ob_start();

if (isset($_POST['Submit'])){
    $result = mysqli_query($conn, "SELECT * FROM sparepart");
    $num = mysqli_num_rows($result);
    $id = "MO";
    $id .= $num;
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $hp = $_POST['hp'];

    $insert = mysqli_query($conn, "INSERT INTO montir VALUES ('$id','$nama','$alamat','$hp');");
    
    header("Location:AdminMontir.php");
    ob_end_flush();
}
?>
<!DOCTYPE html>
<head>
    <title>Tambah Montir</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="row" style="margin: 50px;">
            <div class="col-md-12 text-center">
                <h4>TAMBAH MONTIR</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <form action="" method="post" name="form1">
                    <table width="100%" class="table-bordered" cellpadding="10">
                        <tr>
                            <td>Nama</td>
                            <td><input type="text" class="form-control" name="nama"></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td><input type="text" class="form-control" name="alamat"></td>
                        </tr>
                        <tr>
                            <td>HP</td>
                            <td><input type="text" class="form-control" name="hp"></td>
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