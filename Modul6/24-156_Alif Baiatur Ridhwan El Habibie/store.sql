CREATE DATABASE penjualan;

CREATE TABLE pelanggan (
    id INT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    jenis_kelamin ENUM('L', 'P') NOT NULL,
    telp VARCHAR(12),
    alamat TEXT
);

CREATE TABLE supplier (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100) NOT NULL,
    telp VARCHAR(12),
    alamat TEXT
);

CREATE TABLE barang (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    kode_barang VARCHAR(10) NOT NULL,
    nama_barang VARCHAR(100) NOT NULL,
    harga INT(11) NOT NULL,
    stok INT(11) NOT NULL,
    supplier_id INT(11) NOT NULL,
    FOREIGN KEY (supplier_id) REFERENCES supplier(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE transaksi (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    waktu_transaksi DATE NOT NULL,
    keterangan TEXT,
    total INT(11) NOT NULL,
    pelanggan_id INT NOT NULL,
    FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE transaksi_detail (
    transaksi_id INT(11) NOT NULL,
    barang_id INT(11) NOT NULL,
    harga INT(11) NOT NULL,
    qty INT(11) NOT NULL,
    PRIMARY KEY (transaksi_id, barang_id),
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (barang_id) REFERENCES barang(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE pembayaran (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    waktu_bayar DATETIME NOT NULL,
    total INT(11) NOT NULL,
    metode ENUM('TUNAI', 'TRANSFER', 'EDC') NOT NULL,
    transaksi_id INT(11) NOT NULL,
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE user (
    id_user TINYINT(2) PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(35) NOT NULL,
    nama VARCHAR(50) NOT NULL,
    alamat VARCHAR(150),
    hp VARCHAR(20),
    level TINYINT(1) NOT NULL
);
