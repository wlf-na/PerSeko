<?php
session_start();
include('../config/db.php');

if(isset($_POST['login'])){
    $nama = $_POST['nama'];
    $pass = $_POST['pass'];

    // AMAN: cek kolom sesuai DB (pass)
    $q = $conn->query("SELECT * FROM admin WHERE nama='$nama' AND pass='$pass'");

    if($q && $q->num_rows > 0){
        $data = $q->fetch_assoc();

        $_SESSION['admin'] = $data['nama'];
        $_SESSION['level'] = 'admin';

        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Login gagal! nama atau password salah";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login Admin</title>

<link rel="icon" href="../assets/PerSeko.png" type="image/png">

<style>
body{
    margin:0;
    font-family:Poppins,sans-serif;
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:#121212;
}

.container{
    width:400px;
    padding:40px;
    background:#1e1e1e;
    border-radius:20px;
    text-align:center;
    box-shadow:0 10px 25px rgba(0,0,0,0.6);
}

h2{color:white}

.input-group{
    text-align:left;
    margin-bottom:15px;
}

label{color:#ccc;font-size:14px}

input{
    width:100%;
    padding:12px;
    margin-top:6px;
    border-radius:10px;
    border:1px solid #333;
    background:#121212;
    color:#fff;
}

input:focus{
    border-color:#00ff88;
    outline:none;
}

.btn{
    width:100%;
    padding:12px;
    border:none;
    border-radius:10px;
    background:#00ff88;
    font-weight:bold;
    cursor:pointer;
}

.btn:hover{box-shadow:0 0 10px #00ff88}

.error{color:red;margin-bottom:10px}
</style>
</head>

<body>

<div class="container">

    <h2>Login Admin</h2>

    <?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>

    <form method="POST">

        <div class="input-group">
            <label>Nama</label>
            <input type="text" name="nama" required>
        </div>

        <div class="input-group">
            <label>Password</label>
            <!-- 🔥 FIX PENTING -->
            <input type="password" name="pass" required>
        </div>

        <button class="btn" name="login">Masuk</button>

    </form>

</div>

</body>
</html>