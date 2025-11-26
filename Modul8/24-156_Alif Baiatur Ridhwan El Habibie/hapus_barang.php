<?php
require_once './koneksi.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$query = "DELETE FROM barang WHERE id = '$id'";

if (mysqli_query(DB, $query)) {
    header("Location: barang.php");
} else {
    echo "Error: " . mysqli_error(DB);
}
?>