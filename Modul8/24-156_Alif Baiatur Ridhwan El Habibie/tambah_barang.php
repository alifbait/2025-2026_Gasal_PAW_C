<?php
require_once './koneksi.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $supplier_id = $_POST['supplier_id'];

    $query = "INSERT INTO barang (kode_barang, nama_barang, harga, stok, supplier_id) VALUES ('$kode_barang', '$nama_barang', '$harga', '$stok', '$supplier_id')";

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
    <title>Tambah Barang</title>
</head>
<body>
    <h1>Tambah Barang</h1>
    <form method="POST" action="">
        <label for="kode_barang">Kode Barang:</label>
        <input type="text" id="kode_barang" name="kode_barang" required><br>

        <label for="nama_barang">Nama Barang:</label>
        <input type="text" id="nama_barang" name="nama_barang" required><br>

        <label for="harga">Harga:</label>
        <input type="number" id="harga" name="harga" required><br>

        <label for="stok">Stok:</label>
        <input type="number" id="stok" name="stok" required><br>

        <label for="supplier_id">Supplier:</label>
        <select id="supplier_id" name="supplier_id">
            <?php foreach ($suppliers as $supplier) : ?>
                <option value="<?= $supplier['id'] ?>"><?= $supplier['nama'] ?></option>
            <?php endforeach; ?>
        </select><br>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>