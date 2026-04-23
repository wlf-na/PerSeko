<?php
session_start();
include('../config/db.php');

$user = $_SESSION['user'];
$id = $_GET['id'];

$conn->query("INSERT INTO wishlist(user,buku_id) VALUES('$user','$id')");

header("Location: wishlist.php");