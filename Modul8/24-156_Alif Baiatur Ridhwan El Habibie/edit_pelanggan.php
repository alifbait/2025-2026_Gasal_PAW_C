<?php
require_once './koneksi.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
    $id = mysqli_real_escape_string(DB, $_POST['id']);
    $nama = mysqli_real_escape_string(DB, $_POST['nama']);
    $jenis_kelamin = mysqli_real_escape_string(DB, $_POST['jenis_kelamin']);
    $telp = mysqli_real_escape_string(DB, $_POST['telp']);
    $alamat = mysqli_real_escape_string(DB, $_POST['alamat']);

    $query = "UPDATE pelanggan SET nama = '$nama', jenis_kelamin = '$jenis_kelamin', telp = '$telp', alamat = '$alamat' WHERE id = '$id'";
    if (mysqli_query(DB, $query)) {
        header("Location: pelanggan.php?message=success");
    } else {
        header("Location: pelanggan.php?message=error");
    }
    exit();
}

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string(DB, $_GET['id']);
    $query = "SELECT * FROM pelanggan WHERE id = '$id'";
    $result = mysqli_query(DB, $query);
    $data = mysqli_fetch_assoc($result);
    if (!$data) {
        header("Location: pelanggan.php");
        exit();
    }
} else {
    header("Location: pelanggan.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Pelanggan</title>
</head>
<body>
<div class="container mt-5">
    <h2>Edit Pelanggan</h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $data['id'] ?>">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="Laki-laki" <?= $data['jenis_kelamin'] === 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="Perempuan" <?= $data['jenis_kelamin'] === 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="telp" class="form-label">No. Telepon</label>
            <input type="text" class="form-control" id="telp" name="telp" value="<?= $data['telp'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?= $data['alamat'] ?></textarea>
        </div>
        <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
        <a href="pelanggan.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>