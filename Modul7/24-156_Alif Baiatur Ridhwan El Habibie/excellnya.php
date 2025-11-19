<?php
require 'koneksi.php';

if (isset($_GET["mulai"]) && isset($_GET["akhir"])) {
    header("Content-Type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=laporan_penjualan.xls");

    $query = "SELECT * FROM transaksi WHERE waktu_transaksi BETWEEN '{$_GET['mulai']}' AND '{$_GET['akhir']}'";
    $transaksi = mysqli_query($koneksi, $query);

    
    $dailySales = [];
    $customerCount = 0;
    $customers = [];
    $revenue = 0;


    foreach ($transaksi as $row) {
        $revenue += $row["total"];

        if (!in_array($row["pelanggan_id"], $customers)) {
            $revenue += 1;
            $customers[] = $row["pelanggan_id"];
        }

        $date_key = new DateTime($row["waktu_transaksi"]);
        $date_key = $date_key->format("d-M-Y");

        if (array_key_exists($date_key, $dailySales)) {
            $dailySales[$date_key] += $row["total"];
        } else {
            $dailySales[$date_key] = $row["total"];
        }
    }

    echo "<table border='1'>";
    echo "<tr><th colspan='3'>Rekap Laporan Penjualan {$_GET['mulai']} sampai {$_GET['akhir']}</th></tr>";
    echo "<tr><th>No</th><th>Total</th><th>Tanggal</th></tr>";

    $no = 1;
    foreach ($dailySales as $tanggal => $total) {
        echo "<tr>";
        echo "<td>{$no}</td>";
        echo "<td>Rp. " . number_format($total, 0, ',', '.') . "</td>";
        echo "<td>{$tanggal}</td>";
        echo "</tr>";
        $no++;
    }

    echo "<tr><td colspan='3'></td></tr>";
    echo "<tr><th>Jumlah Pelanggan</th><th colspan='2'>Jumlah Pendapatan</th></tr>";
    echo "<tr>";
    echo "<td>{$customerCount} Orang</td>";
    echo "<td colspan='2'>Rp. " . number_format($revenue, 0, ',', '.') . "</td>";
    echo "</tr>";
    echo "</table>";
}
?>
