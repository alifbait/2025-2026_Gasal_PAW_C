<?php
$nama = "Alif Baiatur Ridhwan El Habibie";
$nim = "240411100156";
$alamat = "jl.Wonocolo pabrik kulit";
$ttl = "Surabaya, 6 Oktober 2005";
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>BIODATA MAHASISWA</h1>
    <table border="1">
        <tr>
            <th>Nama</th>
            <td><?php echo $nama; ?></td>
        </tr>
        <tr>
            <th>NIM</th>
            <td><?php echo $nim; ?></td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td><?php echo $alamat; ?></td>
        </tr>
        <tr>
            <th>TTL</th>
            <td><?php echo $ttl; ?></td>
        </tr>
    </table>
</body>
</html>