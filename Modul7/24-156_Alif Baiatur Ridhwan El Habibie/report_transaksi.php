<?php
require "koneksi.php";
if (isset($_POST["submit"])) {
    $query = "SELECT * FROM transaksi WHERE waktu_transaksi BETWEEN '{$_POST['mulai']}' AND '{$_POST['akhir']}'";
    $transaksi = mysqli_query($koneksi, $query);

    $sales = [];
    $dailySales = [];
    $customerCount = 0;
    $customers = [];
    $revenue = 0;

    foreach ($transaksi as $row) {
        $revenue += $row["total"];

        if (!in_array($row["pelanggan_id"], $customers)) {
            $customerCount += 1;
            $customers[] = $row["pelanggan_id"];
        }

        if (array_key_exists($row["waktu_transaksi"], $sales)) {
            $sales[$row['waktu_transaksi']] += $row["total"];
        } else {
            $sales[$row['waktu_transaksi']] = $row["total"];
        }

        $date_key = new DateTime($row["waktu_transaksi"]);
        $date_key = $date_key->format("j F Y");

        if (array_key_exists($date_key, $dailySales)) {
            $dailySales[$date_key] += $row["total"];
        } else {
            $dailySales[$date_key] = $row["total"];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master Transaksi</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <nav class="top-navigation">
        <div class="nav-container">
            <a href="#" class="brand-name">Penjualan XYZ</a>
            <ul class="nav-menu">
                <li><a href="#">Supplier</a></li>
                <li><a href="#">Barang</a></li>
                <li><a href="#">Transaksi</a></li>
            </ul>
        </div>
    </nav>
    
    <?php if (!isset($_POST["submit"])): ?>
        <div class="report-container">
            <div class="header-title">Rekap Laporan Penjualan</div>
            <button type="button" class="btn-back" onclick="history.back();">&lt; Kembali</button>
            <form method="post" action="" class="date-form">
                <input name="mulai" type="date">
                <input name="akhir" type="date">
                <button type="submit" name="submit" class="btn-show">Tampilkan</button>
            </form>
        </div>
    <?php endif; ?>

    <?php if (isset($_POST["submit"])): ?>
        <div class="report-container">
            <div class="header-title">Rekap Laporan Penjualan <?= $_POST['mulai'] ?> sampai <?= $_POST["akhir"] ?></div>
            <button type="button" class="btn-back" onclick="history.back();">&lt; Kembali</button>
            <br>
            <button type="button" class="btn-excel" onclick="window.print();">Cetak</button>
            <button type="button" class="btn-excel" onclick="window.location.href='excellnya.php?mulai=<?= $_POST['mulai'] ?>&akhir=<?= $_POST['akhir'] ?>'">Excel</button>
            <canvas id="salesChart"></canvas>

            <table class="report-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Total</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($dailySales as $tanggal => $total): ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td>Rp. <?= number_format($total, 0, ',', '.') ?></td>
                            <td><?= $tanggal ?></td>
                        </tr>
                        <?php $no++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <table class="summary-table" id="summary-a">
                <thead>
                    <tr>
                        <th>Jumlah Pelanggan</th>
                        <th>Jumlah Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $customerCount ?> Orang</td>
                        <td>Rp. <?= number_format($revenue, 0, ',', '.') ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <?php if (isset($_POST["submit"])): ?>
    <script>
        const ctx = document.getElementById("salesChart").getContext("2d");
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode(array_keys($sales)); ?>,
                datasets: [{
                    label: 'Total',
                    data: <?= json_encode(array_values($sales)) ?>,
                    backgroundColor: "rgba(128, 128, 128, 0.2)",
                    borderColor: "rgba(128, 128, 128, 0.5)",
                    borderWidth: 1
                }]
            }
        });
    </script>
    <?php endif; ?>
</body>
</html>
