<?php
session_start();
include('../config/db.php');

if(!isset($_GET['id'])){
    die("ID tidak ditemukan");
}

$id = $_GET['id'];

// ambil buku_id dulu
$data = $conn->query("SELECT buku_id FROM peminjaman WHERE id='$id'");

if($data->num_rows == 0){
    die("Data peminjaman tidak ditemukan");
}

$d = $data->fetch_assoc();
$buku_id = $d['buku_id'];

// waktu sekarang (FULL datetime)
$tgl_kembali = date('Y-m-d H:i:s');

// update status + tanggal kembali
$conn->query("
    UPDATE peminjaman 
    SET status='dikembalikan', tanggal_kembali='$tgl_kembali' 
    WHERE id='$id'
");

// balikin stok buku
$conn->query("
    UPDATE buku 
    SET stok = stok + 1 
    WHERE id='$buku_id'
");

// redirect
header("Location: status.php");
exit;
?>