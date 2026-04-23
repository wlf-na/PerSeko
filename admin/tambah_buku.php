<?php
session_start();
require_once('../config/db.php');

// CEK KONEKSI
if(!isset($conn)){
    die("Koneksi database tidak ditemukan!");
}

// PATH UPLOAD
$folder = "../assets/uploads/";

// BUAT FOLDER JIKA BELUM ADA
if(!file_exists($folder)){
    mkdir($folder, 0777, true);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Buku</title>
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
    width:600px;
    background:#1e1e1e;
    padding:30px;
    border-radius:20px;
    box-shadow:0 10px 25px rgba(0,0,0,0.6);
}

h2{
    color:#fff;
    text-align:center;
    margin-bottom:10px;
}

a{
    color:#00ff88;
    text-decoration:none;
    display:inline-block;
    margin-bottom:15px;
}

/* INPUT */
label{
    color:#ccc;
    font-size:14px;
}

input{
    width:100%;
    padding:10px;
    margin:8px 0 15px 0;
    border-radius:8px;
    border:1px solid #333;
    background:#121212;
    color:#fff;
    outline:none;
}

/* FILE INPUT */
input[type="file"]{
    padding:8px;
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

hr{
    border:0;
    height:1px;
    background:#333;
    margin:10px 0 20px 0;
}

/* ERROR TEXT */
p{
    margin-top:10px;
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

<h2>Tambah Buku</h2>

<a href="buku.php">← Kembali</a>

<hr>

<form method="POST" enctype="multipart/form-data">

    <label>Judul</label>
    <input type="text" name="judul" required>

    <label>Penulis</label>
    <input type="text" name="penulis" required>

    <label>Penerbit</label>
    <input type="text" name="penerbit" required>

    <label>Tahun</label>
    <input type="number" name="tahun" required>

    <label>Stok</label>
    <input type="number" name="stok" required>

    <label>Cover</label>
    <input type="file" name="cover" required>

    <label>File PDF</label>
    <input type="file" name="file_buku" required>

    <button type="submit" name="simpan">Simpan</button>

</form>

<?php
if(isset($_POST['simpan'])){

    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun'];
    $stok = $_POST['stok'];

    $cover = $_FILES['cover']['name'];
    $file_buku = $_FILES['file_buku']['name'];

    $tmp_cover = $_FILES['cover']['tmp_name'];
    $tmp_file = $_FILES['file_buku']['tmp_name'];

    if(empty($cover) || empty($file_buku)){
        echo "<p style='color:red;'>File tidak boleh kosong!</p>";
        exit;
    }

    $cover_baru = time().'_'.str_replace(" ","_",$cover);
    $file_baru = time().'_'.str_replace(" ","_",$file_buku);

    $upload1 = move_uploaded_file($tmp_cover, $folder.$cover_baru);
    $upload2 = move_uploaded_file($tmp_file, $folder.$file_baru);

    if($upload1 && $upload2){

        $sql = "INSERT INTO buku 
        (judul, penulis, penerbit, tahun_terbit, stok, cover, file_buku)
        VALUES 
        ('$judul','$penulis','$penerbit','$tahun','$stok','$cover_baru','$file_baru')";

        $query = $conn->query($sql);

        if($query){
            echo "<script>
                alert('Buku berhasil ditambahkan');
                window.location='buku.php';
            </script>";
        } else {
            echo "<p style='color:red;'>Gagal simpan: ".$conn->error."</p>";
        }

    } else {
        echo "<p style='color:red;'>Upload gagal!</p>";
    }
}
?>

</div>

</div>

</body>
</html>