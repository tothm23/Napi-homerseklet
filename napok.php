<?php 

// Ez egy objektum
$xml = simplexml_load_file("napok.xml");

// Ez egy tömb
// print_r($xml -> nap);

/*
for ($i = 0; $i < count($xml -> nap); $i++) { 

    // Attribútumok lekérése
    //print_r(attributes()["datum"]);
    
    // Elemek lekérése
    print $xml -> nap[$i] -> attributes()["datum"] . "<br>" . 
    $xml -> nap[$i] -> min . "<br>" . 
    $xml -> nap[$i] -> max . "<br>";
}
*/

/* 
// Táblázatba rendezve
print "<table>";
for ($i = 0; $i < count($xml -> nap); $i++) { 

    // Attribútumok lekérése
    //print_r(attributes()["datum"]);
    
    // Elemek lekérése
    print "<tr><td>" . $xml -> nap[$i] -> attributes()["datum"] . "</td>" . 
    "<td>" . $xml -> nap[$i] -> min . "</td>" . 
    "<td>" . $xml -> nap[$i] -> max . "</td></tr>";
}
print "</table>";

*/

header("content-type: image/png");

$width = count($xml -> nap) * 100;
$img = imagecreatetruecolor($width, 100);

$white = imagecolorallocate($img, 255, 255, 255);
$blue = imagecolorallocate($img, 0, 0, 255);
$red = imagecolorallocate($img, 255, 0, 0);

$y0 = 60;

$x1 = 20;
$x2 = 45;
$x3 = 55;
$x4 = 80;

imageline($img, 0, $y0, $width, $y0, $white);

for ($i = 0; $i < count($xml -> nap); $i++) { 
    $ymin = $y0 - $xml -> nap[$i] -> min;
    $ymax = $y0 - $xml -> nap[$i] -> max;
    
    imagefilledrectangle($img, $i * 100 + $x1, $ymax, $i * 100 + $x2, $y0, $red);
    imagefilledrectangle($img, $i * 100 + $x3, $ymin, $i * 100 + $x4, $y0, $blue);
    imagestring($img, 4, $i * 100 + $x1, 85, $ymin, $white); 
    imagestring($img, 4, $i * 100 + $x3, 85, $ymax, $white);
}

imagepng($img);
imagedestroy($img);

?>