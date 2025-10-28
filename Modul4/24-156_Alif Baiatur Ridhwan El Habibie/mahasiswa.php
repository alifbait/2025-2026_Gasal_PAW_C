<?php
require_once 'process.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>📝 Form Data Mahasiswa</h2>
        
        <?php if ($success): ?>
            <div class="success">
                <h3>✓ Data berhasil disimpan!</h3>
                <p>Nama: <?php echo htmlspecialchars($_POST['nama']); ?></p>
                <p>Email: <?php echo htmlspecialchars($_POST['email']); ?></p>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="">
            
            <div class="form-group">
                <label for="nama">Nama Lengkap:</label>
                <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($nama); ?>" placeholder="Masukkan nama lengkap">
                <?php if (isset($errors['nama'])): ?>
                    <div class="error"> <?php echo $errors['nama']; ?></div>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" placeholder="contoh@email.com">
                <?php if (isset($errors['email'])): ?>
                    <div class="error"> <?php echo $errors['email']; ?></div>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Minimal 8 karakter">
                <?php if (isset($errors['password'])): ?>
                    <div class="error"> <?php echo $errors['password']; ?></div>
                <?php endif; ?>
            </div>
            
            <button type="submit">Simpan Data</button>
            
        </form>
    </div>
</body>
</html>