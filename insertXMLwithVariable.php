<?php

// Csak változóként működik!

// XML fájl változóként 
$xmlValtozo = <<<XML
<?xml version="1.0" encoding="UTF-8" standalone="no"?>
<napok>
    <nap datum="2023.03.27.">
        <min>-2</min>
        <max>10</max>
    </nap>
    <nap datum="2023.03.28.">
        <min>-3</min>
        <max>11</max>
    </nap>
    <nap datum="2023.03.29.">
        <min>1</min>
        <max>12</max>
    </nap>
    <nap datum="2023.03.30.">
        <min>2</min>
        <max>19</max>
    </nap>
</napok>
XML;

// Betölti a fájlt
$sxe = new SimpleXMLElement($xmlValtozo);

// Hozzáad egy <nap> node-ot
$nap = $sxe -> addChild("nap");

// Hozzáad egy datum attribútumot a <nap> node-hoz
$nap -> addAttribute("datum", "2999.09.09.");

// Hozzáad egy <min> node-ot
$nap -> addChild("min", "-99");

// Hozzáad egy <max> node-ot
$nap -> addChild("max", "99");

// Mentés
echo $sxe -> asXML();

?>