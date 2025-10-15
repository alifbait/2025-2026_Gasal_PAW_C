<?php
    // 3.5.1 Tambahkan 5 data baru dalam array $students!
    $students = array
    (
        array("Alex", "220401", "0812345678"),
        array("Bianca", "220402", "0812345687"),
        array("Candice", "220403", "0812345665"),
        array("dina", "230404", "0822345669"),
        array("puspita", "230405", "0822345637"),
        array("cindy", "230406", "0822345670"),
        array("yully", "230407", "0822345616"),
        array("rahma", "230408", "0822345605"),
    );
    for ($row = 0; $row < 8; $row++) {
        echo "<p><b>Row number $row</b></p>";
        echo "<ul>";
        
        for ($col = 0; $col < 3; $col++) {
            echo "<li>".$students[$row][$col]."</li>";
        }
        echo "</ul>";
    }
    echo "<br>"."<br>";
    // 3.5.2 Tampilkan data dalam array $students dalam bentuk tabel!
    echo "Bentuk tabelnya adalah: ";
    echo "<table border='1'>";
    echo "<tr>";
    echo "<th>Name</th>";
    echo "<th>NIM</th>";
    echo "<th>Mobile</th>";
    echo "</tr>";
    for ($row = 0; $row < 8; $row++) {
    echo "<tr>";
    for ($col = 0; $col < 3; $col++) {
    echo "<td>";
    echo $students[$row][$col];
    echo "</td>";
    }
    echo "</tr>";
    }
    echo "</table>";
?>