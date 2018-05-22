<?php

echo "<br/><br/>Spisak donatorskih ugovora na Elektrotehnickom fakultetu u Beogradu:<br/><br/><br/>";

foreach ($donatorskiUgovori as $dugovor) {

    echo "<h3>" . $dugovor['naziv'] . "</h3><br/>";
    echo "Datum potpisivanja: " . $dugovor['datum_potpisivanja'] . "<br/>";
    echo "Datum isticanja: " . $dugovor['datum_isticanja'] . "<br/>";
    echo "Paket: " . $dugovor['naziv_paketa'] . "<br/>";
    echo "Procenjena vrednost: " . $dugovor['procenjena_vrednost'] . "<br/>";
    echo "Valuta: " . $dugovor['valuta'] . "<br/>";
    echo "Opis donacije: <br/>";  ?>
    <textarea name="opis_donacije"><?php if ($dugovor['opis_donacije'] != NULL) {
        echo $dugovor['opis_donacije'];
    } ?></textarea><br /><br />
    <?php
    echo "datum_isporuke" . $dugovor['datum_isporuke'] . "<br/>";    
    echo "komentar:" . $dugovor['komentar'] . "<br/>";
    echo "Tip ugovora: " . $dugovor['tip'] . "<br/>";         
    echo "Status ugovora: " . $dugovor['opis'] . "<br/>";      
    echo "<br/><br/><br/>";
    }
 
?>