<?php ob_start();?>
<!DOCTYPE html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        include_once("connect.php");
    ?>

    <div class="container">
        <div class="row" style="margin: 50px;">
            <div class="col-md-12 text-center">
                <h4>Register</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <form action="register.php" method="post" name="form1">
                    <table width="100%" class="table-bordered" cellpadding="10">
                        <tr>
                            <td>Username</td>
                            <td><input type="text" class="form-control" name="username"></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><input type="password" class="form-control" name="password"></td>
                        </tr>
                        <tr>
                            <td>Konfirmasi Password</td>
                            <td><input type="password" class="form-control" name="password2"></td>
                        </tr>
                            <td>Nama</td>
                            <td><input type="text" class="form-control" name="nama"></td>
                        </tr>
                        </tr>
                            <td>Alamat</td>
                            <td><input type="text" class="form-control" name="alamat"></td>
                        </tr>
                        <tr>
                            <td>Telepon</td>
                            <td><input type="text" class="form-control" name="telepon"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" class="form-control btn btn-primary" name="Submit" value="Add"></td>
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
        $result = mysqli_query($conn, "SELECT * FROM pelanggan");
        $num = mysqli_num_rows($result);
        $id = "PL";
        $id .= $num + 1;
        $username = $_POST['username'];
        $pass1 = $_POST['password'];
        $pass2 = $_POST['password2'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $telepon = $_POST['telepon'];

        if ($pass1 == $pass2) {
            $insert = mysqli_query($conn, "INSERT INTO pelanggan VALUES ('$id', '$nama', '$username', '$pass2', '$alamat', '$telepon');");
            header("Location:index.php");
            ob_end_flush();
        } else {
            echo "<center>samakan password dan konfirmasi password</center>";
        }
    }
?>