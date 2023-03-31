<?php 

$eredmeny = "";

// Ha meg lett nyomva a gomb
if(isset($_POST["btnSend"])) {

    // Ha a txtDatum karaktereinek száma 11
    if(strlen($_POST['txtDatum']) == 11){

        print "
        <style type='text/css'>
        p {
            color: green;
        }
        </style>";

        $eredmeny = "Rendben!";

        // Letároluk a beviteli mezők értékeit
        $datum = $_POST["txtDatum"];
        $min = $_POST["nbMin"];
        $max = $_POST["nbMax"];

        // Ez az XML dokumentum gyökere
        $dom = new DOMDocument();

        // Beolvassuk a fájlt
        $dom -> load("napok.xml");

        // <nap> Node létrehozása
        $napNode = $dom -> createElement("nap");

        // Attribútom a <nap> Node-hoz
        $napNode -> setAttribute("datum", $datum);

        // <min> Node létrehozása
        $minNode = $dom -> createElement("min");

        // <min> TextNode létrehozása
        $mintextNode = $dom -> createTextNode($min);

        // A <min>-hez értéket társítunk
        $minNode -> appendChild($mintextNode);

        // <max> Node létrehozása
        $maxNode = $dom -> createElement("max");

        // <max> TextNode létrehozása
        $maxtextNode = $dom -> createTextNode($max);

        // A <min>-hez értéket társítunk
        $maxNode -> appendChild($maxtextNode);

        // Hozzáadjuk a <nap>-hoz a <min>-t
        $napNode -> appendChild($minNode);

        // Hozzáadjuk a <nap>-hoz a <max>-t
        $napNode -> appendChild($maxNode);

        // Hozzáadjuk a FőNode-hoz a <nap>-ot
        $dom -> documentElement -> appendChild($napNode);

        // Beleírjuk a fájlba
        $dom -> save("napok.xml");
    }else {

        print "
        <style type='text/css'>
        p {
            color: red;
        }
        </style>";

        $eredmeny = "Hibás dátumformátum!";
    }
}
?>

<title>Napi hőmérséklet</title>
<style>
    <?php include_once "style.css"; ?>
</style>

<body>
    <img src="napok.php">

    <form method="post">
        <label for="txtDatum">Dátum: </label>
        <input type="text" name="txtDatum" id="txtDatum" placeholder="ÉÉÉÉ.HH.NN.">
        
        <label for="nbMin">Napi minimum: </label>
        <input type="number" name="nbMin" min="-20" max="50" value="0">

        <label for="nbMax">Napi maximum: </label>
        <input type="number" name="nbMax" id="nbMax" min="-20" max="50" value="0">

        <input type="submit" name="btnSend" value="Mentés">
    </form>

    <p><?php print $eredmeny ?></p>
</body>