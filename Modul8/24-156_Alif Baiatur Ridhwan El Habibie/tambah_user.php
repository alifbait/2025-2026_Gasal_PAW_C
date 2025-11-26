<?php
require_once "./koneksi.php";
session_start();

if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'Owner') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string(DB, $_POST['username']);
    $password = mysqli_real_escape_string(DB, password_hash($_POST['password'], PASSWORD_DEFAULT));
    $nama = mysqli_real_escape_string(DB, $_POST['nama']);
    $alamat = mysqli_real_escape_string(DB, $_POST['alamat']);
    $hp = mysqli_real_escape_string(DB, $_POST['hp']);
    $level = mysqli_real_escape_string(DB, $_POST['level']);

    $query = "INSERT INTO user (username, password, nama, alamat, hp, level) VALUES ('$username', '$password', '$nama', '$alamat', '$hp', '$level')";

    if (mysqli_query(DB, $query)) {
        header("Location: user.php");
        exit();
    } else {
        $error = "Gagal menambahkan user: " . mysqli_error(DB);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Tambah User</h2>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"> <?= htmlspecialchars($error) ?> </div>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" required>
        </div>
        <div class="mb-3">
            <label for="hp" class="form-label">No HP</label>
            <input type="text" class="form-control" id="hp" name="hp" required>
        </div>
        <div class="mb-3">
            <label for="level" class="form-label">Level</label>
            <select class="form-select" id="level" name="level" required>
                <option value="1">Owner</option>
                <option value="2">Kasir</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
        <a href="user.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
