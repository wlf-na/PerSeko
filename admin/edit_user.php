<?php
require_once('../config/db.php');

// cek koneksi
if(!$conn){
    die("Koneksi database gagal");
}

// cek id
if(!isset($_GET['id'])){
    die("ID tidak ditemukan");
}

$id = $_GET['id'];

// ambil data
$data = $conn->query("SELECT * FROM users WHERE id='$id'");
$u = $data->fetch_assoc();

if(isset($_POST['update'])){

    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $email = $_POST['email'];

    $update = $conn->query("
        UPDATE users SET
        nama='$nama',
        telp='$telp',
        email='$email'
        WHERE id='$id'
    ");

    if(!$update){
        die("Update gagal: " . $conn->error);
    }

    header("Location: user_data.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit User</title>
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

<h2>Edit User</h2>

<form method="POST">

<label>Nama</label>
<input type="text" name="nama" value="<?= $u['nama']; ?>" required>

<label>Telepon</label>
<input type="text" name="telp" value="<?= $u['telp']; ?>" required>

<label>Email</label>
<input type="email" name="email" value="<?= $u['email']; ?>" required>

<button type="submit" name="update">Update</button>

</form>

</div>

</body>
</html>