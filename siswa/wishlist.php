<?php
session_start();
include('../config/db.php');

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Wishlist</title>
<link rel="icon" href="assets/PerSeko.png" type="image/png">
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

/* BACKGROUND */
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

/* PROFILE */
.profile {
    text-align: center;
    margin-bottom: 30px;
}

/* NEON BOOK LOGO */
.book-logo {
    width: 70px;
    height: 70px;
    margin: auto;
    margin-bottom: 10px;
}

.book-logo svg {
    width: 100%;
    height: 100%;
    filter:
        drop-shadow(0 0 5px #00ff88)
        drop-shadow(0 0 12px #00ff88)
        drop-shadow(0 0 20px #00ff88);
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

/* LOGOUT BUTTON RED */
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

/* CONTAINER */
.container {
    display: flex;
    flex-wrap: wrap;
    gap: 25px;
}

/* CARD */
.card {
    width: 220px;
    background: #1e1e1e;
    border-radius: 15px;
    padding: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.6);
    transition: 0.3s;
}

.card:hover {
    transform: translateY(-5px);
}

.card img {
    width: 100%;
    height: 260px;
    object-fit: cover;
    border-radius: 10px;
}

.card h4 {
    margin: 10px 0 5px;
    color: #fff;
}

.card p {
    font-size: 13px;
    color: #bbb;
}

/* BUTTON */
.btn {
    display: inline-block;
    margin-top: 8px;
    padding: 7px 10px;
    border-radius: 8px;
    font-size: 12px;
    text-decoration: none;
    color: #000;
    background: #00ff88;
    font-weight: 600;
    transition: 0.3s;
}

.btn:hover {
    box-shadow: 0 0 10px rgba(0,255,136,0.6);
}

.btn.secondary {
    background: transparent;
    color: #00ff88;
    border: 1px solid #00ff88;
}

/* FIX LINK SPACING */
.card a {
    margin-right: 5px;
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <div class="profile">

        <!-- NEON BOOK LOGO -->
        <div class="book-logo">
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
        <a href="wishlist.php" class="active">Wishlist</a>
        <a href="riwayat.php">Riwayat</a>
        <a href="status.php">Status</a>
    </div>

</div>

<!-- MAIN -->
<div class="main">

    <div class="topbar">
        <h2>Wishlist Saya</h2>
        <a href="logout.php" class="logout">Logout</a>
    </div>

    <div class="container">

<?php
$data = $conn->query("
SELECT buku.* FROM wishlist
JOIN buku ON wishlist.buku_id = buku.id
WHERE wishlist.user='$user'
");

while($d = $data->fetch_assoc()){
?>

<div class="card">
    <img src="../assets/uploads/<?= $d['cover']; ?>">

    <h4><?= $d['judul']; ?></h4>
    <p>Penulis: <?= $d['penulis']; ?></p>
    <p>Tahun: <?= $d['tahun_terbit']; ?></p>
    <p>Stok: <?= $d['stok']; ?></p>

    <a class="btn" href="../assets/uploads/<?= $d['file_buku']; ?>" target="_blank">📖 Baca</a>
    <a class="btn" href="pinjam.php?id=<?= $d['id']; ?>">Pinjam</a>
    <a class="btn secondary" href="hapus_wishlist.php?id=<?= $d['id']; ?>">Hapus</a>
</div>

<?php } ?>

    </div>

</div>

</body>
</html>