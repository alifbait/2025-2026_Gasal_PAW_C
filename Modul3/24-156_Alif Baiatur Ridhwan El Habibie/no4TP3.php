<?php
    $height = array("Andy" => "176", "Barry" => "165", "Charlie" => "170");
    foreach($height as $x => $x_value) {
        echo "Key=" . $x . ", Value=" . $x_value;
        echo "<br>";
    }
    echo "<br>";
    // 3.4.1 Tambahkan 5 data baru dalam array $height
    $height["dina"] = "160";
    $height["puspita"] = "150";
    $height["dewi"] = "157";
    $height["budi"] = "168";
    $height["tono"] = "170";
    foreach($height as $x => $x_value) {
        echo "Key=" . $x . ", Value=" . $x_value;
        echo "<br>";
    }
    echo "<br>";
    // 3.4.2ss Buat array baru dengan nama $weight yang memiliki 3 buah data
    $weight = array(
        "Andy" => "50",
        "Barry" => "85",
        "Charlie" => "58"
    );
    foreach($weight as $x => $x_value) {
        echo "Key=" . $x . ", Value=" . $x_value;
        echo "<br>";
    }
?>