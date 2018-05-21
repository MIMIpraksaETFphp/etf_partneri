<?php

echo "<br/><br/>Spisak donatorskih ugovora na Elektrotehnickom fakultetu u Beogradu:<br/><br/><br/>";

foreach ($donatorskiUgovori as $dugovor) {

    echo "<h3>" . $dugovor['naziv'] . "</h3><br/>";
    echo "Datum potpisivanja: " . $dugovor['datum_potpisivanja'] . "<br/>";
    echo "Datum isticanja: " . $dugovor['datum_isticanja'] . "<br/>";
    echo "Paket: " . $dugovor['naziv_paketa'] . "<br/>";
    echo "Procenjena vrednost: " . $dugovor['procenjena_vrednost'] . "<br/>";
    echo "Valuta: " . $dugovor['valuta'] . "<br/>";
    echo "opis: " . $dugovor['opis_donacije'] . "<br/>";             
    echo "datum_isporuke" . $dugovor['datum_isporuke'] . "<br/>";    
    echo "komentar:" . $dugovor['komentar'] . "<br/>";
    echo "Tip ugovora: " . $dugovor['tip'] . "<br/>";         
    echo "Status ugovora: " . $dugovor['opis'] . "<br/>";      
    echo "<br/><br/><br/>";
    }
 
?>