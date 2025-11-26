<?php
require_once './koneksi.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string(DB, $_GET['id']);
    $query = "DELETE FROM pelanggan WHERE id = '$id'";
    if (mysqli_query(DB, $query)) {
        header("Location: pelanggan.php?message=deleted");
    } else {
        header("Location: pelanggan.php?message=error");
    }
} else {
    header("Location: pelanggan.php");
}
exit();
?>