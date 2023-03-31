<?php

// Órai anyag, NEM MÜKÖDIK

// ha meg lett-e nyomva a gomb
if(isset($_POST['btnSend'])){

    // ha a txtDatum karaktereinek száma 13
    if(strlen($_POST['txtDatum']) == 13){

        $datum = $_POST['txtDatum'];
        $min = $_POST['nbMin'];
        $max = $_POST['nbMax'];

        $xml = simplexml_load_file('napok.xml');

        $newNode = new SimpleXMLElement($xml -> __toString());

        $xml -> addChild($newNode);
        $nap = $newNode -> addChild('nap');
        $nap -> addAttribute('datum', $datum);
        $nap -> addChild('min', $min);
        $nap -> addChild('max', $max);
        $xml -> addChild($nap);

        file_put_contents('napok.xml', $xml -> asXML());
    }
    else {
        print 'Hibás dátumformátum!';
    }
}
?>

<img src="napok.php">

<form method="post">
    <input type="text" name="txtDatum" placeholder="ÉÉÉÉ. HH. NN."><br />
    Napi maximum: <input type="number" name="nbMax" min="-20" max="50" value="0"><br />
    Napi minimum: <input type="number" name="nbMin" min="-20" max="50" value="0"><br />
    <input type="submit" name="btnSend" value="Mentés"><br />
</form>