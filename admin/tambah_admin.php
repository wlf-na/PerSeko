<?php
require_once('../config/db.php');

if(isset($_POST['simpan'])){
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];

    $conn->query("INSERT INTO admin (nama, telp)
                  VALUES('$nama','$telp')");

    header("Location: admin_data.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Admin</title>
<link rel="icon" href="assets/PerSeko.png" type="image/png">
<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
    background:#121212;
}

/* CARD */
.container{
    width:420px;
    background:#1e1e1e;
    padding:30px;
    border-radius:20px;
    box-shadow:0 10px 25px rgba(0,0,0,0.6);
}

/* TITLE */
h2{
    text-align:center;
    margin-bottom:20px;
    color:#fff;
}

/* LABEL */
label{
    font-size:14px;
    color:#ccc;
}

/* INPUT */
input{
    width:100%;
    padding:12px;
    margin-top:8px;
    margin-bottom:15px;
    border:1px solid #333;
    border-radius:10px;
    outline:none;
    background:#121212;
    color:#fff;
}

/* INPUT FOCUS */
input:focus{
    border-color:#00ff88;
    box-shadow:0 0 6px rgba(0,255,136,0.3);
}

/* BUTTON */
button{
    width:100%;
    padding:12px;
    background:#00ff88;
    color:#000;
    border:none;
    border-radius:10px;
    cursor:pointer;
    font-weight:600;
    transition:0.3s;
}

button:hover{
    box-shadow:0 0 10px rgba(0,255,136,0.6);
}
</style>
</head>

<body>

<div class="container">

<h2>Tambah Admin</h2>

<form method="POST">

<label>Nama</label>
<input type="text" name="nama" required>

<label>Telepon</label>
<input type="text" name="telp" required>

<button name="simpan">Simpan</button>

</form>

</div>

</body>
</html>