
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/registrasi.css">
</head>
<body>
<?php
require"function.php";
if(isset($_POST["submit"])){
    $Username= strtolower(stripslashes($_POST["fname"]));
    $Email=$_POST["femail"];
    $Password= mysqli_real_escape_string($koneksi,$_POST["fpassword"]);
    $RePassword= mysqli_real_escape_string($koneksi,$_POST["frepassword"]);

    $result = mysqli_query($koneksi, "SELECT * FROM akun WHERE username='$Username'");
    if(mysqli_fetch_assoc($result)){
        echo "<script>
        alert('username sudah ada, silahkan cari yang lain!);
        document.location.href='registrasi.php';
        </script>";
        return false;

    }
    if ($Password !== $RePassword){
        echo "<script>
        alert('password dan repassword harus sama!');
        document.location.href='registrasi.php';
        </script>";
        return false; 
    };
    // $Password = password_ha/sh($Password,PASSWORD_DEAFULT);

    mysqli_query($koneksi, "INSERT INTO akun VALUES ('','$Username','$Email','$Password')");

    if(mysqli_affected_rows($koneksi)){
        echo "<script>
        alert('akun berhasil dibuat');
        document.location.href='login.php';
        </script>";
    }else{
        echo "<script>
        alert('akun gagal dibuat');
        document.location.href='registrasi.php';
        </script>";
    }
        
    }

?>
    <div class="wrap-card">
    <h1>Registrasi disini</h1>
    <form action="registrasi.php" method="post">
        <div class="card-name">
            <label for="name">Nama</label>
            <input type="text" name="fname" id="name">
        </div>
        <div class="card-name">
            <label for="email">Email</label>
            <input type="text" name="femail" id="name">
        </div>
        <div class="card-name">
            <label for="password">Password</label>
            <input type="password" name="fpassword" id="password">
        </div>
        <div class="card-name">
            <label for="repassword">RePassword</label>
            <input type="password" name="frepassword" id="repassword">
        </div>
        <div class="card-name">
            <button type="submit" name="submit">Register</button>
        </div>
    </form>
    <span>sudah punya akun <a href="login.php">silahkan log in</a></span>
</div>
</body>
</html>
