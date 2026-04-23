<?php
require_once('../config/db.php');

if(!isset($_GET['id'])){
    die("ID tidak ditemukan");
}

$id = intval($_GET['id']);

// ambil data dulu (buat ambil nama file)
$data = $conn->query("SELECT * FROM buku WHERE id='$id'");
$b = $data->fetch_assoc();

if(!$b){
    die("Data tidak ditemukan");
}

// cek peminjaman
$cek = $conn->query("SELECT * FROM peminjaman WHERE buku_id='$id'");

if($cek->num_rows > 0){
    echo "
    <script>
        alert('Buku masih dipinjam!');
        window.location='buku.php';
    </script>
    ";
    exit;
}

/* 🔥 HAPUS FILE DI FOLDER UPLOADS */
$folder = "../assets/uploads/";

// hapus cover
if(!empty($b['cover']) && file_exists($folder.$b['cover'])){
    unlink($folder.$b['cover']);
}

if(!empty($b['file_buku']) && file_exists($folder.$b['file_buku'])){
    unlink($folder.$b['file_buku']);
}

/* 🔥 HAPUS DARI WISHLIST (biar aman FK) */
$conn->query("DELETE FROM wishlist WHERE buku_id='$id'");

/* 🔥 HAPUS DARI DATABASE */
$hapus = $conn->query("DELETE FROM buku WHERE id='$id'");

if(!$hapus){
    die("Query error: " . $conn->error);
}

echo "
<script>
    alert('Buku & file berhasil dihapus!');
    window.location='buku.php';
</script>
";
?>





<?php
include('../config/db.php');

$id = $_GET['id'];

$query = "DELETE FROM buku WHERE id='$id'";
$conn->query($query);

header("Location: data_buku.php");
exit();