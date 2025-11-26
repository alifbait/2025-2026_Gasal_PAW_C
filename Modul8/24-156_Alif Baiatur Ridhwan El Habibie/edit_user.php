<?php
require_once "./koneksi.php";
session_start();

if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'Owner') {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: users.php");
    exit();
}

$id = mysqli_real_escape_string(DB, $_GET['id']);
$user = getDataUserById($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string(DB, $_POST['username']);
    $nama = mysqli_real_escape_string(DB, $_POST['nama']);
    $alamat = mysqli_real_escape_string(DB, $_POST['alamat']);
    $hp = mysqli_real_escape_string(DB, $_POST['hp']);
    $level = mysqli_real_escape_string(DB, $_POST['level']);

    $query = "UPDATE user SET username='$username', nama='$nama', alamat='$alamat', hp='$hp', level='$level' WHERE id_user='$id'";

    if (mysqli_query(DB, $query)) {
        header("Location: users.php");
        exit();
    } else {
        $error = "Gagal mengedit user: " . mysqli_error(DB);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Edit User</h2>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"> <?= htmlspecialchars($error) ?> </div>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= htmlspecialchars($user['nama']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= htmlspecialchars($user['alamat']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="hp" class="form-label">No HP</label>
            <input type="text" class="form-control" id="hp" name="hp" value="<?= htmlspecialchars($user['hp']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="level" class="form-label">Level</label>
            <select class="form-select" id="level" name="level" required>
                <option value="Admin" <?= $user['level'] === '1' ? 'selected' : '' ?>>Owner</option>
                <option value="Owner" <?= $user['level'] === '2' ? 'selected' : '' ?>>Kasir</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="users.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
