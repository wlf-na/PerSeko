<?php
session_start();
include('../config/db.php');

if(!isset($_SESSION['user'])){
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard</title>
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
    width:230px;
    height:100vh;
    background:#1e1e1e;
    padding:25px 20px;
}

.profile{
    text-align:center;
    margin-bottom:30px;
}

/* 🔥 LOGO NEON BOOK (UPDATED) */
.avatar{
    width:80px;
    height:80px;
    margin:auto;
    margin-bottom:10px;
    display:flex;
    justify-content:center;
    align-items:center;
}

/* glow effect */
.avatar svg{
    width:80px;
    height:80px;
    filter:
        drop-shadow(0 0 6px #00ff88)
        drop-shadow(0 0 15px #00ff88)
        drop-shadow(0 0 25px #00ff88);
    animation: glow 2s infinite alternate;
}

@keyframes glow{
    from{ transform: scale(1); }
    to{ transform: scale(1.05); }
}

.profile h4{
    color:#fff;
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
}

/* TOPBAR */
.topbar{
    display:flex;
    justify-content:space-between;
    margin-bottom:20px;
}

.topbar h2{
    color:#fff;
}

/* 🔴 LOGOUT BUTTON (NEW) */
.logout{
    background:#ff3b3b;
    color:#fff;
    padding:10px 18px;
    border-radius:10px;
    text-decoration:none;
    font-weight:600;
    transition:0.3s;
}

.logout:hover{
    background:#ff0000;
    box-shadow:0 0 12px rgba(255,0,0,0.5);
}

/* SEARCH */
.search-box input{
    padding:12px;
    width:250px;
    border-radius:10px;
    border:1px solid #333;
    background:#1e1e1e;
    color:#fff;
}

.search-box button{
    padding:12px 16px;
    border:none;
    border-radius:10px;
    background:#00ff88;
    color:#000;
    font-weight:600;
}

/* RIWAYAT */
.riwayat{
    margin:15px 0;
}

.riwayat a{
    margin-right:10px;
    color:#00ff88;
    text-decoration:none;
    font-size:14px;
}

/* CARD */
.container{
    display:flex;
    flex-wrap:wrap;
    gap:25px;
}

.card{
    width:220px;
    background:#1e1e1e;
    border-radius:15px;
    padding:15px;
    box-shadow:0 10px 25px rgba(0,0,0,0.6);
    transition:0.3s;
}

.card:hover{
    transform:translateY(-5px);
}

.card img{
    width:100%;
    height:260px;
    object-fit:cover;
    border-radius:10px;
}

.card h4{
    margin:10px 0 5px;
    color:#fff;
}

.card p{
    font-size:13px;
    color:#aaa;
}

.card a{
    font-size:13px;
    text-decoration:none;
    color:#00ff88;
}

.card a:hover{
    text-decoration:underline;
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <div class="profile">

        <!-- 💚 NEON BOOK LOGO (NEW KEREN ABIS) -->
        <div class="avatar">
            <svg viewBox="0 0 24 24" fill="none">
                <path d="M4 5C4 4 5 3 6 3H16C17 3 18 4 18 5V19C18 20 17 21 16 21H6C5 21 4 20 4 19V5Z"
                      stroke="#00ff88" stroke-width="2"/>
                <line x1="8" y1="3" x2="8" y2="21" stroke="#00ff88"/>
                <line x1="10" y1="8" x2="16" y2="8" stroke="#00ff88"/>
                <line x1="10" y1="12" x2="16" y2="12" stroke="#00ff88"/>
                <line x1="10" y1="16" x2="16" y2="16" stroke="#00ff88"/>
            </svg>
        </div>

        <h4>Siswa</h4>
    </div>

    <div class="menu">
        <a href="dashboard.php">Dashboard</a>
        <a href="wishlist.php">Wishlist</a>
        <a href="riwayat.php">Riwayat</a>
        <a href="status.php">Status</a>
    </div>

</div>

<!-- MAIN -->
<div class="main">

    <div class="topbar">
        <h2>Selamat Datang!</h2>
        <a href="logout.php" class="logout">Logout</a>
    </div>

    <form method="GET" class="search-box">
        <input name="cari" placeholder="Cari buku..." value="<?php echo isset($_GET['cari']) ? $_GET['cari'] : '' ?>">
        <button>Cari</button>
    </form>

<?php
$cari = isset($_GET['cari']) ? $_GET['cari'] : '';

if($cari != ''){
    $_SESSION['riwayat_cari'][] = $cari;
}

if(!empty($_SESSION['riwayat_cari'])){
    echo "<div class='riwayat'><b>Riwayat:</b> ";
    foreach(array_unique($_SESSION['riwayat_cari']) as $r){
        echo "<a href='?cari=$r'>$r</a>";
    }
    echo "</div>";
}

$data = $conn->query("SELECT * FROM buku WHERE judul LIKE '%$cari%'");

echo "<div class='container'>";

while($d = $data->fetch_assoc()){
    echo "
    <div class='card'>
        <img src='../assets/uploads/".$d['cover']."'>
        <h4>".$d['judul']."</h4>
        <p>Penulis: ".$d['penulis']."</p>
        <p>Tahun: ".$d['tahun_terbit']."</p>
        <p>Stok: ".$d['stok']."</p>

        <a href='../assets/uploads/".$d['file_buku']."' target='_blank'>📖 Baca</a><br>
        <a href='pinjam.php?id=".$d['id']."'>Pinjam</a> |
        <a href='tambah_wishlist.php?id=".$d['id']."'>Wishlist</a>
    </div>
    ";
}

echo "</div>";
?>

</div>

</body>
</html>