<?php
session_start();
require 'connect.php';

if (isset($_POST["loginPL"])){
    $username = $_POST["usernamePL"];
    $password = $_POST["passwordPL"];

    $result = mysqli_query($conn, "SELECT * FROM pelanggan WHERE username = '$username' AND password = '$password'");
    $cek = mysqli_num_rows($result);
    while ($pass = mysqli_fetch_array($result)){
        $id_pelanggan = $pass['id_pelanggan'];
        $nama_pelanggan = $pass['nama_pelanggan'];
    }

    if($cek > 0) {
        $_SESSION["LoginPL"] = true;
        $_SESSION["id"] = $id_pelanggan;
        $_SESSION["nama"] = $nama_pelanggan;
        header("Location: UserRiwayat.php");
        exit;
    }
    $error = true;
}

if (isset($_POST["loginAD"])){
    $username = $_POST["usernameAD"];
    $password = $_POST["passwordAD"];

    $result = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");
    $cek = mysqli_num_rows($result);
    while ($results = mysqli_fetch_array($result)){
        $id_admin = $results['id_admin'];
        $nama = $results['nama'];
    }

    if($cek > 0) {
        $_SESSION["LoginAD"] = true;
        $_SESSION["id"] = $id_admin;
        $_SESSION["nama"] = $nama;
        header("Location: AdminService.php");
        exit;
    }
    $error = true;
}

if (isset($_POST["loginPM"])){
    $username = $_POST["usernamePM"];
    $password = $_POST["passwordPM"];

    $result = mysqli_query($conn, "SELECT * FROM pemilik WHERE username = '$username'");
    $cek = mysqli_num_rows($result);
    while ($results = mysqli_fetch_array($result)){
        $id_pemilik = $results['id_pemilik'];
        $nama = $results['nama'];
    }

    if(mysqli_num_rows($result) == 1) {
        $_SESSION["LoginPM"] = true;
        $_SESSION["id"] = $id_pemilik;
        $_SESSION["nama"] = $nama;
        header("Location: OwnerService.php");
        exit;
    }

    $error = true;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleLogin.css">
    <title>Selamat Datang di Bengkel Online Kami</title>
</head>
<body>
    <header class="header">
        <div>
            <img src="ikon.png" alt="ikon" class="ikon">
            <div class="logo">Bengkel Konoha</div>
        </div>
        <input type="checkbox" id="toggle">
        <label for="toggle">Menu</label>

        <nav class="navigation">
        <ul>
            <li><a href="#">Home</a></li>
            <li>
                <a href="#">Login<i class="arrowdown"></i></a>
            <ul>
                <li><a href="#" id="logUser">Login sebagai Pelanggan</a></li>
                <li><a href="#" id="logAdmin">Login sebagai Admin</a></li>
                <li><a href="#" id="logOwner">Login sebagai Owner</a></li>
            </li>
            </ul>
            </li>
        </ul>
        </nav>
    </header>
    <div class="reg">
        <div class="brand"><img src="ikon.png" alt="brand"></div>
        <h2>Bengkel Konoha</h2>
        <a href="register.php" class="regBtn" id="regBtn">Register</a>
    </div>

    <form action="" method="POST">
        <div class="userLgn">
            <div class="userLgn-content">
                <img src="close.png" alt="Close" class="closeUser">
                <h3 class="hdr-lgn">LOGIN PELANGGAN</h3>
                <p>Username</p>
                <input type="text" name="usernamePL" id="usernamePL">
                <p>Password</p>
                <input type="password" name="passwordPL" id="passwordPL">
                <button type="submit" name="loginPL" class="button">Login</button>
            </div>
        </div>
    </form>

    <form action="" method="POST">
        <div class="adminLgn">
            <div class="adminLgn-content">
                <img src="close.png" alt="Close" class="closeAdmin">
                <h3 class="hdr-lgn">LOGIN ADMIN</h3>
                <p>Username</p>
                <input type="text" name="usernameAD" id="usernameAD">
                <p>Password</p>
                <input type="password" name="passwordAD" id="passwordAD">
                <button type="submit" name="loginAD" class="button">Login</button>
            </div>
        </div>
    </form>

    <form action="" method="POST">
        <div class="ownerLgn">
            <div class="ownerLgn-content">
                <img src="close.png" alt="Close" class="closeOwner">
                <h3 class="hdr-lgn">LOGIN PEMILIK</h3>
                <p>Username</p>
                <input type="text" name="usernamePM" id="usernamePM">
                <p>Password</p>
                <input type="password" name="passwordPM" id="passwordPM">
                <button type="submit" name="loginPM" class="button">Login</button>>
            </div>
        </div>
    </form>
    
</body>
<footer>
    <div class="bottom"></div>
</footer>
<script src="scriptLogin.js"></script>
</html>