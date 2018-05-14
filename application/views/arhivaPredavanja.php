<?php
echo "<br/><br/>Arhiva predavanja na Elektrotehnickom fakultetu u Beogradu:<br/><br/><br/>";

foreach ($predavanja as $predavanje) {
    $datum=mdate('%Y-%m-%d %H:%i:%s', now());
    if($datum>$predavanje['vreme_predavanja']){
    echo "<h3><br/>" . $predavanje['naslov_srpski'] . "</h3><br/>";
    echo "Opis predavanja:<br/>" . $predavanje['opis_srpski'] . "<br/>";
    echo "Sala:" . $predavanje['sala'] . "<br/>";
    echo "Vreme predavanja:" . $predavanje['vreme_predavanja'] . "<br/>";
    echo "Ime predavaca:" . $predavanje['ime_predavaca'] . "<br/>";
    echo "Prezime predavaca:" . $predavanje['prezime_predavaca'] . "<br/>";
    echo "Biografija predavaca:<br/>" . $predavanje['cv_srpski'] . "<br/>";
    echo "<br/><br/><br/>";
    }
}