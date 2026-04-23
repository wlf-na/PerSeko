<?php
require_once('../config/db.php');

$id = intval($_GET['id']);

$conn->query("DELETE FROM admin WHERE id=$id");

header("Location: admin_data.php");
?>