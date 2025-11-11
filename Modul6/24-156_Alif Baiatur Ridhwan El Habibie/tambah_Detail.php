<?php
require "koneksi.php";

if (isset($_POST['submit'])) {
    $barang_id = $_POST['barang_id'];
    $transaksi_id = $_POST['transaksi_id'];
    $qty = $_POST['qty'];

    $checkQuery = "SELECT * FROM transaksi_detail WHERE transaksi_id = '$transaksi_id' AND barang_id = '$barang_id'";
    $checkResult = mysqli_query($koneksi, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        echo "<script>alert('Barang sudah ditambahkan dalam transaksi ini! Silakan pilih barang lain.');</script>";
    } else {
        $hargaQuery = "SELECT harga FROM barang WHERE id = '$barang_id'";
        $hargaResult = mysqli_query($koneksi, $hargaQuery);
        $barang = mysqli_fetch_assoc($hargaResult);
        $harga_satuan = $barang['harga'];

        $total_harga = $harga_satuan * $qty;

        $insertQuery = "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES ('$transaksi_id', '$barang_id', '$total_harga', '$qty')";

        if (mysqli_query($koneksi, $insertQuery)) {
            $updateTotalQuery = "
                UPDATE transaksi
                SET total = (
                    SELECT SUM(harga) FROM transaksi_detail WHERE transaksi_id = '$transaksi_id'
                )
                WHERE id = '$transaksi_id'
            ";
            mysqli_query($koneksi, $updateTotalQuery);
            header("Location: index.php");
            exit();
        } else {
            echo "<script>alert('Gagal menambahkan detail transaksi: " . mysqli_error($koneksi) . "');</script>";
        }
    }
}

$barangQuery = "SELECT id, nama_barang FROM barang";
$barangResult = mysqli_query($koneksi, $barangQuery);

$transaksiQuery = "SELECT id FROM transaksi";
$transaksiResult = mysqli_query($koneksi, $transaksiQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Detail Transaksi</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h3>Tambah Detail Transaksi</h3>
        <form action="" method="post">
            <div class="form-group">
                <label for="barang_id">Pilih Barang</label>
                <select id="barang_id" name="barang_id" required>
                    <option value="">Pilih Barang</option>
                    <?php
                        while ($row = mysqli_fetch_assoc($barangResult)) {
                            $checkBarangInDetail = "SELECT * FROM transaksi_detail WHERE transaksi_id = '$transaksi_id' AND barang_id = '".$row['id']."'";
                            $checkBarangResult = mysqli_query($koneksi, $checkBarangInDetail);
                            if (mysqli_num_rows($checkBarangResult) == 0) {
                                echo "<option value='".$row['id']."'>".$row['nama_barang']."</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="transaksi_id">ID Transaksi</label>
                <select id="transaksi_id" name="transaksi_id" required>
                    <option value="">Pilih ID Transaksi</option>
                    <?php
                        while ($row = mysqli_fetch_assoc($transaksiResult)) {
                            echo "<option value='".$row['id']."'>".$row['id']."</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="qty">Quantity</label>
                <input type="number" id="qty" name="qty" placeholder="Masukkan jumlah barang" min="1" required>
            </div>
            <button type="submit" name="submit" class="btn-submit">Tambah Detail Transaksi</button>
        </form>
    </div>
</body>
</html>
