<?php
// Array_push
$fruits = array("Apple", "Banana");
array_push($fruits, "Orange", "Grape", "Pineapple"); 

print_r($fruits); 
echo "<br>"."<br>"
?>

<?php
//Array_merge
$array1 = array("Red", "Blue");
$array2 = array("Green", "Yellow");
$combinedArray = array_merge($array1, $array2); 

print_r($combinedArray); 
echo "<br>"."<br>"
?>

<?php
$array1 = array("name" => "John", "age" => 25, "city" => "New York");
$values = array_values($array1); 

print_r($values);

echo "<br>"."<br>"
?>

<?php
//Array_search
$height =  ["Andy" => "176", "Barry"=>"165", "Charly"=>"170"];

$values = array_values($height);
$terahir = $values[count($values)-1];

echo "index terahir adalah $terahir";
echo "<br>"."<br>"
?>

<?php
//array_filter
$angka = array(1, 2, 3, 4, 5, 6);
$number = array_filter($angka, function($num) {
    return $num % 2 == 0; 
});

print_r($number); 
echo "<br>"."<br>"
?>

<?php
// 1. Membuat array dengan nilai campuran
$numbers = array(4, 2, 8, 6, 1, 9, 5, 3, 7);

// 2. Mengurutkan array secara ascending
$ascending = $numbers; // Salin array
sort($ascending); // Mengurutkan nilai array secara ascending
echo "Array Ascending: ";
print_r($ascending);

// 3. Mengurutkan array secara descending
$descending = $numbers; // Salin array
rsort($descending); // Mengurutkan nilai array secara descending
echo "Array Descending: ";
print_r($descending);

// 4. Menggabungkan kedua hasil
$combined = array_merge($ascending, $descending);
echo "Combined Array (Ascending and Descending): ";
print_r($combined);
?>