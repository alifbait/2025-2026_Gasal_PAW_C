<?php
function writeMsg() {
  echo "Hello world!";
}

writeMsg(); // call the function
?>

<br></br>

<?php
function familyName($fname) {
  echo "$fname Refsnes.<br>";
}

familyName("Jani");
familyName("Hege");
familyName("Stale");
familyName("Kai Jim");
familyName("Borge");
?>

<br>

<?php
function familyName1($fname, $year) {
  echo "$fname Refsnes. Born in $year <br>";
}

familyName1("Hege", "1975");
familyName1("Stale", "1978");
familyName1("Kai Jim", "1983");
?>

<br>

<?php
function setHeight($minheight = 50) {
  echo "The height is : $minheight <br>";
}

setHeight(350);
setHeight(); // will use the default value of 50
setHeight(135);
setHeight(80);
?>

<br>

<?php
function sum($x, $y) {
  $z = $x + $y;
  return $z;
}

echo "5 + 10 = " . sum(5, 10) . "<br>";
echo "7 + 13 = " . sum(7, 13) . "<br>";
echo "2 + 4 = " . sum(2, 4);
?>