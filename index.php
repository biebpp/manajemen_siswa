<?php
    $_SESSION['login'] = false;

    if (isset($_GET['error'])) {
        $error=$_GET['error'];
    } else {
        $error="";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem Manajemen Data Siswa</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2>PANEL LOGIN</h2>
        <hr>

        <?php
            if($error == "invalid") {
                echo ""
                ?>
                    <h3 class="error-control">Username atau Password anda salah!</h3>
                <?php
            ;}
        ?>

        <form action="cek_login.php" method="POST">
            <div class="form-control">
                <input type="text" name="user" placeholder="Masukkan username" required>
            </div>
            <div class="form-control">
                <input type="password" name="pass" placeholder="Masukkan password" required>
            </div>
            <div class="form-control">
                <button class="login-btn" type="submit">LOGIN</button>
            </div>
        </form>
    </div>
</body>
</html>