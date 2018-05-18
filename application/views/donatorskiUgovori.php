<?php

echo "<br/><br/>Spisak donatorskih ugovora na Elektrotehnickom fakultetu u Beogradu:<br/><br/><br/>";

foreach ($donatorskiUgovori as $dugovor) {

    echo "<h3>" . $dugovor['naziv'] . "</h3><br/>";
    echo "Datum potpisivanja: " . $dugovor['datum_potpisivanja'] . "<br/>";
    echo "Datum isticanja: " . $dugovor['datum_isticanja'] . "<br/>";
    echo "Paket: " . $dugovor['naziv_paketa'] . "<br/>";
    echo "Procenjena vrednost: " . $dugovor['procenjena_vrednost'] . "<br/>";
    echo "Valuta: " . $dugovor['valuta'] . "<br/>";
    //echo "opis: " . $dugovor['opis_donacije'] . "<br/>";             //treba u bazi promeniti ime
    echo "datum_isporuke" . $dugovor['datum_isporuke'] . "<br/>";    
    echo "komentar:" . $dugovor['komentar'] . "<br/>";
    echo "Tip ugovora: " . $dugovor['tip'] . "<br/>";          //treba srediti tip ugovora plus u bazi videti sta treba zasto izbacuje da su tip novcani?
    //echo "Status ugovora: " . $dugovor['opis'] . "<br/>";      //treba videti sta je status ugovora za donacije!!! Vrlo verovatno da ne treba
    echo "<br/><br/><br/>";
    }
 
?>