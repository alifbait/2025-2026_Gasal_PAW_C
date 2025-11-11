<?php
require "koneksi.php";

function validateTransaction($field_list) {
    $error = [];
    
    $currentDate = date("Y-m-d");
    if (trim($field_list['transaksi']) == "") {
        array_push($error, "Tanggal transaksi harus diisi.");
    } elseif ($field_list['transaksi'] < $currentDate) {
        array_push($error, "Tanggal transaksi tidak boleh sebelum hari ini.");
    }

    if (trim($field_list['keterangan']) == "") {
        array_push($error, "Keterangan harus diisi.");
    } elseif (strlen($field_list['keterangan']) < 3) {
        array_push($error, "Keterangan minimal harus 3 karakter.");
    }

    if (empty($field_list['pelangganid'])) {
        array_push($error, "Pelanggan harus dipilih.");
    }

    return $error;
}

$errors = [];

if (isset($_POST['submit'])) {
    $transaksi = $_POST['transaksi'];
    $keterangan = $_POST['keterangan'];
    $total = $_POST['total'];
    $pelangganid = $_POST['pelangganid'];

    $field_list = [
        'transaksi' => $transaksi,
        'keterangan' => $keterangan,
        'total' => $total,
        'pelangganid' => $pelangganid
    ];

    $errors = validateTransaction($field_list);
    
    if (empty($errors)) {
        $insert = "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES ('$transaksi', '$keterangan', '$total', '$pelangganid')";
        if (mysqli_query($koneksi, $insert)) {
            $transaksi = '';
            $keterangan = '';
            $total = 0;
            $pelangganid = '';
            header("Location: index.php");
            exit();
        } else {
            $errors[] = "Gagal menambahkan transaksi: " . mysqli_error($koneksi);
        }
    }
}

$pelangganQuery = "SELECT id, nama FROM pelanggan";
$pelangganResult = mysqli_query($koneksi, $pelangganQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Data Transaksi</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h3>Tambah Data Transaksi</h3>
        <?php
        if (!empty($errors)) {
            echo '<div class="error">' . implode('<br>', $errors) . '</div>';
        }
        ?>
        <form action="tambah_Transaksi.php" method="post">
            <div class="form-group">
                <label for="waktutransaksi">Waktu Transaksi</label>
                <input type="date" id="waktutransaksi" name="transaksi">
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea id="keterangan" name="keterangan" placeholder="Masukkan keterangan transaksi"></textarea>
            </div>
            <div class="form-group">
                <label for="total">Total</label>
                <input type="number" id="total" name="total" value="0">
            </div>
            <div class="form-group">
                <label for="pelangganid">Pelanggan</label>
                <select id="pelangganid" name="pelangganid">
                    <option value="">Pilih Pelanggan</option>
                    <?php
                        while ($row = mysqli_fetch_assoc($pelangganResult)) {
                            $selected = ($pelangganid == $row['id']) ? 'selected' : '';
                            echo "<option value='".$row['id']."' $selected>".$row['nama']."</option>";
                        }
                    ?>
                </select>
            </div>
            <button type="submit" name="submit" class="btn-submit">Tambah Transaksi</button>
        </form>
    </div>
</body>
</html>
