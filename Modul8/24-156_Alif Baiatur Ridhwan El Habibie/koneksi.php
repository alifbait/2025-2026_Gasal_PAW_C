<?php
// Koneksi database
define('DB', mysqli_connect("localhost", "root", "", "penjualan"));

// Tambahan agar $conn dan $koneksi tetap bisa dipakai di file lain
$conn = DB;
$koneksi = DB;

// Cek koneksi
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// --------------------
// FUNCTION-FUNCTION DB
// --------------------

function getAllDataTransaksi() {
    $query = "SELECT
    transaksi.id,
    transaksi.waktu_transaksi,
    pelanggan.nama AS nama_pelanggan,
    transaksi.keterangan,
    transaksi.total
    FROM transaksi
    JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id";
    return mysqli_query(DB, $query)->fetch_all(MYSQLI_ASSOC);
}

function getDataTransaksiByDate($start, $end) {
    $query = "SELECT total, waktu_transaksi, MONTH(waktu_transaksi)
              FROM transaksi
              WHERE waktu_transaksi >= '$start' AND waktu_transaksi <= '$end'
              ORDER BY waktu_transaksi ASC";
    return mysqli_query(DB, $query)->fetch_all(MYSQLI_ASSOC);
}

function getDataDetailById($id) {
    $query = "SELECT
              dt.transaksi_id, dt.harga, dt.qty,
              barang.nama_barang AS nama
              FROM transaksi_detail AS dt
              JOIN barang ON dt.barang_id = barang.id
              WHERE dt.transaksi_id = '$id'";
    return mysqli_query(DB, $query)->fetch_all(MYSQLI_ASSOC);
}

function getAllDataSupplier() {
    return mysqli_query(DB, "SELECT * FROM supplier")->fetch_all(MYSQLI_ASSOC);
}

function getAllDataBarang() {
    $query = "SELECT
              barang.id, barang.kode_barang, barang.nama_barang,
              barang.harga, barang.stok, supplier.nama
              FROM barang
              JOIN supplier ON barang.supplier_id = supplier.id";
    return mysqli_query(DB, $query)->fetch_all(MYSQLI_ASSOC);
}

function getAllDataPelanggan() {
    return mysqli_query(DB, "SELECT id, nama, jenis_kelamin, telp, alamat FROM pelanggan")
           ->fetch_all(MYSQLI_ASSOC);
}

function getDataPelangganById($id) {
    return mysqli_query(DB, "SELECT id, nama, jenis_kelamin, telp, alamat FROM pelanggan WHERE id='$id'")
           ->fetch_assoc();
}

function getAllDataUser() {
    return mysqli_query(DB, "SELECT id_user, username, password, nama, alamat, hp, level FROM user")
           ->fetch_all(MYSQLI_ASSOC);
}

function getDataUserById($id) {
    return mysqli_query(DB, "SELECT id_user, username, password, nama, alamat, hp, level FROM user WHERE id_user='$id'")
           ->fetch_assoc();
}
?>
