<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kasir Sederhana Dengan Reset</title>
</head>
<body>
    <h2>KASIR Sederhana</h2>
    
    <form action="" method="POST">
        
        <div class="item">
            <input type="checkbox" name="beli_ng" id="ng"> 
            <label for="ng">Nasi Goreng (Rp 10.000)</label>
            <label for="jumlah_ng">Jumlah:</label>
            <input type="number" name="jumlah_ng" min="1" value="1">
        </div>
        <div class="item">
            <input type="checkbox" name="beli_soto" id="soto"> 
            <label for="soto">Soto (Rp 15.000)</label>
            <label for="jumlah_soto">Jumlah:</label>
            <input type="number" name="jumlah_soto" min="1" value="1">
        </div>
        <div class="item">
            <input type="checkbox" name="beli_pecel" id="pecel"> 
            <label for="pecel">Pecel (Rp 20.000)</label>
            <label for="jumlah_pecel">Jumlah:</label>
            <input type="number" name="jumlah_pecel" min="1" value="1">
        </div>
        <br>
        <div class="controls">
            <input type="submit" value="HITUNG TOTAL" name="hitung">
            
            <input type="button" value="RESET PESANAN" onclick="window.location.href=window.location.href">
        </div>
    </form>
    
    <?php
    if (isset($_POST['hitung'])) {
        
        $total_semua = 0;
        $harga_ng = 10000;
        $harga_soto = 15000;
        $harga_pecel = 20000;

        echo "<hr><h3>RINCIAN:</h3>";
        if (isset($_POST['beli_ng'])) {
            $jumlah = (int)$_POST['jumlah_ng'];
            $subtotal = $jumlah * $harga_ng;
            $total_semua += $subtotal;
            echo "Nasi Goreng ($jumlah porsi): <strong>Rp " . $subtotal . "</strong><br>";
        }
        if (isset($_POST['beli_soto'])) {
            $jumlah = (int)$_POST['jumlah_soto'];
            $subtotal = $jumlah * $harga_soto;
            $total_semua += $subtotal;
            echo "Soto ($jumlah porsi): <strong>Rp " . $subtotal . "</strong><br>";
        }
        if (isset($_POST['beli_pecel'])) {
            $jumlah = (int)$_POST['jumlah_pecel'];
            $subtotal = $jumlah * $harga_pecel;
            $total_semua += $subtotal;
            echo "Pecel ($jumlah porsi): <strong>Rp " . $subtotal . "</strong><br>";
        }

        echo "<br><h4>JUMLAH TOTAL BELANJA: Rp " . $total_semua . "</h4>";
        echo "<hr>";
    }
    ?> 
</body>
</html>