<?php
session_start();
include('../config/db.php');

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Siswa</title>
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
    background:#121212;
}

/* SIDEBAR */
.sidebar{
    width:240px;
    height:100vh;
    background:#1e1e1e;
    padding:25px 20px;
    box-shadow:5px 0 20px rgba(0,0,0,0.5);
}

.profile{
    text-align:center;
    margin-bottom:30px;
}

.logo-book{
    width:60px;
    height:60px;
    margin:auto;
    margin-bottom:10px;
}

.logo-book svg{
    width:100%;
    height:100%;
    filter:drop-shadow(0 0 6px #00ff88);
}

.profile h4{
    color:#ffffff;
}

/* MENU */
.menu a{
    display:block;
    padding:12px;
    margin-bottom:10px;
    text-decoration:none;
    color:#00ff88;
    border-radius:10px;
}

.menu a:hover{
    background:#00ff88;
    color:#000;
}

/* MAIN */
.main{
    flex:1;
    padding:30px;
    display:flex;
    flex-direction:column;
    min-height:100vh;
}

/* TITLE */
.page-title{
    font-size:22px;
    font-weight:600;
    color:#ffffff;
    margin-bottom:15px;
}

/* FORM CARD */
.card-form{
    background:#1e1e1e;
    padding:20px;
    border-radius:20px;
    box-shadow:0 10px 25px rgba(0,0,0,0.6);
    margin-bottom:20px;
}

/* INPUT */
input{
    width:100%;
    padding:10px;
    margin:6px 0;
    border:1px solid #333;
    border-radius:8px;
    background:#121212;
    color:#fff;
}

input:focus{
    outline:none;
    border:1px solid #00ff88;
    box-shadow:0 0 5px rgba(0,255,136,0.4);
}

/* BUTTON */
button{
    background:#00ff88;
    color:#000;
    padding:10px 15px;
    border:none;
    border-radius:10px;
    cursor:pointer;
    font-weight:600;
}

button:hover{
    box-shadow:0 0 10px rgba(0,255,136,0.6);
}

/* TABLE CARD */
.card{
    background:#1e1e1e;
    padding:25px;
    border-radius:20px;
    box-shadow:0 10px 25px rgba(0,0,0,0.6);
    flex:1;
}

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
    margin-top:10px;
}

th{
    background:#262626;
    color:#00ff88;
    padding:12px;
}

td{
    padding:10px;
    text-align:center;
    color:#ccc;
}

tr:hover{
    background:#1a1a1a;
}

/* LINK */
a{
    color:#00ff88;
    text-decoration:none;
}

a:hover{
    text-decoration:underline;
}

/* FOOTER */
.footer{
    text-align:center;
    padding:15px;
    color:#888;
    font-size:13px;
    margin-top:10px;
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="profile">

        <!-- LOGO -->
        <div class="logo-book">
            <svg viewBox="0 0 24 24" fill="none">
                <path d="M4 5C4 4 5 3 6 3H16C17 3 18 4 18 5V19C18 20 17 21 16 21H6C5 21 4 20 4 19V5Z"
                      stroke="#00ff88" stroke-width="2"/>
                <line x1="8" y1="3" x2="8" y2="21"
                      stroke="#00ff88" stroke-width="2"/>
            </svg>
        </div>

        <h4>Admin</h4>
    </div>

    <div class="menu">
        <a href="dashboard.php">Dashboard</a>
        <a href="buku.php">Data Buku</a>
        <a href="peminjaman.php">Peminjaman</a>
        <a href="admin_data.php">Data Admin</a>
        <a href="user_data.php">Data Siswa</a>
        <a href="laporan.php">Laporan</a>
    </div>
</div>

<!-- MAIN -->
<div class="main">

<div class="page-title">Data Siswa</div>

<!-- FORM -->
<div class="card-form">
<form method="POST">
    <input name="nama" placeholder="Nama">
    <input name="telp" placeholder="No HP">
    <input name="email" placeholder="Email">
    <button name="tambah">Tambah Siswa</button>
</form>

<?php
if(isset($_POST['tambah'])){
    $conn->query("INSERT INTO users(nama,telp,email)
    VALUES('$_POST[nama]','$_POST[telp]','$_POST[email]')");
    echo "<p style='margin-top:10px;color:#00ff88;'>Siswa berhasil ditambahkan</p>";
}
?>
</div>

<!-- TABLE -->
<div class="card">

<table>
<tr>
    <th>Nama</th>
    <th>Telp</th>
    <th>Email</th>
    <th>Aksi</th>
</tr>

<?php
$data = $conn->query("SELECT * FROM users");

while($d = $data->fetch_assoc()){
?>

<tr>
    <td><?= $d['nama']; ?></td>
    <td><?= $d['telp']; ?></td>
    <td><?= $d['email']; ?></td>
    <td>
        <a href="edit_user.php?id=<?= $d['id']; ?>">Edit</a> |
        <a href="hapus_user.php?id=<?= $d['id']; ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
    </td>
</tr>

<?php } ?>

</table>

</div>

<!-- FOOTER -->
<div class="footer">
    © 2026 Perpustakaan Digital | Dibuat oleh Hasna 💚
</div>

</div>

</body>
</html>