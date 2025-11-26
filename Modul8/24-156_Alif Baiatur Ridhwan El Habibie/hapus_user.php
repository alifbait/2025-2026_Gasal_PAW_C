<?php
require_once "./koneksi.php";
session_start();

if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'Owner') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string(DB, $_GET['id']);
    $query = "DELETE FROM user WHERE id_user='$id'";

    if (mysqli_query(DB, $query)) {
        header("Location: user.php");
        exit();
    } else {
        echo "Gagal menghapus user: " . mysqli_error(DB);
    }
} else {
    header("Location: user.php");
    exit();
}
?>