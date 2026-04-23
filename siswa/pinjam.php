<?php
session_start();
include('../config/db.php');

$user = $_SESSION['user'];
$id = $_GET['id'];

$buku = $conn->query("SELECT * FROM buku WHERE id='$id'")->fetch_assoc();

if($buku['stok'] <= 0){
    echo "Stok habis!";
    exit;
}

$conn->query("
INSERT INTO peminjaman(user,buku_id,status,tanggal_pinjam)
VALUES('$user','$id','dipinjam',NOW())
");

$conn->query("UPDATE buku SET stok = stok - 1 WHERE id='$id'");

header("Location: riwayat.php");