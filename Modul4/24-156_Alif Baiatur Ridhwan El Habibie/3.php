<?php
# PREG MATCH
echo "<b>---Preg Match---</b><br>";
$pattern = "/^[a-z]+$/";
if (preg_match($pattern, "Abc123")) {
    echo "COCOK" . "<br>";
} else {
    echo "Tidak cocok" . "<br>";
}
echo "<hr>";

# STRING
echo "<b>----STRING----</b><br>";
$tes_variable = "  ALLOWWWW GUYSS!!  "; // String dengan spasi di awal dan akhir
$new_str = trim($tes_variable); // Menghapus spasi di awal dan akhir
echo "Original string: '$tes_variable', After trim: '$new_str'<br>";
echo "<hr>";

# FILTER
echo "<b>----FILTER----</b><br>";
$tes_variable = "192.168.1.0"; // IP address valid
echo "Original value: $tes_variable<br>";
$new_str = filter_var($tes_variable, FILTER_VALIDATE_IP); // Validasi apakah IP valid
echo "Valid IP: " . ($new_str ? $new_str : "Invalid") . "<br>";
echo "<hr>";

# TYPE TESTING
echo "<b>----TYPE TESTING----</b><br>";
echo "Is float: " . (is_float(20) ? "Yes" : "No") . "<br>";
echo "<hr>";

# DATE
echo "<b>----DATE----</b><br>";
var_dump(checkdate(10, 16, 2024)); // Mengecek apakah tanggal valid (Februari 29, 2001 bukan tahun kabisat)
echo "<hr>";
?>