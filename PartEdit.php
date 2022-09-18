<?php ob_start();?>
<!DOCTYPE html>
<head>
    <title>Edit Spare Part</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        include_once("connect.php");
        $id = $_GET['id'];
        $part = mysqli_query($conn, "SELECT * FROM sparepart WHERE id_sparepart = '$id'");

        while ($parts = mysqli_fetch_array($part)){
            $nama_barang = $parts['nama_barang'];
            $stok = $parts['stok'];
            $harga = $parts['harga'];
        }
    ?>

    <div class="container">
        <div class="row" style="margin: 50px;">
            <div class="col-md-12 text-center">
                <h4>EDIT SPARE PART</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <form action="PartEdit.php?id=<?php echo $id ?>" method="post" name="form1">
                    <table width="100%" class="table-bordered" cellpadding="10">
                        <tr>
                            <td>Id</td>
                            <td><input type="text" readonly="" class="form-control" name="id_sparepart" value="<?php echo $id; ?>"></td>
                        </tr>
                        <tr>
                            <td>Nama Barang</td>
                            <td><input type="text" class="form-control" name="nama_barang" value="<?php echo $nama_barang; ?>"></td>
                        </tr>
                        <tr>
                            <td>Stok</td>
                            <td><input type="number" class="form-control" name="stok" value="<?php echo $stok; ?>"></td>
                        </tr>
                        <tr>
                            <td>Harga</td>
                            <td><input type="number" class="form-control" name="harga" value="<?php echo $harga; ?>"></td>
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
        $id_sparepart = $_POST['id_sparepart'];
        $nama_barang = $_POST['nama_barang'];
        $stok = $_POST['stok'];
        $harga = $_POST['harga'];

        $result = mysqli_query($conn, "UPDATE sparepart SET nama_barang = '$nama_barang', stok = '$stok', harga = '$harga'
                                WHERE id_sparepart = '$id_sparepart';");
        
        header("Location: AdminPart.php");
        ob_end_flush();
    }
?>