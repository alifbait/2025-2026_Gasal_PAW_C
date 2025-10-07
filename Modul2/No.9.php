<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>INPUT NILAI</h1>
    <form action="">
        <label for="">ALPRO</label><br>
        <input type="number" name="alpro" id=""><br>
        <label for="">BASDAT</label><br>
        <input type="number" name="basdat" id=""><br>
        <label for="">PAW</label><br>
        <input type="number" name="PAW" id=""><br>

        <input type="submit" value="KIRIM">
    </form>
    <?php
        if (isset($_GET['alpro']) && isset($_GET['basdat']) && isset($_GET['PAW'])) {
            $alpro = $_GET['alpro'];
            $basdat = $_GET['basdat'];
            $PAW = $_GET['PAW'];

            $rata = ($alpro + $basdat + $PAW) / 3;
            echo "Rata-rata: " . $rata . "<br>";

            if ($rata >= 85) {
                echo "Predikat: A";
            } elseif ($rata >= 70) {
                echo "Predikat: B";
            } elseif ($rata >= 55) {
                echo "Predikat: C";
            } elseif ($rata >= 40) {
                echo "Predikat: D";
            } else {
                echo "Predikat: E";
            }
        }
    ?>
</body>
</html>