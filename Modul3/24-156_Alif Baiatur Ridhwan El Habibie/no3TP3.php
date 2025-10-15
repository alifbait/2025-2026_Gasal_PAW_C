<?php
    $height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170");
    echo "Andy is " . $height["Andy"] . " cm tall.";
    echo "<br>"."<br>";
    // 3.3.1 Tambahkan 5 data baru dalam array $height
    $height["dina"] = "160";
    $height["puspita"] = "150";
    $height["dewi"] = "157";
    $height["budi"] = "168";
    $height["tono"] = "170";
    echo "Nilai dengan indeks terakhir sekarang adalah: " .end($height) . " cm tall<br>";
    echo "<br>";
    // 3.3.2 Hapus 1 data tertentu dari array $height
    unset($height["dewi"]);
    echo "Nilai dengan indeks terakhir sekarang adalah: " .end($height) . " cm tall<br>";
    echo "<br>";
    // 3.3.3 Buat array baru dengan nama $weight yang memiliki 3 buah data
    $weight = array("Andy" => "50", "Charlie" => "80", "Barry" => "55");
    echo "Data ke-2 adalah: " . $weight["Charlie"] . " kg";
?>