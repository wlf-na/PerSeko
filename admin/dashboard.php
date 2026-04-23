<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

include "../config/db.php";

// STATISTIK DATABASE
$jumlah_buku = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total FROM buku"))['total'];
$jumlah_admin = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total FROM admin"))['total'];
$jumlah_siswa = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total FROM users"))['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Admin</title>

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

/* LOGO SVG */
.logo-book {
    width: 60px;
    height: 60px;
    margin: auto;
    margin-bottom: 10px;
}

.logo-book svg {
    width: 100%;
    height: 100%;
    filter: drop-shadow(0 0 6px #00ff88);
}

.profile h4 {
    color: #ffffff;
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
    margin-bottom: 25px;
}

.topbar h2 {
    color: #ffffff;
}

/* LOGOUT BUTTON */
.logout {
    text-decoration: none;
    background: #ff4d4d;
    color: #fff;
    padding: 10px 18px;
    border-radius: 10px;
    font-weight: 600;
    transition: 0.3s;
}

.logout:hover {
    background: #e60000;
    box-shadow: 0 0 10px rgba(255,0,0,0.6);
}

/* CONTENT */
.content-box {
    background: #1e1e1e;
    padding: 30px;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.6);
}

/* STAT */
.stat-box {
    display:flex;
    gap:15px;
    flex-wrap:wrap;
}

.stat {
    flex:1;
    background:#262626;
    padding:15px;
    border-radius:15px;
    text-align:center;
    border: 1px solid #00ff88;
    transition:0.3s;
}

.stat:hover {
    transform: translateY(-5px);
    box-shadow: 0 0 15px rgba(0,255,136,0.6);
}

.stat h2 {
    color:#00ff88;
}

.stat p {
    color:#cccccc;
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="profile">

        <!-- 🔥 LOGO BUKU NEON -->
        <div class="logo-book">
            <svg viewBox="0 0 24 24" fill="none">
                <!-- cover -->
                <path d="M4 5C4 4 5 3 6 3H16C17 3 18 4 18 5V19C18 20 17 21 16 21H6C5 21 4 20 4 19V5Z"
                      stroke="#00ff88" stroke-width="2"/>

                <!-- spine -->
                <line x1="8" y1="3" x2="8" y2="21"
                      stroke="#00ff88" stroke-width="2"/>

                <!-- pages detail -->
                <line x1="10" y1="7" x2="16" y2="7"
                      stroke="#00ff88" stroke-width="1"/>
                <line x1="10" y1="11" x2="16" y2="11"
                      stroke="#00ff88" stroke-width="1"/>
                <line x1="10" y1="15" x2="16" y2="15"
                      stroke="#00ff88" stroke-width="1"/>
            </svg>
        </div>

        <h4><?= $_SESSION['admin']; ?></h4>
    </div>

    <div class="menu">
        <a href="dashboard.php" class="active"> Dashboard</a>
        <a href="buku.php"> Data Buku</a>
        <a href="peminjaman.php"> Peminjaman</a>
        <a href="admin_data.php">Data Admin</a>
        <a href="user_data.php">Data Siswa</a>
        <a href="laporan.php"> Laporan</a>
    </div>
</div>

<!-- MAIN -->
<div class="main">

    <div class="topbar">
        <h2>Dashboard Admin</h2>
        <a href="logout.php" class="logout">Logout</a>
    </div>

    <div class="content-box">

        <div class="stat-box">

            <div class="stat">
                <h2><?= $jumlah_buku; ?></h2>
                <p>Total Buku</p>
            </div>

            <div class="stat">
                <h2><?= $jumlah_admin; ?></h2>
                <p>Total Admin</p>
            </div>

            <div class="stat">
                <h2><?= $jumlah_siswa; ?></h2>
                <p>Total Anggota</p>
            </div>

        </div>

    </div>

</div>

</body>
</html>