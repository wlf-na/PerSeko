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
<title>Laporan Peminjaman</title>
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
}

.icon{
    text-align:center;
    margin-bottom:15px;
}

.icon svg{
    filter: drop-shadow(0 0 6px #00ff88);
}

.profile h4{
    text-align:center;
    color:#fff;
    margin-bottom:20px;
}

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

/* HEADER */
.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:15px;
}

.header h2{
    color:#fff;
}

/* BUTTON */
.btn{
    background:#00ff88;
    color:#000;
    padding:10px 15px;
    border-radius:10px;
    text-decoration:none;
    margin-left:10px;
    border:none;
    cursor:pointer;
    font-weight:600;
}

.btn:hover{
    box-shadow:0 0 10px rgba(0,255,136,0.7);
}

/* CARD */
.card{
    background:#1e1e1e;
    padding:25px;
    border-radius:20px;
    box-shadow:0 10px 25px rgba(0,0,0,0.6);
    flex:1;
}

/* INPUT */
input{
    padding:10px;
    border-radius:8px;
    border:1px solid #333;
    background:#121212;
    color:#fff;
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

/* FOOTER */
.footer{
    text-align:center;
    padding:15px;
    color:#888;
    font-size:13px;
    margin-top:10px;
}

/* PRINT MODE */
@media print{
    body{
        background:#fff;
    }

    .sidebar, .header, form, .footer{
        display:none;
    }

    .card{
        box-shadow:none;
        background:#fff;
    }

    table{
        color:#000;
    }

    th{
        color:#000;
        background:#ddd;
    }

    td{
        color:#000;
    }
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="icon">
        <svg width="60" height="60" viewBox="0 0 24 24" fill="none">
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

    <div class="profile">
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

<div class="header">
    <h2>Laporan Peminjaman</h2>
    <div>
        <a class="btn" href="dashboard.php">Home</a>
        <a class="btn" href="export_laporan.php">Export Excel</a>
        <a class="btn" href="export_pdf.php">Export PDF</a>
        <button class="btn" onclick="window.print()">Print</button>
    </div>
</div>

<div class="card">

<form method="GET" style="margin-bottom:15px; display:flex; gap:10px;">
    <input type="text" name="cari" placeholder="Cari user / buku..."
    value="<?= $_GET['cari'] ?? '' ?>">

    <input type="month" name="bulan"
    value="<?= $_GET['bulan'] ?? '' ?>">

    <button class="btn">Cari</button>
</form>

<?php
$cari = $_GET['cari'] ?? '';
$bulan = $_GET['bulan'] ?? '';

$where = "WHERE 1=1";

if($cari != ''){
    $where .= " AND (peminjaman.user LIKE '%$cari%' OR buku.judul LIKE '%$cari%')";
}

if($bulan != ''){
    $where .= " AND DATE_FORMAT(peminjaman.tanggal_pinjam, '%Y-%m') = '$bulan'";
}
?>

<table>
<tr>
    <th>User</th>
    <th>Judul Buku</th>
    <th>Status</th>
    <th>Tanggal Pinjam</th>
    <th>Tanggal Kembali</th>
</tr>

<?php
$data = $conn->query("
SELECT peminjaman.*, buku.judul 
FROM peminjaman 
JOIN buku ON peminjaman.buku_id = buku.id
$where
ORDER BY peminjaman.tanggal_pinjam DESC
");

while($d = $data->fetch_assoc()){
?>

<tr>
    <td><?= $d['user']; ?></td>
    <td><?= $d['judul']; ?></td>
    <td><?= $d['status']; ?></td>
    <td><?= date('d/m/Y', strtotime($d['tanggal_pinjam'])); ?></td>
    <td><?= $d['tanggal_kembali'] ? date('d/m/Y', strtotime($d['tanggal_kembali'])) : '-'; ?></td>
</tr>

<?php } ?>

</table>

</div>

<div class="footer">
    © 2026 Perpustakaan Digital | Dibuat oleh Hasna 💚
</div>

</div>

</body>
</html>