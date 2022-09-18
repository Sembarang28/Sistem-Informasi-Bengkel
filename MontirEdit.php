<?php ob_start();?>
<!DOCTYPE html>
<head>
    <title>Edit Montir</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        include_once("connect.php");
        $id = $_GET['id_montir'];
        $montir = mysqli_query($conn, "SELECT * FROM montir WHERE id_montir = '$id'");

        while ($Montir = mysqli_fetch_array($montir)){
            $nama_montir = $Montir['nama_montir'];
            $alamat = $Montir['alamat'];
            $hp = $Montir['telepon'];
        }
    ?>

    <div class="container">
        <div class="row" style="margin: 50px;">
            <div class="col-md-12 text-center">
                <h4>EDIT MONTIR</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <form action="MontirEdit.php?id_montir=<?php echo $id ?>" method="post" name="form1">
                    <table width="100%" class="table-bordered" cellpadding="10">
                        <tr>
                            <td>Id</td>
                            <td><input type="text" readonly="" class="form-control" name="id_montir" value="<?php echo $id; ?>"></td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td><input type="text" class="form-control" name="nama" value="<?php echo $nama_montir; ?>"></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td><input type="text" class="form-control" name="alamat" value="<?php echo $alamat; ?>"></td>
                        </tr>
                        <tr>
                            <td>HP</td>
                            <td><input type="text" class="form-control" name="hp" value="<?php echo $hp; ?>"></td>
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

<?php 
    if (isset($_POST['Submit'])){
        $id_montir = $_POST['id_montir'];
        $nama_montir = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $hp = $_POST['hp'];

        $result = mysqli_query($conn, "UPDATE montir SET nama_montir = '$nama_montir', alamat = '$alamat', telepon = '$hp'
                                WHERE id_montir = '$id_montir';");
        
        header("Location: AdminMontir.php");
        ob_end_flush();
    }
?>