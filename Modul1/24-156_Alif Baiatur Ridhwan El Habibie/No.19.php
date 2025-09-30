<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama    = $_POST['nama'];
    $nim     = $_POST['nim'];
    $prodi   = $_POST['prodi'];
    $alamat  = $_POST['alamat'];

    echo "<h2>Hasil Input Biodata Mahasiswa</h2>";
    echo "<table border='1' cellpadding='8' cellspacing='0'>";
    echo "<tr><td>Nama</td><td>$nama</td></tr>";
    echo "<tr><td>NIM</td><td>$nim</td></tr>";
    echo "<tr><td>Alamat</td><td>$alamat</td></tr>";
    echo "<tr><td>Jurusan</td><td>$prodi</td></tr>";
    echo "</table><br>";
    echo "<a href='".$_SERVER['PHP_SELF']."'>Input Ulang</a>";
} else {
    ?>
    <h1>Input Biodata</h1>
    <form method="post" action="">
        <label>Nama: </label><br>
        <input type="text" name="nama" required><br><br>

        <label>NIM: </label><br>
        <input type="text" name="nim" required><br><br>

        
        <label>Alamat: </label><br>
        <textarea name="alamat" required></textarea><br><br>
        
        <label>Prodi: </label><br>
        <input type="text" name="prodi" required><br><br>
        <input type="submit" value="Simpan Biodata">
    </form>
    <?php
}
?>
