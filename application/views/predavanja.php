<?php

echo "Spisak predavanja na Elektrotehnickom fakultetu u Beogradu:<br/><br/><br/>";

foreach ($predavanja as $predavanje) {

    echo "Naslov:<br/>" . $predavanje['naslov_srpski'] . "<br/>";
    echo "Opis predavanja:<br/>" . $predavanje['opis_srpski'] . "<br/>";
    echo "Sala:" . $predavanje['sala'] . "<br/>";
    echo "Vreme predavanja:" . $predavanje['vreme_predavanja'] . "<br/>";
    echo "Ime predavaca:" . $predavanje['ime_predavaca'] . "<br/>";
    echo "Prezime predavaca:" . $predavanje['prezime_predavaca'] . "<br/>";
    echo "Biografija predavaca:<br/>" . $predavanje['cv_srpski'] . "<br/>";
    echo "<br/><br/><br/>";
}
