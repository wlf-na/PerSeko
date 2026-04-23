<?php
include('../config/db.php');

// ambil id peminjaman
$id = $_GET['id'];

// ambil data peminjaman
$data = $conn->query("SELECT * FROM peminjaman WHERE id='$id'")->fetch_assoc();

if(!$data){
    die("Data tidak ditemukan");
}

$buku_id = $data['buku_id'];

// update status jadi dikembalikan + waktu kembali
$conn->query("
UPDATE peminjaman 
SET status='dikembalikan', tanggal_kembali=NOW()
WHERE id='$id'
");

// tambah stok buku lagi
$conn->query("
UPDATE buku 
SET stok = stok + 1 
WHERE id='$buku_id'
");

// balik ke halaman peminjaman
header("Location: peminjaman.php");
exit;
?>