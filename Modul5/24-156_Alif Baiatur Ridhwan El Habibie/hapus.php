<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM supplier WHERE id = $id";
    
    if (mysqli_query($koneksi, $sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($koneksi);
    }
} else {
    header("Location: index.php");
    exit();
}
?>