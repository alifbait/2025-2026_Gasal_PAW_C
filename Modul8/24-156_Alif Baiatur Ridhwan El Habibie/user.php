<?php
require_once "./koneksi.php";

session_start(); 
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit(); 
}
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
$user = getAllDataUser();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>User</title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Sistem Penjualan</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                </li>
                
                <?php if ($username === 'Owner') : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Data Master
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="./barang.php">Data Barang</a></li>
                            <li><a class="dropdown-item" href="./supplier.php">Data Supplier</a></li>
                            <li><a class="dropdown-item" href="./pelanggan.php">Data Pelanggan</a></li>
                            <li><a class="dropdown-item" href="./users.php">Data User</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a class="nav-link" href="./transaksi.php">Transaksi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="report_transaksi.php">Laporan</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Hi, <?= htmlspecialchars($username); ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="./logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <h4 class="h4 bg-primary text-white py-3 ps-4 mt-4 mb-0">Data Master User</h4>
    <div class="container border border-gray p-0">
        <!-- Tombol Tambah User -->
        <div class="d-flex justify-content-end p-3">
            <a href="tambah_user.php" class="btn btn-success"><i class="fas fa-plus"></i> Tambah User</a>
        </div>
        
        <table class="table table-hover mb-0 table-bordered">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>ID User</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>HP</th>
                    <th>Level</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user as $nomor => $data) : ?>
                    <tr>
                        <td><?= $nomor + 1 ?></td>
                        <td><?= htmlspecialchars($data["id_user"]); ?></td>
                        <td><?= htmlspecialchars($data["username"]); ?></td>
                        <td><?= htmlspecialchars($data["nama"]); ?></td>
                        <td><?= htmlspecialchars($data["alamat"]); ?></td>
                        <td><?= htmlspecialchars($data["hp"]); ?></td>
                        <td><?= htmlspecialchars($data["level"]); ?></td>
                        <td>
                            <a href="edit_user.php?id=<?= urlencode($data['id_user']); ?>" class="btn btn-warning btn-sm">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <a href="hapus_user.php?id=<?= urlencode($data['id_user']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                <i class="fa fa-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
