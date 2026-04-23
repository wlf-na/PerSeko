<?php
session_start();
include('../config/db.php');

if(isset($_POST['daftar'])){
    $nama  = $_POST['nama'];
    $level = $_POST['level'];

    if($level == 'user'){
        $email = $_POST['email'];
        $telp  = $_POST['nohp'];

        $conn->query("INSERT INTO users(nama, email, telp) 
                      VALUES('$nama','$email','$telp')");

        // AUTO LOGIN USER
        $_SESSION['user'] = $nama;
        $_SESSION['level'] = 'user';

        header("Location: ../siswa/dashboard.php");
        exit;

    } else {
        $telp = $_POST['telp'];
        $pass = $_POST['pass'];

        $conn->query("INSERT INTO admin(nama, telp, pass) 
                      VALUES('$nama','$telp','$pass')");

        // AUTO LOGIN ADMIN
        $_SESSION['admin'] = $nama;
        $_SESSION['level'] = 'admin';

        header("Location: ../admin/dashboard.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Registrasi</title>

<link rel="icon" href="/perpustakaan/assets/PerSeko.png" type="image/png">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:#121212;
    color:#fff;
}

.container{
    width:420px;
    background:#1e1e1e;
    padding:30px;
    border-radius:20px;
    box-shadow:0 10px 25px rgba(0,0,0,0.6);
}

h2{
    text-align:center;
    margin-bottom:20px;
}

input, select{
    width:100%;
    padding:12px;
    margin-top:8px;
    margin-bottom:15px;
    border:1px solid #333;
    border-radius:10px;
    background:#121212;
    color:#fff;
}

input:focus, select:focus{
    border-color:#00ff88;
    box-shadow:0 0 8px rgba(0,255,136,0.5);
}

button{
    width:100%;
    padding:12px;
    background:#00ff88;
    border:none;
    border-radius:10px;
    font-weight:600;
    cursor:pointer;
}

button:hover{
    box-shadow:0 0 10px rgba(0,255,136,0.6);
}

/* hide form */
#formUser, #formAdmin{
    display:none;
}
</style>
</head>

<body>

<div class="container">

<h2>Registrasi</h2>

<form method="POST">

Nama
<input type="text" name="nama" required>

Pilih Daftar Sebagai
<select name="level" id="level" onchange="tampilForm()" required>
    <option value="">-- Pilih --</option>
    <option value="user">Siswa</option>
    <option value="admin">Admin</option>
</select>

<!-- USER -->
<div id="formUser">
    Email
    <input type="email" name="email">

    No HP
    <input type="text" name="nohp">
</div>

<!-- ADMIN -->
<div id="formAdmin">
    No Telepon
    <input type="text" name="telp">

    Password
    <input type="password" name="pass">
</div>

<button name="daftar">Daftar</button>

</form>

</div>

<script>
function tampilForm(){
    let level = document.getElementById("level").value;

    document.getElementById("formUser").style.display = "none";
    document.getElementById("formAdmin").style.display = "none";

    if(level == "user"){
        document.getElementById("formUser").style.display = "block";
    } 
    else if(level == "admin"){
        document.getElementById("formAdmin").style.display = "block";
    }
}
</script>

</body>
</html>