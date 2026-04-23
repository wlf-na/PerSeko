<?php
session_start();
require_once('../config/db.php');
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Kelola Buku</title>
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

/* LOGO */
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
}

/* LOGOUT BUTTON */
.logout{
    position:absolute;
    right:30px;
    top:25px;
    background:#ff4d4d;
    color:#fff;
    padding:10px 18px;
    border-radius:10px;
    text-decoration:none;
    font-weight:600;
    transition:0.3s;
}

.logout:hover{
    background:#e60000;
    box-shadow:0 0 10px rgba(255,0,0,0.6);
}

/* TITLE */
.page-title{
    font-size:22px;
    font-weight:600;
    color:#ffffff;
    margin-bottom:15px;
}

/* CARD */
.card{
    background:#1e1e1e;
    padding:25px;
    border-radius:20px;
    box-shadow:0 10px 25px rgba(0,0,0,0.6);
}

/* BUTTON */
.btn{
    background:#00ff88;
    color:#000;
    padding:10px 15px;
    border-radius:10px;
    text-decoration:none;
    transition:0.3s;
    display:inline-block;
    margin-bottom:15px;
    font-weight:600;
}

.btn:hover{
    box-shadow:0 0 10px rgba(0,255,136,0.6);
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
    color:#cccccc;
}

tr:hover{
    background:#1a1a1a;
}

img{
    border-radius:5px;
}

/* LINK */
a{
    color:#00ff88;
    text-decoration:none;
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="profile">

        <!-- LOGO NEON -->
        <div class="logo-book">
            <svg viewBox="0 0 24 24" fill="none">
                <path d="M4 5C4 4 5 3 6 3H16C17 3 18 4 18 5V19C18 20 17 21 16 21H6C5 21 4 20 4 19V5Z"
                      stroke="#00ff88" stroke-width="2"/>
                <line x1="8" y1="3" x2="8" y2="21"
                      stroke="#00ff88" stroke-width="2"/>
                <line x1="10" y1="7" x2="16" y2="7"
                      stroke="#00ff88" stroke-width="1"/>
                <line x1="10" y1="11" x2="16" y2="11"
                      stroke="#00ff88" stroke-width="1"/>
                <line x1="10" y1="15" x2="16" y2="15"
                      stroke="#00ff88" stroke-width="1"/>
            </svg>
        </div>

        <h4>Admin</h4>
    </div>

    <div class="menu">
        <a href="dashboard.php"> Dashboard</a>
        <a href="buku.php"> Data Buku</a>
        <a href="peminjaman.php"> Peminjaman</a>
        <a href="admin_data.php"> Data Admin</a>
        <a href="user_data.php"> Data Siswa</a>
        <a href="laporan.php"> Laporan</a>
    </div>
</div>

<!-- MAIN -->
<div class="main">

<!-- LOGOUT -->
<a href="logout.php" class="logout">Logout</a>

<!-- TITLE -->
<div class="page-title">Kelola Buku</div>

<!-- CARD -->
<div class="card">

    <a class="btn" href="tambah_buku.php">+ Tambah Buku</a>

    <h3 style="color:#ffffff;">Data Buku</h3>

    <table>
        <tr>
            <th>No</th>
            <th>Cover</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Penerbit</th>
            <th>Tahun</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;
        $data = $conn->query("SELECT * FROM buku");

        if(!$data){
            die("Query error: " . $conn->error);
        }

        while($b = $data->fetch_assoc()){
        ?>

        <tr>
            <td><?= $no++; ?></td>
            <td><img src="../assets/uploads/<?= $b['cover']; ?>" width="60"></td>
            <td><?= $b['judul']; ?></td>
            <td><?= $b['penulis']; ?></td>
            <td><?= $b['penerbit']; ?></td>
            <td><?= $b['tahun_terbit']; ?></td>
            <td><?= $b['stok']; ?></td>
            <td>
                <a href="edit_buku.php?id=<?= $b['id']; ?>">Edit</a> |
                <a href="hapus_buku.php?id=<?= $b['id']; ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
            </td>
        </tr>

        <?php } ?>

    </table>

</div>

</div>

</body>
</html>