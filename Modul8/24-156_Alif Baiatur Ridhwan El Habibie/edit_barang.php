<?php
require_once './koneksi.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$barang = mysqli_query(DB, "SELECT * FROM barang WHERE id = '$id'")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $supplier_id = $_POST['supplier_id'];

    $query = "UPDATE barang SET kode_barang='$kode_barang', nama_barang='$nama_barang', harga='$harga', stok='$stok', supplier_id='$supplier_id' WHERE id='$id'";

    if (mysqli_query(DB, $query)) {
        header("Location: barang.php");
    } else {
        echo "Error: " . mysqli_error(DB);
    }
}

$suppliers = getAllDataSupplier();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
</head>
<body>
    <h1>Edit Barang</h1>
    <form method="POST" action="">
        <label for="kode_barang">Kode Barang:</label>
        <input type="text" id="kode_barang" name="kode_barang" value="<?= $barang['kode_barang'] ?>" required><br>

        <label for="nama_barang">Nama Barang:</label>
        <input type="text" id="nama_barang" name="nama_barang" value="<?= $barang['nama_barang'] ?>" required><br>

        <label for="harga">Harga:</label>
        <input type="number" id="harga" name="harga" value="<?= $barang['harga'] ?>" required><br>

        <label for="stok">Stok:</label>
        <input type="number" id="stok" name="stok" value="<?= $barang['stok'] ?>" required><br>

        <label for="supplier_id">Supplier:</label>
        <select id="supplier_id" name="supplier_id">
            <?php foreach ($suppliers as $supplier) : ?>
                <option value="<?= $supplier['id'] ?>" <?= $barang['supplier_id'] == $supplier['id'] ? 'selected' : '' ?>><?= $supplier['nama'] ?></option>
            <?php endforeach; ?>
        </select><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>