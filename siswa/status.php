<?php
session_start();
include('../config/db.php');

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Status Peminjaman</title>
<link rel="icon" href="assets/PerSeko.png" type="image/png">
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    display: flex;
    background: #121212;
}

/* SIDEBAR */
.sidebar {
    width: 240px;
    height: 100vh;
    background: #1e1e1e;
    padding: 25px 20px;
    box-shadow: 5px 0 20px rgba(0,0,0,0.5);
}

.profile {
    text-align: center;
    margin-bottom: 30px;
}

/* LOGO NEON BOOK (KONSISTEN SEMUA HALAMAN) */
.logo-book {
    width: 70px;
    height: 70px;
    margin: auto;
    margin-bottom: 10px;
}

.logo-book svg {
    width: 100%;
    height: 100%;
    filter:
        drop-shadow(0 0 6px #00ff88)
        drop-shadow(0 0 12px #00ff88)
        drop-shadow(0 0 18px #00ff88);
}

.profile h4 {
    color: #fff;
}

/* MENU */
.menu a {
    display: block;
    padding: 12px;
    margin-bottom: 10px;
    text-decoration: none;
    color: #00ff88;
    border-radius: 10px;
    transition: 0.3s;
}

.menu a:hover {
    background: #00ff88;
    color: #000;
}

.menu a.active {
    background: #00ff88;
    color: #000;
    font-weight: 600;
}

/* MAIN */
.main {
    flex: 1;
    padding: 30px;
}

/* TOPBAR */
.topbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.topbar h2 {
    color: #fff;
}

/* LOGOUT BUTTON */
.logout {
    padding: 10px 16px;
    background: #ff3b3b;
    color: #fff;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    transition: 0.3s;
}

.logout:hover {
    background: #e60000;
    box-shadow: 0 0 12px rgba(255,0,0,0.6);
}

/* TABLE */
.table-container {
    background: #1e1e1e;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.6);
}

table {
    width: 100%;
    border-collapse: collapse;
}

th {
    background: #262626;
    padding: 12px;
    text-align: left;
    color: #00ff88;
}

td {
    padding: 12px;
    border-bottom: 1px solid #333;
    font-size: 14px;
    color: #ccc;
}

tr:hover {
    background: #1a1a1a;
}

/* STATUS BADGE */
.status {
    padding: 5px 10px;
    border-radius: 8px;
    font-size: 12px;
    color: #000;
    font-weight: 600;
}

.status.dipinjam {
    background: #f39c12;
}

.status.dikembalikan {
    background: #00ff88;
}

/* BUTTON */
.btn {
    padding: 6px 10px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 12px;
    color: #000;
    background: #00ff88;
    font-weight: 600;
    transition: 0.3s;
}

.btn:hover {
    box-shadow: 0 0 10px rgba(0,255,136,0.6);
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <div class="profile">

        <!-- LOGO KONSISTEN -->
        <div class="logo-book">
            <svg viewBox="0 0 24 24" fill="none">
                <path d="M4 5C4 4 5 3 6 3H18C19 3 20 4 20 5V20C20 21 19 22 18 22H6C5 22 4 21 4 20V5Z"
                      stroke="#00ff88" stroke-width="2"/>
                <path d="M8 3V22"
                      stroke="#00ff88" stroke-width="2"/>
                <path d="M10 8H17"
                      stroke="#00ff88" stroke-width="1.5"/>
                <path d="M10 12H17"
                      stroke="#00ff88" stroke-width="1.5"/>
                <path d="M10 16H17"
                      stroke="#00ff88" stroke-width="1.5"/>
            </svg>
        </div>

        <h4>Siswa</h4>
    </div>

    <div class="menu">
        <a href="dashboard.php">Dashboard</a>
        <a href="wishlist.php">Wishlist</a>
        <a href="riwayat.php">Riwayat</a>
        <a href="status.php" class="active">Status</a>
    </div>

</div>

<!-- MAIN -->
<div class="main">

    <div class="topbar">
        <h2>Status Peminjaman</h2>
        <a href="logout.php" class="logout">Logout</a>
    </div>

    <div class="table-container">
        <table>
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>

<?php
$no = 1;

$data = $conn->query("
SELECT buku.*, peminjaman.id as id_pinjam, peminjaman.status
FROM peminjaman
JOIN buku ON peminjaman.buku_id = buku.id
WHERE peminjaman.user='$user'
");

while($d = $data->fetch_assoc()){

    $statusClass = ($d['status'] == 'dikembalikan') ? 'dikembalikan' : 'dipinjam';
?>

<tr>
    <td><?= $no++; ?></td>
    <td><?= $d['judul']; ?></td>
    <td><span class="status <?= $statusClass ?>"><?= $d['status']; ?></span></td>

    <td>
        <?php if($d['status'] == 'dipinjam'){ ?>
            <a class="btn" href="kembalikan.php?id=<?= $d['id_pinjam']; ?>" onclick="return confirm('Yakin kembalikan buku?')">
                Kembalikan
            </a>
        <?php } else { ?>
            -
        <?php } ?>
    </td>
</tr>

<?php } ?>

        </table>
    </div>

</div>

</body>
</html>