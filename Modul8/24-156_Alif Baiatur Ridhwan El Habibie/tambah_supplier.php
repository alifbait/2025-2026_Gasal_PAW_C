<?php
require_once './koneksi.php';

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string(DB, $_POST['nama']);
    $alamat = mysqli_real_escape_string(DB, $_POST['alamat']);
    $telp = mysqli_real_escape_string(DB, $_POST['telp']);

    $query = "INSERT INTO supplier (nama, alamat, telp) VALUES ('$nama', '$alamat', '$telp')";
    if (mysqli_query(DB, $query)) {
        header("Location: supplier.php");
        exit();
    } else {
        echo "Error: " . mysqli_error(DB);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Tambah Supplier</title>
</head>
<body>
<div class="container mt-5">
    <h3>Tambah Supplier</h3>
    <form action="" method="POST">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Supplier</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" required></textarea>
        </div>
        <div class="mb-3">
            <label for="telp" class="form-label">No. Telpon</label>
            <input type="text" class="form-control" id="telp" name="telp" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="supplier.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>

