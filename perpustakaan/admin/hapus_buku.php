<?php
require_once('../config/db.php');

$id = $_GET['id'];

$data = $conn->query("SELECT * FROM buku WHERE id='$id'");
$b = $data->fetch_assoc();

$folder = __DIR__ . "/../assets/uploads/";

if(file_exists($folder.$b['cover'])){
    unlink($folder.$b['cover']);
}

if(file_exists($folder.$b['file_buku'])){
    unlink($folder.$b['file_buku']);
}

$conn->query("DELETE FROM buku WHERE id='$id'");

header("Location: buku.php");
exit;
?>