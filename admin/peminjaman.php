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
<title>Data Peminjaman</title>
<link rel="icon" href="assets/PerSeko.png" type="image/png">
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

/* LOGO NEON BOOK */
.logo-book{
    width:70px;
    height:70px;
    margin:auto;
    margin-bottom:10px;
}

.logo-book svg{
    width:100%;
    height:100%;
    filter:
        drop-shadow(0 0 6px #00ff88)
        drop-shadow(0 0 12px #00ff88);
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
    transition:0.3s;
}

.menu a:hover{
    background:#00ff88;
    color:#000;
}

/* MAIN */
.main{
    flex:1;
    padding:30px;
    position:relative;
}

/* TOPBAR */
.topbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.topbar h2{
    color:#fff;
}

/* LOGOUT */
.logout{
    background:#ff3b3b;
    color:#fff;
    padding:10px 18px;
    border-radius:10px;
    text-decoration:none;
    font-weight:600;
}

.logout:hover{
    background:#e60000;
}

/* BUTTON */
.btn{
    background:#00ff88;
    color:#000;
    padding:10px 15px;
    border-radius:10px;
    text-decoration:none;
    font-weight:600;
    display:inline-block;
    margin-bottom:15px;
}

/* CARD */
.card{
    background:#1e1e1e;
    padding:25px;
    border-radius:20px;
    box-shadow:0 10px 25px rgba(0,0,0,0.6);
}

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
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
    border-bottom:1px solid #333;
}

tr:hover{
    background:#1a1a1a;
}

/* ACTION */
.action a{
    margin:0 5px;
    color:#00ff88;
    text-decoration:none;
}

/* FOOTER */
.footer{
    position:absolute;
    bottom:10px;
    left:50%;
    transform:translateX(-50%);
    color:#777;
    font-size:13px;
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
                <path d="M4 5C4 4 5 3 6 3H18C19 3 20 4 20 5V19C20 20 19 21 18 21H6C5 21 4 20 4 19V5Z"
                      stroke="#00ff88" stroke-width="2"/>
                <path d="M8 3V21" stroke="#00ff88" stroke-width="2"/>
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

<div class="topbar">
    <h2>Data Peminjaman</h2>
    <a class="logout" href="logout.php">Logout</a>
</div>

<a class="btn" href="tambah_peminjaman.php">+ Tambah Peminjaman</a>

<div class="card">

<table>
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>Judul Buku</th>
    <th>Status</th>
    <th>Tanggal Pinjam</th>
    <th>Tanggal Kembali</th>
    <th>Aksi</th>
</tr>

<?php
$no = 1;

$data = $conn->query("
SELECT peminjaman.*, buku.judul 
FROM peminjaman 
JOIN buku ON peminjaman.buku_id = buku.id
ORDER BY peminjaman.id DESC
");

while($d = $data->fetch_assoc()){
?>

<tr>
    <td><?= $no++; ?></td>
    <td><?= $d['user']; ?></td>
    <td><?= $d['judul']; ?></td>
    <td><?= $d['status']; ?></td>
    <td><?= $d['tanggal_pinjam']; ?></td>
    <td><?= $d['tanggal_kembali']; ?></td>
    <td class="action">

        <?php if($d['status'] == 'dipinjam'){ ?>
            <a href="kembali.php?id=<?= $d['id']; ?>">Kembalikan</a>
        <?php } else { ?>
            <span>-</span>
        <?php } ?>

        <a href="edit_peminjaman.php?id=<?= $d['id']; ?>">Edit</a>
        <a href="hapus_peminjaman.php?id=<?= $d['id']; ?>" onclick="return confirm('Hapus data?')">Hapus</a>

    </td>
</tr>

<?php } ?>

</table>

</div>

<div class="footer">
    © 2026 Perpustakaan Digital
</div>

</div>

</body>
</html>