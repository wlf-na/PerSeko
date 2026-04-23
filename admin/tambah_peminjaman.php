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
<title>Tambah Peminjaman</title>
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
    min-height:100vh;
    background:#121212;
}

/* SIDEBAR */
.sidebar{
    width:240px;
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
    display:flex;
    justify-content:center;
    align-items:center;
    padding:30px;
}

/* CARD */
.container{
    width:500px;
    background:#1e1e1e;
    padding:30px;
    border-radius:20px;
    box-shadow:0 10px 25px rgba(0,0,0,0.6);
}

h2{
    color:#fff;
    margin-bottom:20px;
    text-align:center;
}

/* FORM */
label{
    color:#ccc;
    font-size:14px;
}

input, select{
    width:100%;
    padding:10px;
    margin:8px 0 15px 0;
    border-radius:8px;
    border:1px solid #333;
    background:#121212;
    color:#fff;
    outline:none;
}

/* BUTTON */
button{
    width:100%;
    padding:12px;
    background:#00ff88;
    color:#000;
    border:none;
    border-radius:10px;
    font-weight:600;
    cursor:pointer;
    transition:0.3s;
}

button:hover{
    box-shadow:0 0 10px rgba(0,255,136,0.6);
}

/* LINK */
a{
    display:block;
    text-align:center;
    margin-top:15px;
    color:#00ff88;
    text-decoration:none;
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

<div class="container">

<h2>Tambah Peminjaman</h2>

<form method="POST">

    <label>User</label>
    <select name="user" required>
        <option value="">Pilih User</option>
        <?php
        $user = $conn->query("SELECT * FROM users");
        while($u = $user->fetch_assoc()){
            echo "<option value='{$u['nama']}'>{$u['nama']}</option>";
        }
        ?>
    </select>

    <label>Buku</label>
    <select name="buku_id" required>
        <option value="">Pilih Buku</option>
        <?php
        $buku = $conn->query("SELECT * FROM buku");
        while($b = $buku->fetch_assoc()){
            echo "<option value='{$b['id']}'>{$b['judul']}</option>";
        }
        ?>
    </select>

    <label>Tanggal Pinjam</label>
    <input type="date" name="tanggal_pinjam" required>

    <label>Tanggal Kembali</label>
    <input type="date" name="tanggal_kembali">

    <button type="submit" name="simpan">Simpan</button>

</form>

<a href="peminjaman.php">← Kembali</a>

<?php
if(isset($_POST['simpan'])){

    $user = $_POST['user'];
    $buku = $_POST['buku_id'];
    $pinjam = $_POST['tanggal_pinjam'];
    $kembali = $_POST['tanggal_kembali'];

    $conn->query("INSERT INTO peminjaman(user,buku_id,status,tanggal_pinjam,tanggal_kembali)
    VALUES('$user','$buku','dipinjam','$pinjam','$kembali')");

    echo "<script>alert('Peminjaman berhasil ditambahkan'); window.location='peminjaman.php';</script>";
}
?>

</div>

</div>

</body>
</html>