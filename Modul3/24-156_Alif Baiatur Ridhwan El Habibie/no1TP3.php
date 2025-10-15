<?php
    $fruits = array("Avocado", "Blueberry", "Cherry");
    echo "I like " . $fruits[0] . ", " . $fruits[1] . " and " . $fruits[2] . ".<br>"."<br>" ;
    
    // 3.1.1 Tambahkan 5 data baru ke dalam array $fruits
    array_push($fruits, "strawberry", "manggo", "apple", "banana", "grape");
    echo "Nilai dengan indeks tertinggi adalah: " . $fruits[count($fruits) - 1] . "<br>";
    echo "Indeks tertinggi dari array adalah: " . (count($fruits) - 1) . "<br>"."<br>";

    // 3.1.2 Hapus satu data tertentu dari array $fruits
    unset($fruits[4]);
    $fruits = array_values($fruits);
    echo "Nilai dengan indeks tertinggi setelah dihapus adalah: " . $fruits[count($fruits) - 1] . "<br>";
    echo "Indeks tertinggi dari array setelah dihapus adalah: " . (count($fruits) - 1) . "<br>"."<br>";
   print_r($fruits);
    // 3.1.3 Buat array baru dengan nama $veggies yang memiliki 3 buah data
    $veggies = array("potato", "carrot", "chili");
    echo "Data dari array veggies: ". $veggies[0] . ", ".$veggies[1] . ", ".$veggies[2] . ".";
?>
