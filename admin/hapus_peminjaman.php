<?php
include('../config/db.php');

$id = $_GET['id'];

$conn->query("DELETE FROM peminjaman WHERE id='$id'");

echo "<script>
alert('Data berhasil dihapus');
window.location='peminjaman.php';
</script>";
?>