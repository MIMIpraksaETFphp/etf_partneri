<?php
//echo mdate('%Y-%m-%d %H:%i:%s', now())."<br>";
echo "<br/><br/>Spisak novcanih ugovora na Elektrotehnickom fakultetu u Beogradu:<br/><br/><br/>";

foreach ($novcaniUgovori as $nugovor) {
    //$datum=mdate('%Y-%m-%d %H:%i:%s', now());
    //if($novcaniUgovorir<$nugovor['vreme_predavanja']){
    echo "<h3>" . $nugovor['naziv'] . "</h3><br/>";
    echo "Datum potpisivanja: " . $nugovor['datum_potpisivanja'] . "<br/>";
    echo "Datum isticanja: " . $nugovor['datum_isticanja'] . "<br/>";
    echo "Paket: " . $nugovor['naziv_paketa'] . "<br/>";
    echo "Vrednost: " . $nugovor['vrednost'] . "<br/>";
    echo "Valuta: " . $nugovor['valuta'] . "<br/>";
    echo "Faktura: "; 
            if($nugovor['faktura']==1){
                echo "poslata" . "<br/>";;
            } else {
                echo "nije poslata" . "<br/>";;
            }
    echo "Uplata: ";
            if($nugovor['uplata']==1){
                echo "uplaceno" . "<br/>";;
            } else {
                echo "nije uplaceno" . "<br/>";;
            }
    echo "Datum uplate: " . $nugovor['datum_uplate'] . "<br/>";        
    echo "Tip ugovora: " . $nugovor['tip'] . "<br/>";
    echo "Status ugovora: " . $nugovor['opis'] . "<br/>";
    echo "<br/><br/><br/>";
    }
//}   
?>
