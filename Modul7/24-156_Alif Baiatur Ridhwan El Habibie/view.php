<?php
    require "koneksi.php";

    $query = "SELECT b.id, b.kode_barang, b.nama_barang, b.harga, b.stok, s.nama AS nama_supplier FROM barang AS b JOIN supplier AS s ON b.supplier_id = s.id";
    $barang = mysqli_query($koneksi, $query);

    $q_transaksi = "SELECT t.id, t.waktu_transaksi, t.keterangan, t.total, p.nama AS nama_pelanggan FROM transaksi AS t LEFT JOIN pelanggan AS p ON t.pelanggan_id = p.id";
    $transaksi = mysqli_query($koneksi, $q_transaksi);

    $q_transaksi_detail = "SELECT td.transaksi_id, b.nama_barang, td.harga, td.qty FROM transaksi_detail AS td JOIN barang AS b ON td.barang_id = b.id";
    $transaksi_detail = mysqli_query($koneksi, $q_transaksi_detail);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master Transaksi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="top-navigation">
    <div class="nav-container">
        <a href="#" class="brand-name">Penjualan ALIF</a>
        <ul class="nav-menu">
            <li><a href="#">Supplier</a></li>
            <li><a href="#">Barang</a></li>
            <li><a href="#">Transaksi</a></li>
        </ul>
    </div>
</nav>

<div class="table-wrapper">
    <h2>Data Master Transaksi</h2>
    <div class="button-group">
        <a href="report_transaksi.php" class="button primary">Lihat Laporan Penjualan</a>
        <a href="tambah_transaksi.php" class="button success">Tambah Transaksi</a>
    </div>
    <table class="main-table">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Transaksi</th>
                <th>Waktu Transaksi</th>
                <th>Nama Pelanggan</th>
                <th>Keterangan</th>
                <th>Total</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($transaksi as $row): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row["id"] ?></td>
                <td><?= $row["waktu_transaksi"] ?></td>
                <td><?= $row["nama_pelanggan"] ?? 'Tidak Diketahui' ?></td>
                <td><?= $row["keterangan"] ?></td>
                <td>Rp. <?= number_format($row["total"], 0, ',', '.') ?></td>
                <td class="action-btns">
                    <a href="lihat_detail.php?id_transaksi=<?= $row['id'] ?>" class="button info">Lihat Detail</a>
                    <a href="hapus_transaksi.php?id_transaksi=<?= $row['id'] ?>" class="button danger">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
