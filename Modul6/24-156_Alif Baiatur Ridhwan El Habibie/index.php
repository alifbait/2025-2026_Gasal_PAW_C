<?php
require "koneksi.php";

$barangQuery = "SELECT barang.*, supplier.nama as supplier_nama FROM barang JOIN supplier ON barang.supplier_id = supplier.id";
$barangResult = mysqli_query($koneksi, $barangQuery);

$transaksiQuery = "SELECT transaksi.*, pelanggan.nama as pelanggan_nama FROM transaksi JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id";
$transaksiResult = mysqli_query($koneksi, $transaksiQuery);

$transaksiDetailQuery = "SELECT transaksi_detail.*, barang.nama_barang FROM transaksi_detail JOIN barang ON transaksi_detail.barang_id = barang.id JOIN transaksi ON transaksi_detail.transaksi_id = transaksi.id";
$transaksiDetailResult = mysqli_query($koneksi, $transaksiDetailQuery);

if (isset($_POST['submit_detail'])) {
    $transaksi_id = $_POST['transaksi_id'];
    $barang_id = $_POST['barang_id'];
    $qty = $_POST['qty'];

    $hargaQuery = "SELECT harga FROM barang WHERE id = '$barang_id'";
    $hargaResult = mysqli_query($koneksi, $hargaQuery);
    $barang = mysqli_fetch_assoc($hargaResult);
    $harga_satuan = $barang['harga'];

    $harga = $harga_satuan * $qty;

    $insertDetailQuery = "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES ('$transaksi_id', '$barang_id', '$harga', '$qty')";
    if (mysqli_query($koneksi, $insertDetailQuery)) {
        $updateTotalQuery = "
            UPDATE transaksi
            SET total = (
                SELECT SUM(harga)
                FROM transaksi_detail
                WHERE transaksi_id = '$transaksi_id'
            )
            WHERE id = '$transaksi_id'
        ";
        mysqli_query($koneksi, $updateTotalQuery);

        echo "<script>alert('Detail transaksi berhasil ditambahkan dan total transaksi diperbarui!');</script>";
        echo "<script>window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan detail transaksi: " . mysqli_error($koneksi) . "');</script>";
    }
}

if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];

    $checkQuery = "SELECT COUNT(*) as count FROM transaksi_detail WHERE barang_id = '$deleteId'";
    $checkResult = mysqli_query($koneksi, $checkQuery);
    $checkRow = mysqli_fetch_assoc($checkResult);

    if ($checkRow['count'] > 0) {
        echo "<script>alert('Barang tidak bisa dihapus karena sudah digunakan dalam transaksi.');</script>";
    } else {
        $deleteQuery = "DELETE FROM barang WHERE id = '$deleteId'";
        mysqli_query($koneksi, $deleteQuery);
        echo "<script>alert('Barang berhasil dihapus.'); window.location.href='index.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 20px auto;
        }
        h1, h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #ffffff;
        }
        table, th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .btn-add, .btn-delete {
            display: inline-block;
            padding: 10px 20px;
            font-size: 14px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
        }
        .btn-delete {
            background-color: #dc3545;
        }
        .btn-add:hover, .btn-delete:hover {
            opacity: 0.9;
        }
        .actions {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Pengelolaan Master Detail</h1>
        
        <h2>Barang</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Nama Supplier</th>
                <th>Action</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($barangResult)): ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['kode_barang']; ?></td>
                <td><?= $row['nama_barang']; ?></td>
                <td><?= number_format($row['harga'], 0, ',', '.'); ?></td>
                <td><?= $row['stok']; ?></td>
                <td><?= $row['supplier_nama']; ?></td>
                <td class="actions">
                    <button class="btn-delete" onclick="confirmDelete(<?= $row['id']; ?>)">Delete</button>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>

        <h2>Transaksi</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Waktu Transaksi</th>
                <th>Keterangan</th>
                <th>Total</th>
                <th>Nama Pelanggan</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($transaksiResult)): ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['waktu_transaksi']; ?></td>
                <td><?= $row['keterangan']; ?></td>
                <td><?= number_format($row['total'], 0, ',', '.'); ?></td>
                <td><?= $row['pelanggan_nama']; ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
        

        <h2>Transaksi Detail</h2>
        <table>
            <tr>
                <th>Transaksi ID</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Qty</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($transaksiDetailResult)): ?>
            <tr>
                <td><?= $row['transaksi_id']; ?></td>
                <td><?= $row['nama_barang']; ?></td>
                <td><?= number_format($row['harga'], 0, ',', '.'); ?></td>
                <td><?= $row['qty']; ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
        
        <a href="tambah_Transaksi.php" class="btn-add">Tambah Transaksi</a>

        <a href="tambah_Detail.php" class="btn-add">Tambah Transaksi Detail</a>
    </div>

    <script>
        function confirmDelete(id) {
            const confirmation = confirm("Apakah Anda yakin ingin menghapus barang ini?");
            if (confirmation) {
                window.location.href = "index.php?delete_id=" + id;
            }
        }
    </script>
</body>
</html>
