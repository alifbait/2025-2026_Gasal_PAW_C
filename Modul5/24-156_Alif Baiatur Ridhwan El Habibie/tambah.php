<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Tambah Data Supplier</title>
</head>
<body>
    <div class="container">
        <h1>Tambah Data Master Supplier Baru</h1>

        <?php 
        include 'koneksi.php'; 
        $error_msg = "";
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
            $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
            $telp = mysqli_real_escape_string($koneksi, $_POST['telp']);

            if (empty($nama) || empty($alamat) || empty($telp)) {
                $error_msg = "Semua field harus diisi!";
            } else {
                $sql = "INSERT INTO supplier (nama, alamat, telp) VALUES ('$nama', '$alamat', '$telp')";
                if (mysqli_query($koneksi, $sql)) {
                    header("Location: index.php");
                    exit();
                } else {
                    $error_msg = "Error: " . mysqli_error($koneksi);
                }
            }
        }
        ?>

        <?php if (!empty($error_msg)): ?>
            <div class="error-msg"><?php echo $error_msg; ?></div>
        <?php endif; ?>

        <form method="POST" action="" class="form-input">
            <div class="form-group">
                <label for="nama">Nama Supplier:</label>
                <input type="text" id="nama" name="nama" value="<?php echo isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" id="alamat" name="alamat" value="<?php echo isset($_POST['alamat']) ? htmlspecialchars($_POST['alamat']) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="telp">Telepon:</label>
                <input type="text" id="telp" name="telp" value="<?php echo isset($_POST['telp']) ? htmlspecialchars($_POST['telp']) : ''; ?>">
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn btn-simpan">Simpan</button>
                <a href="index.php" class="btn btn-batal">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>