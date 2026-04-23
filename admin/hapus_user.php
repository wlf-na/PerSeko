<?php
require_once('../config/db.php');

$id = $_GET['id'];

// hapus data
$conn->query("DELETE FROM users WHERE id='$id'");

// balik ke halaman user
header("Location: user_data.php");
exit;
?>