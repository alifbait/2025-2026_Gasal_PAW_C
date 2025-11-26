<?php
require_once "./koneksi.php";
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah'])) {
    $nama = mysqli_real_escape_string(DB, $_POST['nama']);
    $jenis_kelamin = mysqli_real_escape_string(DB, $_POST['jenis_kelamin']);
    $telp = mysqli_real_escape_string(DB, $_POST['telp']);
    $alamat = mysqli_real_escape_string(DB, $_POST['alamat']);

    $result = mysqli_query(DB, "SELECT MAX(id) AS max_id FROM pelanggan");
    $row = mysqli_fetch_assoc($result);
    $id = $row['max_id'] + 1;


    $query = "INSERT INTO pelanggan (id, nama, jenis_kelamin, telp, alamat) VALUES ('$id', '$nama', '$jenis_kelamin', '$telp', '$alamat')";
    if (mysqli_query(DB, $query)) {
        header("Location: pelanggan.php");
    } else {
        header("Location: pelanggan.php");
    }
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Tambah Pelanggan</title>
</head>
<body>
<div class="container mt-5">
    <h2>Tambah Pelanggan</h2>
    
    <form method="POST">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="telp" class="form-label">No. Telepon</label>
            <input type="text" class="form-control" id="telp" name="telp" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
        </div>
        <button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
        <a href="pelanggan.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
