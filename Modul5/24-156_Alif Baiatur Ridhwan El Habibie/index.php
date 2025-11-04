<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Data Master Supplier</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Data Master Supplier</h1>
            <a href="tambah.php" class="btn btn-tambah">Tambah Data</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Telp</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'koneksi.php';
                $query = mysqli_query($koneksi, "SELECT * FROM supplier");

                $no = 1;
                while ($data = mysqli_fetch_array($query)) {
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo htmlspecialchars($data['nama']); ?></td>
                        <td><?php echo htmlspecialchars($data['alamat']); ?></td>
                        <td><?php echo htmlspecialchars($data['telp']); ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $data['id']; ?>" class="btn btn-edit">Edit</a>
                            <a href="hapus.php?id=<?php echo $data['id']; ?>" class="btn btn-hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>